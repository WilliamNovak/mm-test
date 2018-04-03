<?php

return array_merge(
    require_once __DIR__ . "/../api/Users/routes.php",
    require_once __DIR__ . "/../app/Authentication/routes.php"
);
