<?php

/*
|--------------------------------------------------------------------------
| Bulk / decoration pricing  (CapBeast Canada template)
|--------------------------------------------------------------------------
| Global rules that apply to every product. Per-product blank-cap prices
| live in config/products.php under each product's `pricing.tiers`.
|
| All amounts are in CAD.
|
| Quantity tiers (index 0/1/2):
|   0 → 12–72     1 → 73–144     2 → 145+
*/

return [

    'moq' => 12,   // minimum order quantity, per product line

    // [min, max] for each tier. max null = unbounded.
    'tier_bounds' => [
        [12, 72],
        [73, 144],
        [145, null],
    ],

    'tier_labels' => ['12–72', '73–144', '145+'],

    // Decoration methods. `unit` = added cost per cap for each tier.
    // `setup` = one-time fee, charged once per order when the method is used.
    'decoration' => [
        'none' => [
            'label'       => 'Blank — no decoration',
            'unit'        => [0, 0, 0],
            'setup'       => 0,
            'setup_label' => null,
        ],
        'embroidery' => [
            'label'       => 'Embroidery (up to 10,000 stitches)',
            'unit'        => [10, 7.5, 5],
            'setup'       => 30,
            'setup_label' => 'Embroidery digitizing (DST file)',
        ],
        'print' => [
            'label'       => 'DTF / Print',
            'unit'        => [8, 5, 3],
            'setup'       => 30,
            'setup_label' => 'Print setup',
            'warning'     => 'Be aware: if you choose a 6-panel cap, the stitches of the cap can be visible on the print.',
        ],
    ],

    // Shipping fee by quantity tier (total units across the order).
    'shipping' => [30, 40, 0],
];
