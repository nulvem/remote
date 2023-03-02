<?php

return [

    'key_path' => env('REMOTE_KEY_PATH'),

    'logger' => env('REMOTE_KEY_PATH', true),

    'scp' => [
        'key_path' => env('REMOTE_SCP_KEY_PATH'),

        'logger' => (bool)env('REMOTE_SSH_DEBUG_LOG', true),
    ],

    'ssh' => [
        'key_path' => env('REMOTE_SSH_KEY_PATH'),

        'logger' => (bool)env('REMOTE_SSH_DEBUG_LOG', true),
    ]

];