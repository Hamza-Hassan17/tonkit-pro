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
| Prices are in PKR (whole rupees).
*/

$img = fn (string $slug, string $file) => "images/products/{$slug}/{$file}";

return [

    'currency'        => 'PKR',
    'currency_symbol' => 'Rs',

    'list' => [

        /* ---------------------------------------------------------------- 1 */
        [
            'slug'  => 'yp-classics-retro-trucker-cap',
            'name'  => 'YP Classics Retro Trucker Cap',
            'brand' => 'YP Classics',
            'price' => 3000,
            'sku'   => 'YP-6606',
            'description' => 'The classic 6-panel retro trucker. Structured foam front panels, breathable poly-mesh back and a pre-curved visor, finished with a matching snapback closure. An everyday favourite that takes embroidery beautifully.',
            'specs' => [
                'Material' => '47% Cotton / 28% Nylon / 25% Polyester',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Pre-Curved',
                'Crown'    => 'Structured',
                'Panels'   => '6',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Red',      'slug' => 'red',      'hex' => '#b5202c', 'image' => $img('yp-classics-retro-trucker-cap', 'red.webp')],
                ['name' => 'Navy',     'slug' => 'navy',     'hex' => '#1c2a3f', 'image' => $img('yp-classics-retro-trucker-cap', 'navy.webp')],
                ['name' => 'Pink',     'slug' => 'pink',     'hex' => '#e6a9bd', 'image' => $img('yp-classics-retro-trucker-cap', 'pink.webp')],
                ['name' => 'Black',    'slug' => 'black',    'hex' => '#1a1a1a', 'image' => $img('yp-classics-retro-trucker-cap', 'black.webp')],
                ['name' => 'Khaki',    'slug' => 'khaki',    'hex' => '#b6a582', 'image' => $img('yp-classics-retro-trucker-cap', 'khaki.webp')],
                ['name' => 'White',    'slug' => 'white',    'hex' => '#f1f1f1', 'image' => $img('yp-classics-retro-trucker-cap', 'white.webp')],
                ['name' => 'Silver',   'slug' => 'silver',   'hex' => '#c4c7cc', 'image' => $img('yp-classics-retro-trucker-cap', 'silver.webp')],
                ['name' => 'Caramel',  'slug' => 'caramel',  'hex' => '#a4682f', 'image' => $img('yp-classics-retro-trucker-cap', 'caramel.webp')],
                ['name' => 'Charcoal', 'slug' => 'charcoal', 'hex' => '#48484a', 'image' => $img('yp-classics-retro-trucker-cap', 'charcoal.webp')],
            ],
        ],

        /* ---------------------------------------------------------------- 2 */
        [
            'slug'  => 'yp-classics-retro-trucker-cap-2-tone',
            'name'  => 'YP Classics Retro Trucker Cap — 2-Tone',
            'brand' => 'YP Classics',
            'price' => 3300,
            'sku'   => 'YP-6606T',
            'description' => 'The retro trucker in bold two-tone colourways. Contrast crown and mesh back give team kits and merch drops an instant identity, with the same structured fit and snapback closure.',
            'specs' => [
                'Material' => '47% Cotton / 28% Nylon / 25% Polyester',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Pre-Curved',
                'Crown'    => 'Structured',
                'Panels'   => '6',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Red / Black',    'slug' => 'red-black',    'hex' => '#b5202c', 'image' => $img('yp-classics-retro-trucker-cap-2-tone', 'red-black.webp')],
                ['name' => 'Red / White',    'slug' => 'red-white',    'hex' => '#b5202c', 'image' => $img('yp-classics-retro-trucker-cap-2-tone', 'red-white.webp')],
                ['name' => 'Loden / Khaki',  'slug' => 'loden-khaki',  'hex' => '#5c5637', 'image' => $img('yp-classics-retro-trucker-cap-2-tone', 'loden-khaki.webp')],
                ['name' => 'Navy / White',   'slug' => 'navy-white',   'hex' => '#1c2a3f', 'image' => $img('yp-classics-retro-trucker-cap-2-tone', 'navy-white.webp')],
                ['name' => 'Black / White',  'slug' => 'black-white',  'hex' => '#1a1a1a', 'image' => $img('yp-classics-retro-trucker-cap-2-tone', 'black-white.webp')],
            ],
        ],

        /* ---------------------------------------------------------------- 3 */
        [
            'slug'  => 'yp-classics-5-panel-retro-trucker-cap',
            'name'  => 'YP Classics 5-Panel Retro Trucker Cap',
            'brand' => 'YP Classics',
            'price' => 3200,
            'sku'   => 'YP-6506',
            'description' => 'A cleaner 5-panel take on the retro trucker. One uninterrupted front panel makes the perfect canvas for a centred logo, paired with a poly-mesh back and pre-curved visor.',
            'specs' => [
                'Material' => '47% Cotton / 28% Nylon / 25% Polyester',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Pre-Curved',
                'Crown'    => 'Structured',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Red',      'slug' => 'red',      'hex' => '#b5202c', 'image' => $img('yp-classics-5-panel-retro-trucker-cap', 'red.webp')],
                ['name' => 'Black',    'slug' => 'black',    'hex' => '#1a1a1a', 'image' => $img('yp-classics-5-panel-retro-trucker-cap', 'black.webp')],
                ['name' => 'Navy',     'slug' => 'navy',     'hex' => '#1c2a3f', 'image' => $img('yp-classics-5-panel-retro-trucker-cap', 'navy.webp')],
                ['name' => 'Khaki',    'slug' => 'khaki',    'hex' => '#b6a582', 'image' => $img('yp-classics-5-panel-retro-trucker-cap', 'khaki.webp')],
                ['name' => 'White',    'slug' => 'white',    'hex' => '#f1f1f1', 'image' => $img('yp-classics-5-panel-retro-trucker-cap', 'white.webp')],
                ['name' => 'Charcoal', 'slug' => 'charcoal', 'hex' => '#48484a', 'image' => $img('yp-classics-5-panel-retro-trucker-cap', 'charcoal.webp')],
            ],
        ],

        /* ---------------------------------------------------------------- 4 */
        [
            'slug'  => 'yp-classics-5-panel-retro-trucker-cap-2-tone',
            'name'  => 'YP Classics 5-Panel Retro Trucker Cap — 2-Tone',
            'brand' => 'YP Classics',
            'price' => 3400,
            'sku'   => 'YP-6506T',
            'description' => 'The 5-panel retro trucker with a contrast mesh back. Keeps the clean single-panel front for branding while adding a two-tone twist.',
            'specs' => [
                'Material' => '47% Cotton / 28% Nylon / 25% Polyester',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Pre-Curved',
                'Crown'    => 'Structured',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Red / White',     'slug' => 'red-white',     'hex' => '#b5202c', 'image' => $img('yp-classics-5-panel-retro-trucker-cap-2-tone', 'red-white.webp')],
                ['name' => 'Navy / White',    'slug' => 'navy-white',    'hex' => '#1c2a3f', 'image' => $img('yp-classics-5-panel-retro-trucker-cap-2-tone', 'navy-white.webp')],
                ['name' => 'Black / White',   'slug' => 'black-white',   'hex' => '#1a1a1a', 'image' => $img('yp-classics-5-panel-retro-trucker-cap-2-tone', 'black-white.webp')],
                ['name' => 'Heather / Black', 'slug' => 'heather-black', 'hex' => '#8f9094', 'image' => $img('yp-classics-5-panel-retro-trucker-cap-2-tone', 'heather-black.webp')],
                ['name' => 'Heather / White', 'slug' => 'heather-white', 'hex' => '#b9bbbe', 'image' => $img('yp-classics-5-panel-retro-trucker-cap-2-tone', 'heather-white.webp')],
            ],
        ],

        /* ---------------------------------------------------------------- 5 */
        [
            'slug'  => 'yp-classics-5-panel-snapback-perforated',
            'name'  => 'YP Classics 5-Panel Snapback Cap with Perforation',
            'brand' => 'YP Classics',
            'price' => 3800,
            'sku'   => 'YP-5389AP',
            'description' => 'Made from lightweight polyester with perforated panels for breathability — the perfect cap for everyday use. The large front panel is the ideal canvas for embellishment, with 8 rows of thick stitching on the bill, a matching snapback closure and a black underbill.',
            'specs' => [
                'Material' => '95% Polyester / 5% PU Spandex',
                'Size'     => 'One Size (OSFA)',
                'Profile'  => 'High',
                'Bill'     => 'Pre-Curved',
                'Crown'    => '4" High',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Navy',         'slug' => 'navy',         'hex' => '#1c2a3f', 'code' => '19-4025', 'image' => $img('yp-classics-5-panel-snapback-perforated', 'navy.webp')],
                ['name' => 'Black',        'slug' => 'black',        'hex' => '#1a1a1a', 'code' => '19-4203', 'image' => $img('yp-classics-5-panel-snapback-perforated', 'black.webp')],
                ['name' => 'White',        'slug' => 'white',        'hex' => '#f1f1f1', 'code' => '11-0601', 'image' => $img('yp-classics-5-panel-snapback-perforated', 'white.webp')],
                ['name' => 'Heather Grey', 'slug' => 'heather-grey', 'hex' => '#9a9a9c', 'code' => '18-5105', 'image' => $img('yp-classics-5-panel-snapback-perforated', 'heather-grey.webp')],
            ],
        ],

        /* ---------------------------------------------------------------- 6 */
        [
            'slug'  => 'yp-classics-5-panel-snapback-braided-rope',
            'name'  => 'YP Classics 5-Panel Snapback Cap with Perforation & Braided Rope',
            'brand' => 'YP Classics',
            'price' => 4200,
            'sku'   => 'YP-2026BK',
            'description' => 'Crafted from lightweight perforated panels for breathability, with a braided rope trim on the bill, a matching snapback closure and a black underbill. The large flat front panel is ideal for embellishment.',
            'specs' => [
                'Material' => '95% Polyester / 5% PU Spandex',
                'Size'     => 'One Size (OSFA)',
                'Profile'  => 'High',
                'Bill'     => 'Pre-Curved',
                'Crown'    => '4" High',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Navy',         'slug' => 'navy',         'hex' => '#1c2a3f', 'image' => $img('yp-classics-5-panel-snapback-braided-rope', 'navy.webp')],
                ['name' => 'Black',        'slug' => 'black',        'hex' => '#1a1a1a', 'image' => $img('yp-classics-5-panel-snapback-braided-rope', 'black.webp')],
                ['name' => 'White',        'slug' => 'white',        'hex' => '#f1f1f1', 'image' => $img('yp-classics-5-panel-snapback-braided-rope', 'white.webp')],
                ['name' => 'Heather Grey', 'slug' => 'heather-grey', 'hex' => '#9a9a9c', 'image' => $img('yp-classics-5-panel-snapback-braided-rope', 'heather-grey.webp')],
            ],
        ],

        /* ---------------------------------------------------------------- 7 */
        [
            'slug'  => 'yp-classics-multicam-retro-trucker-cap',
            'name'  => 'YP Classics MultiCam Retro Trucker Cap',
            'brand' => 'YP Classics',
            'price' => 4500,
            'sku'   => 'YP-6606MC',
            'description' => 'The retro trucker in licensed MultiCam® camouflage. Structured front panels, poly-mesh back and a pre-curved visor — a tactical-leaning look for the outdoors crowd.',
            'specs' => [
                'Material' => '60% Cotton / 40% Polyester (Mesh Back)',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Pre-Curved',
                'Crown'    => 'Structured',
                'Panels'   => '6',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'MultiCam Tropic',     'slug' => 'multicam-tropic',     'hex' => '#5a6b3c', 'image' => $img('yp-classics-multicam-retro-trucker-cap', 'multicam-tropic.webp')],
                ['name' => 'MultiCam',            'slug' => 'multicam',            'hex' => '#7d7048', 'image' => $img('yp-classics-multicam-retro-trucker-cap', 'multicam.webp')],
                ['name' => 'MultiCam Black',      'slug' => 'multicam-black',      'hex' => '#2b2b2b', 'image' => $img('yp-classics-multicam-retro-trucker-cap', 'multicam-black.webp')],
                ['name' => 'MultiCam Arid',       'slug' => 'multicam-arid',       'hex' => '#b1a17c', 'image' => $img('yp-classics-multicam-retro-trucker-cap', 'multicam-arid.webp')],
                ['name' => 'MultiCam Arid / Black','slug' => 'multicam-arid-black','hex' => '#8a7550', 'image' => $img('yp-classics-multicam-retro-trucker-cap', 'multicam-arid-black.webp')],
                ['name' => 'MultiCam Alpine',     'slug' => 'multicam-alpine',     'hex' => '#d8d8d4', 'image' => $img('yp-classics-multicam-retro-trucker-cap', 'multicam-alpine.webp')],
            ],
        ],

        /* ---------------------------------------------------------------- 8 */
        [
            'slug'  => 'yp-classics-multicam-trucker-mesh-cap',
            'name'  => 'YP Classics MultiCam Trucker Mesh Cap',
            'brand' => 'YP Classics',
            'price' => 4300,
            'sku'   => 'YP-6006MC',
            'description' => 'A lighter, flat-bill build with a full poly-mesh back for maximum airflow, licensed MultiCam® front panels and a snapback closure.',
            'specs' => [
                'Material' => '60% Cotton / 40% Polyester (Full Mesh Back)',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Flat',
                'Crown'    => 'Structured',
                'Panels'   => '6',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'MultiCam',            'slug' => 'multicam',            'hex' => '#7d7048', 'image' => $img('yp-classics-multicam-trucker-mesh-cap', 'multicam.webp')],
                ['name' => 'MultiCam Black',      'slug' => 'multicam-black',      'hex' => '#2b2b2b', 'image' => $img('yp-classics-multicam-trucker-mesh-cap', 'multicam-black.webp')],
                ['name' => 'MultiCam Arid',       'slug' => 'multicam-arid',       'hex' => '#b1a17c', 'image' => $img('yp-classics-multicam-trucker-mesh-cap', 'multicam-arid.webp')],
                ['name' => 'MultiCam Arid / Black','slug' => 'multicam-arid-black','hex' => '#8a7550', 'image' => $img('yp-classics-multicam-trucker-mesh-cap', 'multicam-arid-black.webp')],
                ['name' => 'MultiCam Alpine',     'slug' => 'multicam-alpine',     'hex' => '#d8d8d4', 'image' => $img('yp-classics-multicam-trucker-mesh-cap', 'multicam-alpine.webp')],
                ['name' => 'MultiCam Tropic',     'slug' => 'multicam-tropic',     'hex' => '#5a6b3c', 'image' => $img('yp-classics-multicam-trucker-mesh-cap', 'multicam-tropic.webp')],
            ],
        ],

        /* ---------------------------------------------------------------- 9 */
        [
            'slug'  => '110-mesh-snapback-cap',
            'name'  => '110 Mesh Snapback Cap',
            'brand' => 'TonKit.Pro',
            'price' => 2900,
            'sku'   => 'TK-110M',
            'description' => 'A structured, mid-profile mesh-back trucker with an adjustable snapback and a pre-curved visor. Comfortable one-size fit with a clean front panel for embellishment.',
            'specs' => [
                'Material' => '63% Polyester / 34% Cotton / 3% Elastane',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Pre-Curved',
                'Crown'    => 'Structured',
                'Panels'   => '6',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Khaki',    'slug' => 'khaki',    'hex' => '#b6a582', 'image' => $img('110-mesh-snapback-cap', 'khaki.webp')],
                ['name' => 'Charcoal', 'slug' => 'charcoal', 'hex' => '#48484a', 'image' => $img('110-mesh-snapback-cap', 'charcoal.webp')],
                ['name' => 'White',    'slug' => 'white',    'hex' => '#f1f1f1', 'image' => $img('110-mesh-snapback-cap', 'white.webp')],
                ['name' => 'Black',    'slug' => 'black',    'hex' => '#1a1a1a', 'image' => $img('110-mesh-snapback-cap', 'black.webp')],
                ['name' => 'Navy',     'slug' => 'navy',     'hex' => '#1c2a3f', 'image' => $img('110-mesh-snapback-cap', 'navy.webp')],
                ['name' => 'Red',      'slug' => 'red',      'hex' => '#b5202c', 'image' => $img('110-mesh-snapback-cap', 'red.webp')],
            ],
        ],

    ],
];
