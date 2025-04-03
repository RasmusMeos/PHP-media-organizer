<?php

require_once '../App/Core/pathHelper.php';
require_once base_path('config/session.php');
require_once base_path('/App/Core/autoloader.php');

use App\Core\Router;

// loading the autoloader
loadClass();

$router = new Router();
$router->loadRoutesFromJson(base_path('App/Core/routes.json'));

// extracting the current URI, method and query parameters
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
parse_str($_SERVER['QUERY_STRING'] ?? '', $query);
$queryParams = $_SERVER['QUERY_STRING'] ?? '';


error_log("URI: " . $uri);
error_log("METHOD: " . $method);
error_log("QUERY: " . $queryParams);
//var_dump($query);

// routing the request
$router->route($uri, $method, $query);

