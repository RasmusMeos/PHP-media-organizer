<?php

require_once '../app/core/pathHelper.php';
require_once base_path('config/session.php');
require_once base_path('/app/core/Autoloader.php');

use App\Core\Router;

// loading the autoloader
App\Core\Autoloader::loadClass();

$router = new Router();

// loading the routes -> this populates `$routes` array of the Router $router
require base_path('app/core/routes.php');

// extracting the current URI and method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// routing the request
$router->route($uri, $method);











