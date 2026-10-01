<?php

/*
|--------------------------------------------------------------------------
| Discount codes
|--------------------------------------------------------------------------
| Simple sitewide percent-off codes, entered in the cart. No expiry or
| usage-limit tracking yet -- client asked for "simple sitewide % off
| code(s) for now" (2026-09-24), can extend later (expiry dates, per-code
| usage caps, minimum order value, per-product restrictions) once he
| wants that.
|
| Applies to the items subtotal only (caps + decoration) -- not setup
| fees or shipping. Codes are case-insensitive (normalized to uppercase
| when checked/stored).
|
| No real codes configured yet -- which codes exist and what they're
| worth is a business decision for the client, not something to invent.
| Add them here once he says, e.g.:
|   'codes' => ['WELCOME10' => 10, 'TEAM15' => 15],
*/

return [

    'codes' => [
        // 'CODE' => percent_off (0-100),
    ],

];
