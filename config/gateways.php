<?php

/*return [
    'Dummy',
    'Mollie',
    'PayPal_Express',
    'PayPal_ExpressInContext',
    'PayPal_Pro',
    'PayPal_Rest',
    'Stripe',
];*/
return [
    'paypal' => [
        'username' => env('PAYPAL_USERNAME'),
        'password' => env('PAYPAL_PASSWORD'),
        'signature' => env('PAYPAL_SIGNATURE'),
        'sandbox' => env('PAYPAL_SANDBOX'),
    ]
];