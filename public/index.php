<?php
require_once '../vendor/autoload.php';
require_once __DIR__ . '/../app/Helpers/helpers.php';

use Khamid\Framework\Core\Router;

$router = new Router();

// Load routes from files
foreach (glob(__DIR__ . '/../routes/*.php') as $routeFile) {
    $route = require $routeFile;  // Include the route file
    if (is_callable($route)) {     // Check if the returned value is callable
        $route($router);            // Call the route function with the router
    } else {
        // Optional: Handle the case where the return value is not callable
        throw new Exception("Route file {$routeFile} does not return a callable function.");
    }
}
$router->run();