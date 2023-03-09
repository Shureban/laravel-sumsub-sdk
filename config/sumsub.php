<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Sumsub domain
    |--------------------------------------------------------------------------
    |
    | Domain for all requests to Sumsub.
    |
    */

    'domain' => env('SUMSUB_DOMAIN', 'https://api.sumsub.com'),

    /*
    |--------------------------------------------------------------------------
    | Request timeout
    |--------------------------------------------------------------------------
    |
    | How long request suppose to be in progress
    |
    */

    'timeout' => env('SUMSUB_REQUEST_TIMEOUT', 60),

    /*
    |--------------------------------------------------------------------------
    | Security
    |--------------------------------------------------------------------------
    |
    | API key and secret key are created in Sumsub personal cabinet.
    |
    */

    'api_key'    => env('SUMSUB_API_KEY'),
    'secret_key' => env('SUMSUB_SECRET_KEY'),

];
