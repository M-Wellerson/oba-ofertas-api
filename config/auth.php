<?php
return [
    'defaults' => [
        'guard'     => 'api',
        'passwords' => 'users',
    ],
    'guards' => [
        'api' => [
            'driver'   => 'jwt',
            'provider' => 'users',
        ],
        'dashboard' => [
            'driver'   => 'jwt',
            'provider' => 'admin',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => \App\Models\Usuario::class
        ],
        'admin' => [
            'driver' => 'eloquent',
            'model'  => \App\Models\Admin::class
        ]
    ]
];
