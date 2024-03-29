<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

'facebook' => [
    'client_id' => '2257342601027394',
    'client_secret' => '1ff1e8c53ec0fd441692504780a7c66a',
    'redirect' => 'https://vowalaa.com/demo/auth/facebook/callback',
  ],

  'google' => [
    'client_id' => '703777933462-f8v4uu31a5ajojub1i98mnckq0rimhtd.apps.googleusercontent.com',
    'client_secret' => '7HkOB9dUv_ZBx7jyFLYEGFdJ',
    'redirect' => 'https://vowalaa.com/demo/auth/google/callback',
    ],
];
