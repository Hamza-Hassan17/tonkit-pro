<?php

namespace App\Support;

/**
 * Bulk / decoration pricing engine. All amounts in CAD.
 * Config: config/pricing.php (global) + each product's `pricing.tiers`.
 */
class Pricing
{
    public static function moq(): int
    {
        return (int) config('pricing.moq', 12);
    }

    /** Tier index (0/1/2) for a given quantity. */
    public static function tierIndex(int $qty): int
    {
        foreach (config('pricing.tier_bounds') as $i => [$min, $max]) {
            if ($qty >= $min && ($max === null || $qty <= $max)) {
                return $i;
            }
        }

        return $qty < config('pricing.tier_bounds.0.0') ? 0 : count(config('pricing.tier_bounds')) - 1;
    }

    /** Blank-cap unit price for this product at this quantity. */
    public static function capUnit(array $product, int $qty): float
    {
        $tiers = $product['pricing']['tiers'] ?? [$product['price'] ?? 0];
        $i = self::tierIndex($qty);

        return (float) ($tiers[$i] ?? end($tiers));
    }

    public static function decoration(string $key): array
    {
        return config("pricing.decoration.$key") ?? config('pricing.decoration.none');
    }

    /** Decoration add-on per cap at this quantity. */
    public static function decorationUnit(string $key, int $qty): float
    {
        $d = self::decoration($key);

        return (float) ($d['unit'][self::tierIndex($qty)] ?? 0);
    }

    /** All-in unit price (cap + decoration) at this quantity. */
    public static function unit(array $product, int $qty, string $decoration = 'none'): float
    {
        return round(self::capUnit($product, $qty) + self::decorationUnit($decoration, $qty), 2);
    }

    /** Line subtotal (units only, no setup fee). */
    public static function lineSubtotal(array $product, int $qty, string $decoration = 'none'): float
    {
        return round(self::unit($product, $qty, $decoration) * $qty, 2);
    }

    /**
     * Full order breakdown from cart items (each: [...product, qty, decoration]).
     * Returns lines, one-time setup fees, shipping and grand total.
     */
    public static function breakdown(array $items): array
    {
        $lines = [];
        $itemsSubtotal = 0.0;
        $totalQty = 0;
        $decorationsUsed = [];

        foreach ($items as $item) {
            $qty = (int) $item['qty'];
            $dec = $item['decoration'] ?? 'none';
            $unit = self::unit($item, $qty, $dec);
            $sub = round($unit * $qty, 2);

            $itemsSubtotal += $sub;
            $totalQty += $qty;
            if ($dec !== 'none') {
                $decorationsUsed[$dec] = true;
            }

            $lines[] = array_merge($item, [
                'unit_price'     => $unit,
                'line_subtotal'  => $sub,
                'tier_label'     => config('pricing.tier_labels')[self::tierIndex($qty)],
            ]);
        }

        // One-time setup fees — charged once per decoration method used.
        $setupFees = [];
        foreach (array_keys($decorationsUsed) as $dec) {
            $d = self::decoration($dec);
            if (($d['setup'] ?? 0) > 0) {
                $setupFees[] = ['label' => $d['setup_label'], 'amount' => (float) $d['setup']];
            }
        }
        $setupTotal = array_sum(array_column($setupFees, 'amount'));

        $shipping = $totalQty > 0
            ? (float) (config('pricing.shipping')[self::tierIndex($totalQty)] ?? 0)
            : 0.0;

        if ($itemsSubtotal >= config('pricing.free_shipping_threshold', 500)) {
            $shipping = 0.0;
        }

        return [
            'lines'          => $lines,
            'items_subtotal' => round($itemsSubtotal, 2),
            'setup_fees'     => $setupFees,
            'setup_total'    => round($setupTotal, 2),
            'shipping'       => $shipping,
            'total_qty'      => $totalQty,
            'total'          => round($itemsSubtotal + $setupTotal + $shipping, 2),
        ];
    }
}
