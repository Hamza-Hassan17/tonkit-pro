<?php

/*
|--------------------------------------------------------------------------
| Static product catalog
|--------------------------------------------------------------------------
| There are only 9 products and no admin panel, so this file IS the product
| database. Cart/orders still use the real DB (see migrations) because
| checkout is stateful.
|
| Each product has a list of `colors`. Every color carries its own image
| (public/images/products/<slug>/<color-slug>.webp). The first color is
| used as the product's default/thumbnail image.
|
| Blank-cap prices are in CAD, quantity-tiered (see config/pricing.php for
| the tier bounds, decoration add-ons, setup fees and shipping).
| `price` is the entry unit price (tier 0), used for "from $X" on cards.
|
| CATALOG SOURCE (2026-09-11): 8 of these 9 products come from the
| client's "ESIDE Authentics" image drop (Google Drive, top-level images
| only — 2-tone/3-tone/rope subfolder variants were intentionally excluded
| per his instruction). Specs below are parsed straight from ESIDE's own
| filenames (profile/bill/panels/closure/material), which he said was
| fine to use as the description source.
|
| PRICING: only 3 of the 8 have a confirmed price from
| Product_Pricing_Template_CapBeast_CANADA.xlsx, matched by product name:
| A-Town, Deadstock Cord (~= "Corduroy"), Supreme Melton Wool (~= "Wool
| Painter"). The other 5 use a provisional placeholder tier (9/8.50/7.50,
| the sheet's generic trucker-hat rate) pending his real SKU/price sheet
| — flagged '@TODO price' below. SKUs are placeholders (CB-*) for the
| same reason.
*/

$img = fn (string $slug, string $file) => "images/products/{$slug}/{$file}";

// [12–72, 73–144, 145+] unit prices; repeat the last value where only one price is known.
$tiers = fn (float $a, ?float $b = null, ?float $c = null) => [
    'tiers' => [$a, $b ?? $a, $c ?? $b ?? $a],
];

return [

    'currency'        => 'CAD',
    'currency_symbol' => '$',

    'list' => [

        /* ---------------------------------------------------------------- 1 */
        [
            'slug'  => 'a-town',
            'name'  => 'A-Town',
            'brand' => 'CapBeast',
            'price' => 7,
            'pricing' => $tiers(7, 6.75, 6.25), // confirmed — pricing sheet "A-TOWN"
            'sku'   => 'CB-ATOWN', // placeholder pending client SKU
            'description' => 'A mid-profile 6-panel mesh-back snapback with a curved brim — a clean, everyday trucker built for comfort and easy branding.',
            'specs' => [
                'Material' => 'Cotton Twill Front / Poly Mesh Back',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Curved',
                'Panels'   => '6',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Navy',                  'slug' => 'navy',                 'hex' => '#1c2a3f', 'image' => $img('a-town', 'navy.png')],
                ['name' => 'Black',                'slug' => 'black',                'hex' => '#1a1a1a', 'image' => $img('a-town', 'black.png')],
                ['name' => 'British Racing Green',  'slug' => 'british-racing-green', 'hex' => '#234023', 'image' => $img('a-town', 'british-racing-green.png')],
                ['name' => 'Coyote Brown',          'slug' => 'coyote-brown',         'hex' => '#7c5a3a', 'image' => $img('a-town', 'coyote-brown.png')],
                ['name' => 'Cream',                 'slug' => 'cream',                'hex' => '#f0e6d2', 'image' => $img('a-town', 'cream.png')],
                ['name' => 'Dark Heather',          'slug' => 'dark-heather',         'hex' => '#4a4a4a', 'image' => $img('a-town', 'dark-heather.png')],
                ['name' => 'Heather Grey',          'slug' => 'heather-grey',         'hex' => '#9a9a9c', 'image' => $img('a-town', 'heather-grey.png')],
                ['name' => 'Sage',                  'slug' => 'sage',                 'hex' => '#9caf88', 'image' => $img('a-town', 'sage.png')],
            ],
        ],

        /* ---------------------------------------------------------------- 2 */
        [
            'slug'  => 'deadstock-cord',
            'name'  => 'Deadstock Cord',
            'brand' => 'CapBeast',
            'price' => 9,
            'pricing' => $tiers(9, 8.75, 8), // confirmed — pricing sheet "CORDUROY"
            'sku'   => 'CB-CORD', // placeholder pending client SKU
            'description' => 'An unstructured, low-profile 5-panel snapback in deadstock corduroy — soft, broken-in texture with a relaxed curved brim.',
            'specs' => [
                'Material' => 'Corduroy (Deadstock)',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Low',
                'Bill'     => 'Curved',
                'Crown'    => 'Unstructured',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Caramel',  'slug' => 'caramel',  'hex' => '#a4682f', 'image' => $img('deadstock-cord', 'caramel.png')],
                ['name' => 'Black',    'slug' => 'black',    'hex' => '#1a1a1a', 'image' => $img('deadstock-cord', 'black.png')],
                ['name' => 'Charcoal', 'slug' => 'charcoal', 'hex' => '#48484a', 'image' => $img('deadstock-cord', 'charcoal.png')],
                ['name' => 'Khaki',    'slug' => 'khaki',    'hex' => '#b6a582', 'image' => $img('deadstock-cord', 'khaki.png')],
                ['name' => 'Navy',     'slug' => 'navy',     'hex' => '#1c2a3f', 'image' => $img('deadstock-cord', 'navy.png')],
            ],
        ],

        /* ---------------------------------------------------------------- 3 */
        [
            'slug'  => 'flat-head',
            'name'  => 'Flat Head',
            'brand' => 'CapBeast',
            'price' => 9,
            'pricing' => $tiers(9, 8.5, 7.5), // @TODO price — not on the sheet, using default trucker rate
            'sku'   => 'CB-FLATHEAD', // placeholder pending client SKU
            'description' => 'A high-profile 6-panel snapback with a flat brim for a modern, structured silhouette — a bold canvas for embroidery or print.',
            'specs' => [
                'Material' => 'Cotton Twill',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'High',
                'Bill'     => 'Flat',
                'Panels'   => '6',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Red',          'slug' => 'red',          'hex' => '#b5202c', 'image' => $img('flat-head', 'red.png')],
                ['name' => 'Black',        'slug' => 'black',        'hex' => '#1a1a1a', 'image' => $img('flat-head', 'black.png')],
                ['name' => 'Dark Grey',    'slug' => 'dark-grey',    'hex' => '#58585a', 'image' => $img('flat-head', 'dark-grey.png')],
                ['name' => 'Heather Grey', 'slug' => 'heather-grey', 'hex' => '#9a9a9c', 'image' => $img('flat-head', 'heather-grey.png')],
                ['name' => 'Navy',         'slug' => 'navy',         'hex' => '#1c2a3f', 'image' => $img('flat-head', 'navy.png')],
                ['name' => 'Sage',         'slug' => 'sage',         'hex' => '#9caf88', 'image' => $img('flat-head', 'sage.png')],
            ],
        ],

        /* ---------------------------------------------------------------- 4 */
        [
            'slug'  => 'king-peak-a-frame',
            'name'  => 'King Peak A-Frame',
            'brand' => 'CapBeast',
            'price' => 9,
            'pricing' => $tiers(9, 8.5, 7.5), // @TODO price — not on the sheet, using default trucker rate
            'sku'   => 'CB-KINGPEAK', // placeholder pending client SKU
            'description' => 'A high-profile A-frame snapback with a curved brim and a tall, peaked crown — the classic silhouette for a bold front-panel logo.',
            'specs' => [
                'Material' => 'Cotton Twill',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'High',
                'Bill'     => 'Curved',
                'Crown'    => 'A-Frame',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Spruce',   'slug' => 'spruce',   'hex' => '#2f4f3f', 'image' => $img('king-peak-a-frame', 'spruce.png')],
                ['name' => 'Black',    'slug' => 'black',    'hex' => '#1a1a1a', 'image' => $img('king-peak-a-frame', 'black.png')],
                ['name' => 'Charcoal', 'slug' => 'charcoal', 'hex' => '#48484a', 'image' => $img('king-peak-a-frame', 'charcoal.png')],
                ['name' => 'Navy',     'slug' => 'navy',     'hex' => '#1c2a3f', 'image' => $img('king-peak-a-frame', 'navy.png')],
            ],
        ],

        /* ---------------------------------------------------------------- 5 */
        [
            'slug'  => 'supreme-cotton',
            'name'  => 'Supreme Cotton',
            'brand' => 'CapBeast',
            'price' => 9,
            'pricing' => $tiers(9, 8.5, 7.5), // @TODO price — not on the sheet, using default trucker rate
            'sku'   => 'CB-SUPCOTTON', // placeholder pending client SKU
            'description' => 'An unstructured, high-profile 5-panel snapback in soft cotton twill with a flat brim — relaxed fit, clean lines.',
            'specs' => [
                'Material' => '100% Cotton Twill',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'High',
                'Bill'     => 'Flat',
                'Crown'    => 'Unstructured',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Olive',     'slug' => 'olive',     'hex' => '#6b6b3a', 'image' => $img('supreme-cotton', 'olive.png')],
                ['name' => 'Black',     'slug' => 'black',     'hex' => '#1a1a1a', 'image' => $img('supreme-cotton', 'black.png')],
                ['name' => 'Caramel',   'slug' => 'caramel',   'hex' => '#a4682f', 'image' => $img('supreme-cotton', 'caramel.png')],
                ['name' => 'Dark Grey', 'slug' => 'dark-grey', 'hex' => '#58585a', 'image' => $img('supreme-cotton', 'dark-grey.png')],
                ['name' => 'Khaki',     'slug' => 'khaki',     'hex' => '#b6a582', 'image' => $img('supreme-cotton', 'khaki.png')],
                ['name' => 'Maroon',    'slug' => 'maroon',    'hex' => '#6b1f2a', 'image' => $img('supreme-cotton', 'maroon.png')],
                ['name' => 'Navy',      'slug' => 'navy',      'hex' => '#1c2a3f', 'image' => $img('supreme-cotton', 'navy.png')],
            ],
        ],

        /* ---------------------------------------------------------------- 6 */
        [
            'slug'  => 'supreme-melton-wool',
            'name'  => 'Supreme Melton Wool',
            'brand' => 'CapBeast',
            'price' => 10,
            'pricing' => $tiers(10, 9.5, 9), // confirmed — pricing sheet "WOL PAINTER"
            'sku'   => 'CB-SUPWOOL', // placeholder pending client SKU
            'description' => 'The Supreme silhouette in premium melton wool — an unstructured, high-profile 5-panel snapback with real winter weight and texture.',
            'specs' => [
                'Material' => 'Melton Wool',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'High',
                'Bill'     => 'Flat',
                'Crown'    => 'Unstructured',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Dark Grey', 'slug' => 'dark-grey', 'hex' => '#58585a', 'image' => $img('supreme-melton-wool', 'dark-grey.png')],
                ['name' => 'Black',     'slug' => 'black',     'hex' => '#1a1a1a', 'image' => $img('supreme-melton-wool', 'black.png')],
            ],
        ],

        /* ---------------------------------------------------------------- 7 */
        [
            'slug'  => 'the-ace',
            'name'  => 'The Ace',
            'brand' => 'CapBeast',
            'price' => 9,
            'pricing' => $tiers(9, 8.5, 7.5), // @TODO price — not on the sheet, using default trucker rate
            'sku'   => 'CB-ACE', // placeholder pending client SKU
            'description' => 'A high-profile 7-panel snapback in perforated fabric for extra breathability, with a semi-curved brim for a sharp, athletic look.',
            'specs' => [
                'Material' => 'Perforated Polyester',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'High',
                'Bill'     => 'Semi-Curved',
                'Panels'   => '7',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Charcoal', 'slug' => 'charcoal', 'hex' => '#48484a', 'image' => $img('the-ace', 'charcoal.png')],
                ['name' => 'Black',    'slug' => 'black',    'hex' => '#1a1a1a', 'image' => $img('the-ace', 'black.png')],
                ['name' => 'Caramel',  'slug' => 'caramel',  'hex' => '#a4682f', 'image' => $img('the-ace', 'caramel.png')],
                ['name' => 'Navy',     'slug' => 'navy',     'hex' => '#1c2a3f', 'image' => $img('the-ace', 'navy.png')],
            ],
        ],

        /* ---------------------------------------------------------------- 8 */
        [
            'slug'  => 'the-cape-garment-wash',
            'name'  => 'The Cape Garment Wash',
            'brand' => 'CapBeast',
            'price' => 9,
            'pricing' => $tiers(9, 8.5, 7.5), // @TODO price — not on the sheet, using default trucker rate
            'sku'   => 'CB-CAPE', // placeholder pending client SKU
            'description' => 'A low-profile, unstructured 6-panel cap with a garment-washed finish for a broken-in look and feel, and an adjustable buckle closure.',
            'specs' => [
                'Material' => 'Garment-Washed Cotton Twill',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Low',
                'Bill'     => 'Curved',
                'Crown'    => 'Unstructured',
                'Panels'   => '6',
                'Closure'  => 'Buckle',
            ],
            'colors' => [
                ['name' => 'Crimson',               'slug' => 'crimson',              'hex' => '#a8192e', 'image' => $img('the-cape-garment-wash', 'crimson.png')],
                ['name' => 'Black',                'slug' => 'black',                'hex' => '#1a1a1a', 'image' => $img('the-cape-garment-wash', 'black.png')],
                ['name' => 'British Racing Green',  'slug' => 'british-racing-green', 'hex' => '#234023', 'image' => $img('the-cape-garment-wash', 'british-racing-green.png')],
                ['name' => 'Espresso',              'slug' => 'espresso',             'hex' => '#3b2a20', 'image' => $img('the-cape-garment-wash', 'espresso.png')],
                ['name' => 'Navy',                  'slug' => 'navy',                 'hex' => '#1c2a3f', 'image' => $img('the-cape-garment-wash', 'navy.png')],
            ],
        ],

        /* ------------------------------------------------------------------
         * "110 Mesh Snapback Cap" removed from the live catalog 2026-09-11.
         * Every photo we have for it carries a printed brand sticker/tag
         * (either "Your Logo" or a genuine Flexfit "110 Tech" tag) — the
         * client has repeatedly and explicitly said no stickers on the
         * site. Re-add once clean photography exists. Pricing sheet has
         * a confirmed $15 flat rate ("110M") ready to go when it does.
         * ---------------------------------------------------------------- */

    ],
];
