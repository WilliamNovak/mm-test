<?php

use function DI\create;

return [
    // Bind an interface to an implementation
    'containers' => [
        Controller::class => create(\MadeiraMadeira\Application\Http\Controller::class),
        Response::class => create(\MadeiraMadeira\Application\Http\Response::class),
        Request::class => create(\MadeiraMadeira\Application\Http\Request::class),
        StatusCode::class => create(\MadeiraMadeira\Application\Http\StatusCode::class)
    ]
];
