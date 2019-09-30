<?php
return [
    'debug' => env('APP_DEBUG', false),
    'verify_token' => env('MESSENGER_VERIFY_TOKEN'),
    'app_token' =>'2257342601027394|cj6PlxlZbsLafzyH8NigwufpBWc',
    'app_secret' => '1ff1e8c53ec0fd441692504780a7c66a',
    'auto_typing' => true,
    'handlers' => [
        Casperlaitw\LaravelFbMessenger\Contracts\DefaultHandler::class
    ],
    'custom_url' => '/webhook',
    'postbacks' => [],
    'home_url' => [
        'url' => env('MESSENGER_HOME_URL'),
         'webview_share_button' => 'show',
         'in_test' => true,
    ],
];
