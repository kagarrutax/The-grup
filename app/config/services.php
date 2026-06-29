<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
<<<<<<< Updated upstream
<<<<<<< HEAD
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
=======
        'token' => env('POSTMARK_TOKEN'),
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
=======
        'token' => env('POSTMARK_TOKEN'),
>>>>>>> Stashed changes
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

<<<<<<< Updated upstream
<<<<<<< HEAD
=======
=======
>>>>>>> Stashed changes
    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

<<<<<<< Updated upstream
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
=======
>>>>>>> Stashed changes
    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
