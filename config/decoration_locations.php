<?php

/*
|--------------------------------------------------------------------------
| Decoration locations
|--------------------------------------------------------------------------
| Client wants the customer to pick WHERE on the cap their embroidery/DTF
| goes, shown as a "CB" monogram (CapBeast initials) on a cap diagram
| instead of a plain square marker, per his 2026-09 chat:
|   "use the CB of the capbeat logo to demonstrate where people can do
|    the decoration and select the appropriate position"
| Same 6 locations apply to both embroidery and DTF -- he confirmed
| "Yes all decoration are the same for DTF and Embroidery."
|
| Only 3 cap "views" are needed to cover all 6 locations, per his
| instruction: a front view reused for center/left-panel/right-panel
| (marker moved each time), a back view, and a side view mirrored for
| the opposite side. `x`/`y` are the marker's position as a percentage
| of the diagram's viewBox, tuned to sit on the panel/side described.
|
| 2026-09-23: values were Rohan's own DevTools-measured positions against
| the rendered picker -- trust measured values like that over recomputed
| geometry when he sends them.
| 2026-10-01: client flagged all 6 as sitting too high/near the top seam
| (screenshot with circles marking where they should go instead -- lower,
| more centered on the crown, like a real embroidered logo placement).
| First shifted from a visual read of that screenshot, then corrected
| same-day with his own DevTools-measured mobile-view values (below) --
| trust these. Same positions are used for web view too, per his
| instruction; only the CB badge's size grows on larger screens (see
| resources/views/components/cb-marker.blade.php).
| One wrinkle either way: `right-side` renders mirrored (see
| resources/views/products/show.blade.php, which flips the marker's x as
| `100 - x` to match the CSS-mirrored SVG), so its `x` here is
| `100 - <the rendered/target position>`, not the rendered position itself.
|
| These are flat illustrated diagrams, not real product photography --
| his own original reference (a generic grey cap graphic) used the same
| approach. Swapping in real S&S Activewear photos later is a follow-up
| once he sends/approves specific images; the picker itself doesn't
| need to change to make that swap.
*/

return [

    'center' => [
        'label' => 'Center (Front)',
        'view'  => 'front',
        'x'     => 50,
        'y'     => 42,
    ],
    'left-panel' => [
        'label' => 'Left Panel',
        'view'  => 'front',
        'x'     => 40,
        'y'     => 38,
    ],
    'right-panel' => [
        'label' => 'Right Panel',
        'view'  => 'front',
        'x'     => 63,
        'y'     => 40,
    ],
    'back' => [
        'label' => 'Back',
        'view'  => 'back',
        'x'     => 49,
        'y'     => 31,
    ],
    'left-side' => [
        'label'  => 'Left Side',
        'view'   => 'side',
        'mirror' => false,
        'x'      => 47,
        'y'      => 39,
    ],
    'right-side' => [
        'label'  => 'Right Side',
        'view'   => 'side',
        'mirror' => true,
        'x'      => 51, // renders at 100-51=49
        'y'      => 38,
    ],

];
