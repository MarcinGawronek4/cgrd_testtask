<?php
require_once 'router.php';
require_once './news/controller.php';
require_once './login/login.php';

$router = new Router();

// Define routes
$router->addRoute('/cgrd/news/list', 'NewsController', 'list');
$router->addRoute('/cgrd/news/create', 'NewsController', 'create');
$router->addRoute('/cgrd/news/edit', 'NewsController', 'edit');
$router->addRoute('/cgrd/news/delete', 'NewsController', 'delete');
$router->addRoute('/cgrd/', 'LoginController', 'renderLogin');
$router->addRoute('/cgrd/l', 'LoginController', 'renderLogin');
$router->addRoute('/cgrd/l/authenticate', 'LoginController', 'login');


// Get the requested path
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// Dispatch the route
$router->dispatch($path);
