<?php

require_once '../app/core/pathHelper.php';
require_once base_path('config/session.php');
require_once base_path('/app/core/autoloader.php');

use App\Core\Router;

// loading the autoloader
loadClass();

$router = new Router();

// loading the routes -> this populates `$routes` array of the Router $router
require base_path('app/core/routes.php');

// extracting the current URI, method and query parameters
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$query = $_SERVER['QUERY_STRING'] ?? '';


error_log("URI: " . $uri);
error_log("METHOD: " . $method);
error_log("QUERY: " . $query);


// routing the request
$router->route($uri, $method, $query);

