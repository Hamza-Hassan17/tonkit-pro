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
        'y'     => 38,
    ],
    'left-panel' => [
        'label' => 'Left Panel',
        'view'  => 'front',
        'x'     => 33,
        'y'     => 42,
    ],
    'right-panel' => [
        'label' => 'Right Panel',
        'view'  => 'front',
        'x'     => 67,
        'y'     => 42,
    ],
    'back' => [
        'label' => 'Back',
        'view'  => 'back',
        'x'     => 50,
        'y'     => 33,
    ],
    'left-side' => [
        'label'  => 'Left Side',
        'view'   => 'side',
        'mirror' => false,
        'x'      => 65,
        'y'      => 38,
    ],
    'right-side' => [
        'label'  => 'Right Side',
        'view'   => 'side',
        'mirror' => true,
        'x'      => 65,
        'y'      => 38,
    ],

];
