<?php
    require_once '../vendor/autoload.php';
    require_once __DIR__ . '/../app/Helpers/helpers.php';

    use Khamid\Framework\Core\Router;                   // Update the namespace according to your structure
    use Khamid\Framework\Controllers\UserController;    // Add UserController's namespace
    
    $router = new Router();

    $router->get('/', [UserController::class, 'index']);
    $router->get('/user/create', [UserController::class, 'create']);


    $router->run();