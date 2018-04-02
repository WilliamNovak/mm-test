<?php

use function DI\create;
use Database\Database;

return [
    // Bind an interface to an implementation
    'containers' => [
        Database::class => create(Database::class)
    ]
];
