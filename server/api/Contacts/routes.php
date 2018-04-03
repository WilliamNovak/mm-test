<?php

/**
 * @var string
 */
$prefix = 'contact';
/**
 * @var string
 */
$route = '/contacts';
/**
 * @var string
 */
$controller = 'Api\Contacts\Controllers\ContactController';

# Make routes collection of contacts controllers.
return [
    /**
     * Contact Routes.
     */
    $prefix . '_get' => [
        'method' => 'GET',
        'path' => $route,
        'controller' => [$controller, 'getAll']
    ],
    $prefix . '_get_user' => [
        'method' => 'GET',
        'path' => $route . '/user/{userId}',
        'controller' => [$controller, 'getByUserId']
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
