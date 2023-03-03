<?php

return [

    'auth' => [

        'key_path' => env('REMOTE_KEY_PATH', storage_path('id_rsa')),

        'username' => env('REMOTE_USERNAME', 'root'),

    ],

    'scripts_path' => app_path() . '/Scripts',

    'log_channel' => env('REMOTE_LOG_CHANNEL'),

];
