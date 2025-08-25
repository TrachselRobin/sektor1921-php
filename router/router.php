<?php

use App\Controllers\UserController;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\AdminController; // <— neu

/** @var \App\Core\Router $router */

$router->get('/api/', [HomeController::class, 'index']);

$router->post('/api/auth/login', [AuthController::class, 'login']);
$router->delete('/api/auth/logout', [AuthController::class, 'logout']);
$router->post('/api/auth/refresh', [AuthController::class, 'refresh']);
$router->get('/api/auth/me', [AuthController::class, 'me']);

$router->get('/api/admin', [AdminController::class, 'index']);

$router->get('/api/admin/users', [AdminController::class, 'usersIndex']);
$router->get('/api/admin/users/{id}', [AdminController::class, 'usersShow']);
$router->post('/api/admin/users', [AdminController::class, 'usersStore']);
$router->put('/api/admin/users/{id}', [AdminController::class, 'usersUpdate']);
$router->delete('/api/admin/users/{id}', [AdminController::class, 'usersDestroy']);

/*
$router->get('/api/users', [UserController::class, 'index']);
$router->get('/api/users/{id}', [UserController::class, 'show']);
$router->post('/api/users', [UserController::class, 'store']);
$router->put('/api/users/{id}', [UserController::class, 'update']);
$router->delete('/api/users/{id}', [UserController::class, 'destroy']);
*/