<?php

if ( env('APP_ENV', 'local') !== 'local' ) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

use \FastRoute\RouteCollector;

/**
 * If containers file dont exists, trigger error exception.
 */
$setupFile = __DIR__ . '/../bootstrap/setup.php';
if (!file_exists($setupFile)) {
    throw new \Exception("Container file not found.", 1);
}

/**
 * If containers file dont exists, trigger error exception.
 */
$containersFile = __DIR__ . '/../bootstrap/containers.php';
if (!file_exists($containersFile)) {
    throw new \Exception("Container file not found.", 1);
}

/**
 * If routes file dont exists, trigger error exception.
 */
$routesFile = __DIR__ . '/../routes/api.php';
if (!file_exists($routesFile)) {
    throw new \Exception("Routes file not found.", 1);
}

// Request setup file with config function.
require_once $setupFile;
// Request container file with Containers Collection.
$container = require_once $containersFile;
// Request route file with Routes Collection.
$routes = require_once $routesFile;

/**
 * Require config file.
 */
require_once __DIR__.'/../bootstrap/setup.php';

$dispatcher = \FastRoute\simpleDispatcher(function(RouteCollector $r) use (&$routes) {
    foreach($routes as $route) {
        $r->addRoute(
            $route['method'],
            $route['path'],
            $route['controller']
        );
    }
});

$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $controller = $route[1];
        $parameters = $route[2];
        // We could do $container->get($controller) but $container->call()
        // does that automatically
        $container->call($controller, $parameters);
        break;
}
