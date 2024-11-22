<?php

namespace App\Core;

class Router
{
  private $routes = [];

  public function add($method, $uri, $controller)
  {
    $this->routes[] = [
      'uri' => $uri,
      'controller' => $controller,
      'method' => $method
    ];
  }

  public function get($uri, $controller)
  {
    $this->add('GET', $uri, $controller);
  }

  public function post($uri, $controller)
  {
    $this->add('POST', $uri, $controller);
  }


  public function route($uri, $method)
  {
    foreach ($this->routes as $route) {
      if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
        $controller = $route['controller'];

        if (is_array($controller)) {
          [$class, $method] = $controller;
          $controllerInstance = $this->resolveController($class);
          return ($controllerInstance)->$method();
        }

        return require base_path($controller);
      }
    }

    $this->abort();
  }

  protected function abort($code = 404)
  {
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
  }
  protected function resolveController($class) {
    echo "Resolving controller for {$class}...<br>";
    if ($class === 'App\Controllers\Auth\Login') {
      $config = require base_path('config/config.php');
      $db = new Database($config['db']);
      $userModel = new \App\Models\User($db);
      $userManager = new \App\Managers\UserManager($userModel);
      return new $class($userManager);
    }
    if ($class === 'App\Controllers\Auth\Signup') {
      $config = require base_path('config/config.php');
      $db = new \App\Core\Database($config['db']);
      $userModel = new \App\Models\User($db);
      $userManager = new \App\Managers\UserManager($userModel);
      return new $class($userManager);
    }
    if ($class === 'App\Controllers\Media\UploadImage') {
      $config = require base_path('config/config.php');
      $db = new Database($config['db']);
      $imageModel = new \App\Models\Image($db);
      $imageManager = new \App\Managers\ImageManager($imageModel);
      return new $class($imageManager);
    }
    return new $class();
  }

}
