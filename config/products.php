<?php

/*
|--------------------------------------------------------------------------
| Static product catalog
|--------------------------------------------------------------------------
| There are 17 products and no admin panel, so this file IS the product
| database. Cart/orders still use the real DB (see migrations) because
| checkout is stateful.
|
| Each product has a list of `colors`. Every color carries its own image
| (public/images/products/<slug>/<color-slug>.png). The first color is
| used as the product's default/thumbnail image.
|
| Blank-cap prices are in CAD, quantity-tiered (see config/pricing.php for
| the tier bounds, decoration add-ons, setup fees and shipping).
| `price` is the entry unit price (tier 0), used for "from $X" on cards.
|
| CATALOG SOURCE (2026-09-11): 8 products come from the client's "ESIDE
| Authentics" image drop (Google Drive, top-level images only —
| 2-tone/3-tone/rope subfolder variants were intentionally excluded per
| his instruction). Specs are parsed straight from ESIDE's own filenames
| (profile/bill/panels/closure/material), which he said was fine to use
| as the description source.
|
| CATALOG SOURCE (2026-09-11, restored): 9 more products — the original
| YP Classics / Flexfit 110 blanks that were pulled earlier over a visible
| "YOUR LOGO" sticker mockup on their old photos. The client's own
| SS Activewear link (yp_classics/6606) confirmed these particular product
| photos are fine to use as-is: the tag visible on every shot is the
| real, sewn-in Yupoong/Flexfit manufacturer tag that ships on every blank
| unit of these models industry-wide — not a customization placeholder —
| so it was left alone. Restored from public/images/Cap Product images/
| (client-supplied), specs are standard published Yupoong/Flexfit catalog
| specs for these SKUs, not client-confirmed copy.
|
| PRICING: confirmed prices come from
| Product_Pricing_Template_CapBeast_CANADA.xlsx, matched by product name:
| A-Town, Deadstock Cord (~= "Corduroy"), Supreme Melton Wool (~= "Wool
| Painter"), the three "6606 TRUCKER HAT" variants (6606, 6606 two-tone,
| 6606 MultiCam — same base model, colourway only), the two "6506 TRUCKER
| HAT" variants (6506, 6506 two-tone), and 110M (single $15 tier). The
| remaining 8 products use a provisional placeholder tier (9/8.50/7.50,
| the sheet's generic trucker-hat rate) pending the client's real
| SKU/price sheet — flagged '@TODO price' below. Placeholder SKUs are
| CB-*.
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
            'card_label' => 'E.SIDE',
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
            'card_label' => 'E.SIDE',
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
            'card_label' => 'E.SIDE',
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
            'card_label' => 'E.SIDE',
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
            'card_label' => 'E.SIDE',
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
            'card_label' => 'E.SIDE',
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
            'card_label' => 'E.SIDE',
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
            'card_label' => 'E.SIDE',
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

        /* ---------------------------------------------------------------- 9 */
        [
            'slug'  => 'flexfit-110-mesh',
            'name'  => 'Flexfit 110 Mesh Snapback',
            'brand' => 'CapBeast',
            'price' => 15,
            'pricing' => $tiers(15), // confirmed — pricing sheet "110M"
            'sku'   => '110M',
            'description' => 'The Flexfit 110 in its mesh-back trucker build — structured mid-profile front panels with a breathable mesh back. One of the most-requested wholesale blanks for embroidery.',
            'specs' => [
                'Material' => 'Cotton Twill Front / Poly Mesh Back',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Curved',
                'Panels'   => '6',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Charcoal', 'slug' => 'charcoal', 'hex' => '#48484a', 'image' => $img('flexfit-110-mesh', 'charcoal.png')],
                ['name' => 'Black',    'slug' => 'black',    'hex' => '#1a1a1a', 'image' => $img('flexfit-110-mesh', 'black.png')],
                ['name' => 'Khaki',    'slug' => 'khaki',    'hex' => '#b6a582', 'image' => $img('flexfit-110-mesh', 'khaki.png')],
                ['name' => 'Navy',     'slug' => 'navy',     'hex' => '#1c2a3f', 'image' => $img('flexfit-110-mesh', 'navy.png')],
                ['name' => 'Red',      'slug' => 'red',      'hex' => '#b5202c', 'image' => $img('flexfit-110-mesh', 'red.png')],
                ['name' => 'White',    'slug' => 'white',    'hex' => '#f2f0ea', 'image' => $img('flexfit-110-mesh', 'white.png')],
            ],
        ],

        /* --------------------------------------------------------------- 10 */
        [
            'slug'  => 'yp-2026-rope-snapback',
            'name'  => 'Rope Trucker Snapback',
            'brand' => 'CapBeast',
            'price' => 9,
            'pricing' => $tiers(9, 8.5, 7.5), // @TODO price — not on the sheet, using default trucker rate
            'sku'   => 'CB-2026BK', // placeholder pending client SKU
            'description' => 'A 5-panel perforated snapback with a contrast braided rope trim along the closure — a relaxed, coastal take on the classic trucker.',
            'specs' => [
                'Material' => 'Poly-Cotton Twill (Perforated)',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Curved',
                'Panels'   => '5',
                'Closure'  => 'Snapback (Braided Rope Strap)',
            ],
            'colors' => [
                ['name' => 'White',        'slug' => 'white',        'hex' => '#f2f0ea', 'image' => $img('yp-2026-rope-snapback', 'white.png')],
                ['name' => 'Black',        'slug' => 'black',        'hex' => '#1a1a1a', 'image' => $img('yp-2026-rope-snapback', 'black.png')],
                ['name' => 'Heather Grey', 'slug' => 'heather-grey', 'hex' => '#9a9a9c', 'image' => $img('yp-2026-rope-snapback', 'heather-grey.png')],
                ['name' => 'Navy',         'slug' => 'navy',         'hex' => '#1c2a3f', 'image' => $img('yp-2026-rope-snapback', 'navy.png')],
            ],
        ],

        /* --------------------------------------------------------------- 11 */
        [
            'slug'  => 'yp-6506-2tone-trucker',
            'name'  => '6506 Two-Tone Trucker',
            'brand' => 'CapBeast',
            'price' => 9,
            'pricing' => $tiers(9, 8.5, 7.5), // confirmed — pricing sheet "6506 TRUCKER HAT"
            'sku'   => '6506T',
            'description' => 'The unstructured 6506 trucker in contrast two-tone colourways — low-profile 5-panel front with a curved brim and a relaxed, broken-in fit.',
            'specs' => [
                'Material' => 'Cotton Twill Front / Poly Mesh Back',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Low',
                'Bill'     => 'Curved',
                'Crown'    => 'Unstructured',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Navy / White',    'slug' => 'navy-white',    'hex' => '#1c2a3f', 'image' => $img('yp-6506-2tone-trucker', 'navy-white.png')],
                ['name' => 'Black / White',   'slug' => 'black-white',   'hex' => '#1a1a1a', 'image' => $img('yp-6506-2tone-trucker', 'black-white.png')],
                ['name' => 'Red / White',     'slug' => 'red-white',     'hex' => '#b5202c', 'image' => $img('yp-6506-2tone-trucker', 'red-white.png')],
                ['name' => 'Heather / Black', 'slug' => 'heather-black', 'hex' => '#6b6b6d', 'image' => $img('yp-6506-2tone-trucker', 'heather-black.png')],
                ['name' => 'Heather / White', 'slug' => 'heather-white', 'hex' => '#9a9a9c', 'image' => $img('yp-6506-2tone-trucker', 'heather-white.png')],
            ],
        ],

        /* --------------------------------------------------------------- 12 */
        [
            'slug'  => 'yp-6506-trucker',
            'name'  => '6506 Unstructured Trucker',
            'brand' => 'CapBeast',
            'price' => 9,
            'pricing' => $tiers(9, 8.5, 7.5), // confirmed — pricing sheet "6506 TRUCKER HAT"
            'sku'   => '6506',
            'description' => 'A low-profile, unstructured 5-panel trucker with a curved brim and soft, broken-in fit — a relaxed alternative to the structured 6606.',
            'specs' => [
                'Material' => 'Cotton Twill Front / Poly Mesh Back',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Low',
                'Bill'     => 'Curved',
                'Crown'    => 'Unstructured',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Khaki',    'slug' => 'khaki',    'hex' => '#b6a582', 'image' => $img('yp-6506-trucker', 'khaki.png')],
                ['name' => 'Black',    'slug' => 'black',    'hex' => '#1a1a1a', 'image' => $img('yp-6506-trucker', 'black.png')],
                ['name' => 'Charcoal', 'slug' => 'charcoal', 'hex' => '#48484a', 'image' => $img('yp-6506-trucker', 'charcoal.png')],
                ['name' => 'Navy',     'slug' => 'navy',     'hex' => '#1c2a3f', 'image' => $img('yp-6506-trucker', 'navy.png')],
                ['name' => 'Red',      'slug' => 'red',      'hex' => '#b5202c', 'image' => $img('yp-6506-trucker', 'red.png')],
                ['name' => 'White',    'slug' => 'white',    'hex' => '#f2f0ea', 'image' => $img('yp-6506-trucker', 'white.png')],
            ],
        ],

        /* --------------------------------------------------------------- 13 */
        [
            'slug'  => 'yp-5389-perforated-snapback',
            'name'  => '5389 Perforated Snapback',
            'brand' => 'CapBeast',
            'price' => 9,
            'pricing' => $tiers(9, 8.5, 7.5), // @TODO price — not on the sheet, using default trucker rate
            'sku'   => 'CB-5389AP', // placeholder pending client SKU
            'description' => 'A high-profile 5-panel snapback in perforated twill for extra breathability, with a flat brim for a sharp, structured look.',
            'specs' => [
                'Material' => 'Poly-Cotton Twill (Perforated)',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'High',
                'Bill'     => 'Flat',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Heather Grey', 'slug' => 'heather-grey', 'hex' => '#9a9a9c', 'image' => $img('yp-5389-perforated-snapback', 'heather-grey.png')],
                ['name' => 'Black',        'slug' => 'black',        'hex' => '#1a1a1a', 'image' => $img('yp-5389-perforated-snapback', 'black.png')],
                ['name' => 'Navy',         'slug' => 'navy',         'hex' => '#1c2a3f', 'image' => $img('yp-5389-perforated-snapback', 'navy.png')],
                ['name' => 'White',        'slug' => 'white',        'hex' => '#f2f0ea', 'image' => $img('yp-5389-perforated-snapback', 'white.png')],
            ],
        ],

        /* --------------------------------------------------------------- 14 */
        [
            'slug'  => 'yp-6606-multicam-trucker',
            'name'  => '6606 MultiCam Trucker',
            'brand' => 'CapBeast',
            'price' => 9,
            'pricing' => $tiers(9, 8.5, 7.5), // confirmed — pricing sheet "6606 TRUCKER HAT"
            'sku'   => '6606MC',
            'description' => 'The structured 6606 retro trucker in MultiCam camo twill — mid-profile 5-panel front, curved brim, mesh back.',
            'specs' => [
                'Material' => 'MultiCam Cotton Twill Front / Poly Mesh Back',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Curved',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Tropic Green',    'slug' => 'tropic-green',    'hex' => '#4f6b3a', 'image' => $img('yp-6606-multicam-trucker', 'tropic-green.png')],
                ['name' => 'MultiCam',        'slug' => 'multicam',        'hex' => '#6b6b4a', 'image' => $img('yp-6606-multicam-trucker', 'multicam.png')],
                ['name' => 'MultiCam Black',  'slug' => 'multicam-black',  'hex' => '#3a3a30', 'image' => $img('yp-6606-multicam-trucker', 'multicam-black.png')],
                ['name' => 'MultiCam Khaki',  'slug' => 'multicam-khaki',  'hex' => '#8a7d55', 'image' => $img('yp-6606-multicam-trucker', 'multicam-khaki.png')],
                ['name' => 'Arid Brown',      'slug' => 'arid-brown',      'hex' => '#8a6239', 'image' => $img('yp-6606-multicam-trucker', 'arid-brown.png')],
                ['name' => 'Alpine White',    'slug' => 'alpine-white',    'hex' => '#e8e4da', 'image' => $img('yp-6606-multicam-trucker', 'alpine-white.png')],
            ],
        ],

        /* --------------------------------------------------------------- 15 */
        [
            'slug'  => 'yp-6006-multicam-mesh',
            'name'  => '6006 MultiCam Mesh Trucker',
            'brand' => 'CapBeast',
            'price' => 9,
            'pricing' => $tiers(9, 8.5, 7.5), // @TODO price — not on the sheet, using default trucker rate
            'sku'   => 'CB-6006MC', // placeholder pending client SKU
            'description' => 'A flat-bill mesh trucker in MultiCam camo twill — mid-profile 5-panel front with a breathable mesh back.',
            'specs' => [
                'Material' => 'MultiCam Cotton Twill Front / Poly Mesh Back',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Flat',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Arid Tan',       'slug' => 'arid-tan',       'hex' => '#c9a876', 'image' => $img('yp-6006-multicam-mesh', 'arid-tan.png')],
                ['name' => 'MultiCam',       'slug' => 'multicam',       'hex' => '#6b6b4a', 'image' => $img('yp-6006-multicam-mesh', 'multicam.png')],
                ['name' => 'MultiCam Black', 'slug' => 'multicam-black', 'hex' => '#3a3a30', 'image' => $img('yp-6006-multicam-mesh', 'multicam-black.png')],
                ['name' => 'Arid Brown',     'slug' => 'arid-brown',     'hex' => '#8a6239', 'image' => $img('yp-6006-multicam-mesh', 'arid-brown.png')],
                ['name' => 'Alpine White',   'slug' => 'alpine-white',   'hex' => '#e8e4da', 'image' => $img('yp-6006-multicam-mesh', 'alpine-white.png')],
                ['name' => 'Tropic Green',   'slug' => 'tropic-green',   'hex' => '#4f6b3a', 'image' => $img('yp-6006-multicam-mesh', 'tropic-green.png')],
            ],
        ],

        /* --------------------------------------------------------------- 16 */
        [
            'slug'  => 'yp-6606-2tone-trucker',
            'name'  => '6606 Two-Tone Trucker',
            'brand' => 'CapBeast',
            'price' => 9,
            'pricing' => $tiers(9, 8.5, 7.5), // confirmed — pricing sheet "6606 TRUCKER HAT"
            'sku'   => '6606T',
            'description' => 'The structured 6606 retro trucker in contrast two-tone colourways — mid-profile 5-panel front, curved brim, mesh back.',
            'specs' => [
                'Material' => 'Cotton Twill Front / Poly Mesh Back',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Curved',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Red / Black',   'slug' => 'red-black',   'hex' => '#b5202c', 'image' => $img('yp-6606-2tone-trucker', 'red-black.png')],
                ['name' => 'Red / White',   'slug' => 'red-white',   'hex' => '#b5202c', 'image' => $img('yp-6606-2tone-trucker', 'red-white.png')],
                ['name' => 'Navy / White',  'slug' => 'navy-white',  'hex' => '#1c2a3f', 'image' => $img('yp-6606-2tone-trucker', 'navy-white.png')],
                ['name' => 'Black / White', 'slug' => 'black-white', 'hex' => '#1a1a1a', 'image' => $img('yp-6606-2tone-trucker', 'black-white.png')],
                ['name' => 'Moss / Khaki',  'slug' => 'moss-khaki',  'hex' => '#6b6b3a', 'image' => $img('yp-6606-2tone-trucker', 'moss-khaki.png')],
                ['name' => 'Brown / Khaki', 'slug' => 'brown-khaki', 'hex' => '#6b4a2f', 'image' => $img('yp-6606-2tone-trucker', 'brown-khaki.png')],
            ],
        ],

        /* --------------------------------------------------------------- 17 */
        [
            'slug'  => 'yp-6606-trucker',
            'name'  => '6606 Retro Trucker',
            'brand' => 'CapBeast',
            'price' => 9,
            'pricing' => $tiers(9, 8.5, 7.5), // confirmed — pricing sheet "6606 TRUCKER HAT"
            'sku'   => '6606',
            'description' => 'The classic structured retro trucker — mid-profile 5-panel cotton twill front, curved brim, mesh back. The flagship of the YP Classics line.',
            'specs' => [
                'Material' => 'Cotton Twill Front / Poly Mesh Back',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Curved',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Caramel',  'slug' => 'caramel',  'hex' => '#a4682f', 'image' => $img('yp-6606-trucker', 'caramel.png')],
                ['name' => 'Black',    'slug' => 'black',    'hex' => '#1a1a1a', 'image' => $img('yp-6606-trucker', 'black.png')],
                ['name' => 'Charcoal', 'slug' => 'charcoal', 'hex' => '#48484a', 'image' => $img('yp-6606-trucker', 'charcoal.png')],
                ['name' => 'Khaki',    'slug' => 'khaki',    'hex' => '#b6a582', 'image' => $img('yp-6606-trucker', 'khaki.png')],
                ['name' => 'Navy',     'slug' => 'navy',     'hex' => '#1c2a3f', 'image' => $img('yp-6606-trucker', 'navy.png')],
                ['name' => 'Pink',     'slug' => 'pink',     'hex' => '#e8a0b4', 'image' => $img('yp-6606-trucker', 'pink.png')],
                ['name' => 'Red',      'slug' => 'red',      'hex' => '#b5202c', 'image' => $img('yp-6606-trucker', 'red.png')],
                ['name' => 'Silver',   'slug' => 'silver',   'hex' => '#c0c0c2', 'image' => $img('yp-6606-trucker', 'silver.png')],
                ['name' => 'White',    'slug' => 'white',    'hex' => '#f2f0ea', 'image' => $img('yp-6606-trucker', 'white.png')],
            ],
        ],

    ],
];
