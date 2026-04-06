<?php

return [
    'env' => env('MPESA_ENV', 'sandbox'),
    'consumer_key' => env('MPESA_CONSUMER_KEY'),
    'consumer_secret' => env('MPESA_CONSUMER_SECRET'),
    'shortcode' => env('MPESA_SHORTCODE'),
    'passkey' => env('MPESA_PASSKEY'),
    'callback_url' => env('MPESA_CALLBACK_URL', 'https://mpesa.onenetwork-system.com/callback.php'),
    'verify_url' => env('MPESA_VERIFY_URL', 'https://mpesa.onenetwork-system.com/verify.php'),
];
