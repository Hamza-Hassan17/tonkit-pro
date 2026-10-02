<?php

/*
|--------------------------------------------------------------------------
| Canadian sales tax (GST / QST)
|--------------------------------------------------------------------------
| CapBeast is tax-registered in Quebec only (per the client, 2026-09-22).
| Per Canadian tax law, that means: charge GST + QST for orders where the
| customer's business is in Quebec, GST only everywhere else in Canada --
| we're not registered to collect provincial/harmonized tax (PST/HST) in
| other provinces, so none of that gets charged regardless of where the
| order ships.
|
| Rates verified 2026-10 against public CRA (GST) and Revenu Québec (QST)
| sources -- 5% federal GST is flat across all of Canada; 9.975% QST is
| Quebec-specific. Confirm with the client/his accountant before trusting
| these for real transactions if tax law changes or his registration
| status does.
|
| Applied to the full pre-tax total (items + setup fees + shipping),
| matching standard Canadian practice of shipping being taxable at the
| same rate as the goods.
*/

return [

    'gst_rate'          => 0.05,
    'qst_rate'          => 0.09975,
    'qst_province'      => 'Quebec', // only this province gets QST on top of GST

    'provinces' => [
        'Alberta', 'British Columbia', 'Manitoba', 'New Brunswick',
        'Newfoundland and Labrador', 'Northwest Territories', 'Nova Scotia',
        'Nunavut', 'Ontario', 'Prince Edward Island', 'Quebec',
        'Saskatchewan', 'Yukon',
    ],

];
