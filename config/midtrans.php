<?php

return [
    'merchant_id'   => env('MIDTRANS_MERCHANT_ID') ? trim(env('MIDTRANS_MERCHANT_ID')) : null,
    'client_key'     => env('MIDTRANS_CLIENT_KEY') ? trim(env('MIDTRANS_CLIENT_KEY')) : null,
    'server_key'     => env('MIDTRANS_SERVER_KEY') ? trim(env('MIDTRANS_SERVER_KEY')) : null,
    'is_production'  => filter_var(env('MIDTRANS_IS_PRODUCTION', false), FILTER_VALIDATE_BOOLEAN),
    'snap_url'       => filter_var(env('MIDTRANS_IS_PRODUCTION', false), FILTER_VALIDATE_BOOLEAN)
        ? 'https://app.midtrans.com/snap/snap.js'
        : 'https://app.sandbox.midtrans.com/snap/snap.js',
];
