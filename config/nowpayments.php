<?php

return [
    /*
    |--------------------------------------------------------------------------
    | NowPayments API Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can configure your NowPayments API settings. 
    |
    */

    'api_key' => env('NOWPAYMENTS_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Sandbox Mode
    |--------------------------------------------------------------------------
    |
    | This option controls whether the API requests should be made to the sandbox
    | environment. Set this to true for testing purposes.
    |
    */

    'sandbox_mode' => env('NOWPAYMENTS_SANDBOX_MODE', false),

    /*
    |--------------------------------------------------------------------------
    | Default Currency
    |--------------------------------------------------------------------------
    |
    | This is the default currency that will be used for creating invoices.
    |
    */

    'currency' => env('NOWPAYMENTS_CURRENCY', 'USD'),
];
