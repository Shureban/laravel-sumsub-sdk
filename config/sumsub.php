<?php

use Shureban\LaravelSumsubSdk\Attributes\Level;
use Shureban\LaravelSumsubSdk\Enums\ApplicantType;

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

    /*
    |--------------------------------------------------------------------------
    | Signature algorithm
    |--------------------------------------------------------------------------
    |
    | Set your signature algorithm for webhook verification. One of sha1, sha256, sha512
    |
    */

    'signature_algorithm' => env('SUMSUB_SIGNATURE_ALGORITHM', 'sha256'),

    /*
    |--------------------------------------------------------------------------
    | Levels
    |--------------------------------------------------------------------------
    |
    | KYC/KYB levels name
    |
    */

    ApplicantType::Individual->value => new Level(env('SUMSUB_KYC_LEVEL')),
    ApplicantType::Company->value    => new Level(env('SUMSUB_KYB_LEVEL')),

    /*
    |--------------------------------------------------------------------------
    | Other options
    |--------------------------------------------------------------------------
    |
    */

    'access_token_life_time' => 600,

];
