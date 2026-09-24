<?php

/*
|--------------------------------------------------------------------------
| Product tags
|--------------------------------------------------------------------------
| Client's 2026-09 request: an option to mark caps as Back Order (BO --
| out of stock), New, Best Seller, or Liquidation, shown as a badge on
| the product, with a filterable section on the inventory page.
|
| A product picks these up via an optional `tags` array in
| config/products.php, e.g. 'tags' => ['best-seller', 'new']. None of
| the 21 catalog products have been tagged yet -- which caps count as
| new/best-seller/liquidation/back-order is a business call for the
| client to make, not something to guess. Add the key to a product's
| config entry once he says which ones.
|
| `blocks_ordering`: per his instruction, Back Order does NOT block
| Add to Cart / checkout -- it's informational only (ships once
| restocked), unlike the Canada-only shipping block.
*/

return [

    'new' => [
        'label'           => 'New',
        'badge_class'     => 'bg-brand-orange text-brand-dark',
        'blocks_ordering' => false,
    ],
    'best-seller' => [
        'label'           => 'Best Seller',
        'badge_class'     => 'bg-brand-dark text-white',
        'blocks_ordering' => false,
    ],
    'liquidation' => [
        'label'           => 'Liquidation',
        'badge_class'     => 'bg-red-600 text-white',
        'blocks_ordering' => false,
    ],
    'back-order' => [
        'label'           => 'Back Order',
        'badge_class'     => 'bg-gray-500 text-white',
        'blocks_ordering' => false,
    ],

];
