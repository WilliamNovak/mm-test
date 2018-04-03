<?php

/**
 *
 * @author William Novak <williamnvk@gmail.com>
 * @package MadeiraMadeira
 */

return array_merge(
    [
        'index' => [
            'method' => 'GET',
            'path' => '/',
            'controller' => ['MadeiraMadeira\Application\Http\Index', 'index']
        ]
    ],
    require_once __DIR__ . "/../api/Users/routes.php",
    require_once __DIR__ . "/../app/Authentication/routes.php",
    require_once __DIR__ . "/../api/Contacts/routes.php"
);
