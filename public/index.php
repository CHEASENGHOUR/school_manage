<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\AdminController;
use App\Middleware\AuthMiddleware;
use App\Middleware\AdminMiddleware;
use App\Controllers\ClassController;

// session_start();

$router = new Router();

$auth = new AuthController();
$dashboard = new DashboardController();
$admin = new AdminController();

// Auth routes
$router->get('/login', [$auth, 'loginView']);
$router->post('/login', [$auth, 'login']);
$router->get('/logout', [$auth, 'logout']);

$router->get('/register', [$auth, 'registerView']);
$router->post('/register', [$auth, 'register']);

// Protected routes
$router->get('/', [$dashboard, 'index'], [new AuthMiddleware()]);
$router->get('/admin', [$admin, 'index'], [new AdminMiddleware()]);

$router->get("/class",[new ClassController(), "index"]);
$router->post("/class/create",[new ClassController(), "create"]);


// Dispatch router
$router->dispatch();
