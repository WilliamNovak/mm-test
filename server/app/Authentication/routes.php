<?php

/**
 * @var string
 */
$prefix = 'auth';
/**
 * @var string
 */
$route = '/auth';
/**
 * @var string
 */
$controller = 'MadeiraMadeira\Application\Authentication\Controllers\AuthController';

# Make routes collection of users controllers.
return [
    /**
     * User Routes.
     */
    $prefix . '_log_in' => [
        'method' => 'POST',
        'path' => $route . '/authorize',
        'controller' => [$controller, 'logIn']
    ],
    $prefix . '_log_out' => [
        'method' => 'GET',
        'path' => $route . '/logOut',
        'controller' => [$controller, 'logOut']
    ]
];
