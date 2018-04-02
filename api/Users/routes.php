<?php

/**
 * @var string
 */
$prefix = 'user';
/**
 * @var string
 */
$route = '/users';
/**
 * @var string
 */
$controller = 'Api\Users\Controllers\UserController';

# Make routes collection of users controllers.
return [
    $prefix . '_get' => [
        'method' => 'GET',
        'path' => $route,
        'controller' => [$controller, 'getAll']
    ],
    $prefix . '_show' => [
        'method' => 'GET',
        'path' => $route . '/{id}',
        'controller' => [$controller, 'getById']
    ],
    $prefix . '_create' => [
        'method' => 'POST',
        'path' => $route,
        'controller' => [$controller, 'create']
    ],
    $prefix . '_update' => [
        'method' => 'PUT',
        'path' => $route . '/{id}',
        'controller' => [$controller, 'update']
    ],
    $prefix . '_delete' => [
        'method' => 'DELETE',
        'path' => $route . '/{id}',
        'controller' => [$controller, 'delete']
    ]
];
