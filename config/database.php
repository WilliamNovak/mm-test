<?php

    return [
        'database' => [

            'type' => strtolower(env('DB_TYPE', 'PDO')),

            'pdo' => [
                'driver' => env('DB_CONNECTION'),
                'dns' =>
                    env('DB_CONNECTION', 'mysql') . ":" . implode(';',
                    [
                        'host='    . env('DB_HOST'),
                        'port='    . env('DB_PORT'),
                        'dbname='  . env('DB_DATABASE'),
                        'charset=' . env('DB_CHARSET', 'utf8')
                    ]
                ),
                'path' => null,
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD')
            ],

            // TODO add local storage type, like sqlite.
            'storage' => [
                'driver' => 'sqlite',
                'dns' => null,
                'path' => null,
                'username' => null,
                'password' => null
            ]

        ]
    ];
