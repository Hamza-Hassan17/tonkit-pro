<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

/**
 * Compares DB-sourced catalog output (Product::toLegacyArray()) against the
 * current config/products.php output, field-by-field, for every product.
 * Step 3 of the admin-panel plan -- must report zero diffs before
 * ProductController is cut over to read the DB.
 */
class VerifyCatalogImport extends Command
{
    protected $signature = 'catalog:verify-import';

    protected $description = 'Diff DB-sourced catalog output against config/products.php, field by field';

    public function handle(): int
    {
        $configProducts = collect(config('products.list', []))->keyBy('slug');
        $dbProducts = Product::with(['colors', 'tags'])->get()->keyBy('slug');

        $diffs = 0;

        if ($configProducts->count() !== $dbProducts->count()) {
            $this->error("Count mismatch: config has {$configProducts->count()}, DB has {$dbProducts->count()}.");
            $diffs++;
        }

        foreach ($configProducts as $slug => $configEntry) {
            $dbEntry = $dbProducts->get($slug);

            if (! $dbEntry) {
                $this->error("MISSING from DB: {$slug}");
                $diffs++;

                continue;
            }

            $dbArray = $dbEntry->toLegacyArray();

            // Normalize config entry to the same key set toLegacyArray()
            // produces (drop nothing extra, default tags like the model does).
            $configArray = [
                'slug'        => $configEntry['slug'],
                'name'        => $configEntry['name'],
                'brand'       => $configEntry['brand'] ?? 'CapBeast',
                'card_label'  => $configEntry['card_label'] ?? null,
                'price'       => (float) $configEntry['price'],
                'pricing'     => ['tiers' => array_map('floatval', $configEntry['pricing']['tiers'] ?? [$configEntry['price']])],
                'sku'         => $configEntry['sku'],
                'description' => $configEntry['description'],
                'specs'       => $configEntry['specs'] ?? [],
                'tags'        => $configEntry['tags'] ?? [],
                'colors'      => array_map(fn ($c) => [
                    'name' => $c['name'], 'slug' => $c['slug'], 'hex' => $c['hex'], 'image' => $c['image'],
                ], array_values($configEntry['colors'])),
            ];

            // Cast DB floats/tiers the same way for a fair comparison.
            $dbArray['price'] = (float) $dbArray['price'];
            $dbArray['pricing']['tiers'] = array_map('floatval', $dbArray['pricing']['tiers']);
            sort($dbArray['tags']);
            $configTags = $configArray['tags'];
            sort($configTags);
            $dbArray['tags'] = array_values($dbArray['tags']);
            $configArray['tags'] = array_values($configTags);

            if ($dbArray !== $configArray) {
                $this->error("DIFF on '{$slug}':");
                $this->line('  config: '.json_encode($configArray));
                $this->line('  db:     '.json_encode($dbArray));
                $diffs++;
            }
        }

        foreach ($dbProducts->keys() as $slug) {
            if (! $configProducts->has($slug)) {
                $this->warn("EXTRA in DB (not in config): {$slug}");
                $diffs++;
            }
        }

        if ($diffs === 0) {
            $this->info('✓ All '.$configProducts->count().' products match exactly. Safe to cut over.');

            return self::SUCCESS;
        }

        $this->error("{$diffs} diff(s) found. Do not cut over yet.");

        return self::FAILURE;
    }
}
