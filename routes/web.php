<?php

use Khamid\Framework\Controllers\UserController;

return function ($router) {
    $router->get('/', [UserController::class, 'index']);
    $router->get('/user/create', [UserController::class, 'create']);
};