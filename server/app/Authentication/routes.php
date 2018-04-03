<?php
# Make routes collection of users controllers.
return [
    /**
     * Register Route.
     */
    'register' => [
        'method' => 'POST',
        'path' => '/register',
        'controller' => ['MadeiraMadeira\Application\Authentication\Controllers\RegisterController', 'register']
    ],
    'check_email' => [
        'method' => 'POST',
        'path' => '/check/email',
        'controller' => ['MadeiraMadeira\Application\Authentication\Controllers\EmailController', 'check']
    ],
    /**
     * Auth Routes.
     */
    'auth_log_in' => [
        'method' => 'POST',
        'path' => '/auth/authorize',
        'controller' => ['MadeiraMadeira\Application\Authentication\Controllers\AuthController', 'logIn']
    ],
    'auth_log_out' => [
        'method' => 'GET',
        'path' => '/auth/logOut',
        'controller' => ['MadeiraMadeira\Application\Authentication\Controllers\AuthController', 'logOut']
    ]
];
