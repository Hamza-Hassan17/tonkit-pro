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
| (public/images/products/<slug>/<color-slug>.<ext>). The first color is
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
                'Bill'     => 'Slightly Curved',
                'Crown'    => 'Structured',
                'Panels'   => '6',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Red',      'slug' => 'red',      'hex' => '#c0392b', 'image' => $img('yp-classics-retro-trucker-cap', 'red.webp')],
                ['name' => 'Navy',     'slug' => 'navy',     'hex' => '#1f2a44', 'image' => $img('yp-classics-retro-trucker-cap', 'navy.webp')],
                ['name' => 'Black',    'slug' => 'black',    'hex' => '#1a1a1a', 'image' => $img('yp-classics-retro-trucker-cap', 'black.webp')],
                ['name' => 'White',    'slug' => 'white',    'hex' => '#f2f2f2', 'image' => $img('yp-classics-retro-trucker-cap', 'white.webp')],
                ['name' => 'Khaki',    'slug' => 'khaki',    'hex' => '#b6a582', 'image' => $img('yp-classics-retro-trucker-cap', 'khaki.webp')],
                ['name' => 'Charcoal', 'slug' => 'charcoal', 'hex' => '#4a4a4a', 'image' => $img('yp-classics-retro-trucker-cap', 'charcoal.webp')],
                ['name' => 'Silver',   'slug' => 'silver',   'hex' => '#c9cdd2', 'image' => $img('yp-classics-retro-trucker-cap', 'silver.webp')],
                ['name' => 'Caramel',  'slug' => 'caramel',  'hex' => '#a86b3c', 'image' => $img('yp-classics-retro-trucker-cap', 'caramel.webp')],
                ['name' => 'Pink',     'slug' => 'pink',     'hex' => '#e8b3c3', 'image' => $img('yp-classics-retro-trucker-cap', 'pink.webp')],
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
                'Bill'     => 'Slightly Curved',
                'Crown'    => 'Structured',
                'Panels'   => '6',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Red / Black',   'slug' => 'red-black',   'hex' => '#c0392b', 'image' => $img('yp-classics-retro-trucker-cap-2-tone', 'red-black.webp')],
                ['name' => 'Red / White',   'slug' => 'red-white',   'hex' => '#c0392b', 'image' => $img('yp-classics-retro-trucker-cap-2-tone', 'red-white.webp')],
                ['name' => 'Navy / White',  'slug' => 'navy-white',  'hex' => '#1f2a44', 'image' => $img('yp-classics-retro-trucker-cap-2-tone', 'navy-white.webp')],
                ['name' => 'Black / White', 'slug' => 'black-white', 'hex' => '#1a1a1a', 'image' => $img('yp-classics-retro-trucker-cap-2-tone', 'black-white.webp')],
                ['name' => 'Moss / Khaki',  'slug' => 'moss-khaki',  'hex' => '#6e6a4b', 'image' => $img('yp-classics-retro-trucker-cap-2-tone', 'moss-khaki.webp')],
                ['name' => 'Brown / Khaki', 'slug' => 'brown-khaki', 'hex' => '#7a5f43', 'image' => $img('yp-classics-retro-trucker-cap-2-tone', 'brown-khaki.webp')],
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
                'Bill'     => 'Slightly Curved',
                'Crown'    => 'Structured',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Red',      'slug' => 'red',      'hex' => '#c0392b', 'image' => $img('yp-classics-5-panel-retro-trucker-cap', 'red.webp')],
                ['name' => 'Navy',     'slug' => 'navy',     'hex' => '#1f2a44', 'image' => $img('yp-classics-5-panel-retro-trucker-cap', 'navy.webp')],
                ['name' => 'Black',    'slug' => 'black',    'hex' => '#1a1a1a', 'image' => $img('yp-classics-5-panel-retro-trucker-cap', 'black.webp')],
                ['name' => 'White',    'slug' => 'white',    'hex' => '#f2f2f2', 'image' => $img('yp-classics-5-panel-retro-trucker-cap', 'white.webp')],
                ['name' => 'Khaki',    'slug' => 'khaki',    'hex' => '#b6a582', 'image' => $img('yp-classics-5-panel-retro-trucker-cap', 'khaki.webp')],
                ['name' => 'Charcoal', 'slug' => 'charcoal', 'hex' => '#4a4a4a', 'image' => $img('yp-classics-5-panel-retro-trucker-cap', 'charcoal.webp')],
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
                'Bill'     => 'Slightly Curved',
                'Crown'    => 'Structured',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Red / White',       'slug' => 'red-white',      'hex' => '#c0392b', 'image' => $img('yp-classics-5-panel-retro-trucker-cap-2-tone', 'red-white.webp')],
                ['name' => 'Navy / White',      'slug' => 'navy-white',     'hex' => '#1f2a44', 'image' => $img('yp-classics-5-panel-retro-trucker-cap-2-tone', 'navy-white.webp')],
                ['name' => 'Black / White',     'slug' => 'black-white',    'hex' => '#1a1a1a', 'image' => $img('yp-classics-5-panel-retro-trucker-cap-2-tone', 'black-white.webp')],
                ['name' => 'Heather / Black',   'slug' => 'heather-black',  'hex' => '#6b6b6b', 'image' => $img('yp-classics-5-panel-retro-trucker-cap-2-tone', 'heather-black.webp')],
                ['name' => 'Heather / White',   'slug' => 'heather-white',  'hex' => '#cfcfcf', 'image' => $img('yp-classics-5-panel-retro-trucker-cap-2-tone', 'heather-white.webp')],
            ],
        ],

        /* ---------------------------------------------------------------- 5 */
        [
            'slug'  => 'yp-classics-5-panel-snapback-perforated',
            'name'  => 'YP Classics 5-Panel Snapback Cap with Perforations',
            'brand' => 'YP Classics',
            'price' => 3800,
            'sku'   => 'YP-5389AP',
            'description' => 'A flat-bill 5-panel snapback built from lightweight perforated polyester for all-day breathability. Structured crown, matching snapback closure and a clean front panel for embellishment.',
            'specs' => [
                'Material' => '100% Polyester (Perforated)',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Flat',
                'Crown'    => 'Structured',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Navy',         'slug' => 'navy',         'hex' => '#1f2a44', 'image' => $img('yp-classics-5-panel-snapback-perforated', 'navy.webp')],
                ['name' => 'Black',        'slug' => 'black',        'hex' => '#1a1a1a', 'image' => $img('yp-classics-5-panel-snapback-perforated', 'black.webp')],
                ['name' => 'White',        'slug' => 'white',        'hex' => '#f2f2f2', 'image' => $img('yp-classics-5-panel-snapback-perforated', 'white.webp')],
                ['name' => 'Heather Grey', 'slug' => 'heather-grey', 'hex' => '#a7a7a7', 'image' => $img('yp-classics-5-panel-snapback-perforated', 'heather-grey.webp')],
            ],
        ],

        /* ---------------------------------------------------------------- 6 */
        [
            'slug'  => 'yp-classics-5-panel-snapback-braided-rope',
            'name'  => 'YP Classics 5-Panel Snapback Cap with Perforations & Braided Rope',
            'brand' => 'YP Classics',
            'price' => 4200,
            'sku'   => 'YP-2026BK',
            'description' => 'Crafted from lightweight perforated panels for breathability, with a rope trim on the bill, matching snapback closure and a black underbill. The large flat front panel is ideal for embellishment.',
            'specs' => [
                'Material' => '80% Polyester / 20% PU (Pinwale)',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Flat',
                'Crown'    => 'Structured',
                'Panels'   => '5',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Navy',         'slug' => 'navy',         'hex' => '#1f2a44', 'image' => $img('yp-classics-5-panel-snapback-braided-rope', 'navy.png')],
                ['name' => 'Black',        'slug' => 'black',        'hex' => '#1a1a1a', 'image' => $img('yp-classics-5-panel-snapback-braided-rope', 'black.png')],
                ['name' => 'White',        'slug' => 'white',        'hex' => '#f2f2f2', 'image' => $img('yp-classics-5-panel-snapback-braided-rope', 'white.png')],
                ['name' => 'Heather Grey', 'slug' => 'heather-grey', 'hex' => '#a7a7a7', 'image' => $img('yp-classics-5-panel-snapback-braided-rope', 'heather-grey.png')],
            ],
        ],

        /* ---------------------------------------------------------------- 7 */
        [
            'slug'  => 'yp-classics-multicam-retro-trucker-cap',
            'name'  => 'YP Classics MultiCam Retro Trucker Cap',
            'brand' => 'YP Classics',
            'price' => 4500,
            'sku'   => 'YP-6606MC',
            'description' => 'The retro trucker in genuine licensed MultiCam® camouflage. Structured front panels, poly-mesh back and pre-curved visor — a tactical-leaning look for the outdoors crowd.',
            'specs' => [
                'Material' => '60% Cotton / 40% Polyester (Mesh Back)',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Slightly Curved',
                'Crown'    => 'Structured',
                'Panels'   => '6',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'MultiCam',        'slug' => 'multicam',       'hex' => '#8a7d5c', 'image' => $img('yp-classics-multicam-retro-trucker-cap', 'multicam.webp')],
                ['name' => 'MultiCam Black',  'slug' => 'multicam-black', 'hex' => '#2e2e2e', 'image' => $img('yp-classics-multicam-retro-trucker-cap', 'multicam-black.webp')],
                ['name' => 'MultiCam Khaki',  'slug' => 'multicam-khaki', 'hex' => '#b1a17c', 'image' => $img('yp-classics-multicam-retro-trucker-cap', 'multicam-khaki.webp')],
                ['name' => 'Arid Brown',      'slug' => 'arid-brown',     'hex' => '#6f5334', 'image' => $img('yp-classics-multicam-retro-trucker-cap', 'arid-brown.webp')],
                ['name' => 'Alpine White',    'slug' => 'alpine-white',   'hex' => '#d9d8cc', 'image' => $img('yp-classics-multicam-retro-trucker-cap', 'alpine-white.webp')],
                ['name' => 'Tropic Green',    'slug' => 'tropic-green',   'hex' => '#45543a', 'image' => $img('yp-classics-multicam-retro-trucker-cap', 'tropic-green.webp')],
            ],
        ],

        /* ---------------------------------------------------------------- 8 */
        [
            'slug'  => 'yp-classics-multicam-trucker-mesh-cap',
            'name'  => 'YP Classics MultiCam Trucker Mesh Cap',
            'brand' => 'YP Classics',
            'price' => 4300,
            'sku'   => 'YP-6006MC',
            'description' => 'A lighter, more open build than the retro trucker — full poly-mesh back for maximum airflow, licensed MultiCam® front panels and a snapback closure.',
            'specs' => [
                'Material' => '60% Cotton / 40% Polyester (Full Mesh Back)',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Slightly Curved',
                'Crown'    => 'Structured',
                'Panels'   => '6',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'MultiCam',       'slug' => 'multicam',       'hex' => '#8a7d5c', 'image' => $img('yp-classics-multicam-trucker-mesh-cap', 'multicam.webp')],
                ['name' => 'MultiCam Black', 'slug' => 'multicam-black', 'hex' => '#2e2e2e', 'image' => $img('yp-classics-multicam-trucker-mesh-cap', 'multicam-black.webp')],
                ['name' => 'Arid Tan',       'slug' => 'arid-tan',       'hex' => '#b99b74', 'image' => $img('yp-classics-multicam-trucker-mesh-cap', 'arid-tan.webp')],
                ['name' => 'Arid Brown',     'slug' => 'arid-brown',     'hex' => '#6f5334', 'image' => $img('yp-classics-multicam-trucker-mesh-cap', 'arid-brown.webp')],
                ['name' => 'Alpine White',   'slug' => 'alpine-white',   'hex' => '#d9d8cc', 'image' => $img('yp-classics-multicam-trucker-mesh-cap', 'alpine-white.webp')],
                ['name' => 'Tropic Green',   'slug' => 'tropic-green',   'hex' => '#45543a', 'image' => $img('yp-classics-multicam-trucker-mesh-cap', 'tropic-green.webp')],
            ],
        ],

        /* ---------------------------------------------------------------- 9 */
        [
            'slug'  => 'flexfit-110-mesh-cap',
            'name'  => 'Flexfit 110 Mesh Cap',
            'brand' => 'Flexfit',
            'price' => 2900,
            'sku'   => 'FF-110M',
            'description' => 'The Flexfit 110 in a mesh-back build — a structured, mid-profile trucker with an adjustable snapback and Flexfit\'s permacurv visor. Comfortable one-size fit with a clean front panel.',
            'specs' => [
                'Material' => '63% Polyester / 34% Cotton / 3% Elastane',
                'Size'     => 'One Size (Adjustable)',
                'Profile'  => 'Mid',
                'Bill'     => 'Slightly Curved (Permacurv)',
                'Crown'    => 'Structured',
                'Panels'   => '6',
                'Closure'  => 'Snapback',
            ],
            'colors' => [
                ['name' => 'Red',      'slug' => 'red',      'hex' => '#c0392b', 'image' => $img('flexfit-110-mesh-cap', 'red.webp')],
                ['name' => 'Navy',     'slug' => 'navy',     'hex' => '#1f2a44', 'image' => $img('flexfit-110-mesh-cap', 'navy.webp')],
                ['name' => 'Black',    'slug' => 'black',    'hex' => '#1a1a1a', 'image' => $img('flexfit-110-mesh-cap', 'black.webp')],
                ['name' => 'White',    'slug' => 'white',    'hex' => '#f2f2f2', 'image' => $img('flexfit-110-mesh-cap', 'white.webp')],
                ['name' => 'Charcoal', 'slug' => 'charcoal', 'hex' => '#4a4a4a', 'image' => $img('flexfit-110-mesh-cap', 'charcoal.webp')],
                ['name' => 'Khaki',    'slug' => 'khaki',    'hex' => '#b6a582', 'image' => $img('flexfit-110-mesh-cap', 'khaki.webp')],
            ],
        ],

    ],
];
