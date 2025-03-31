<?php

namespace App\Core;

use App\Models\Table\FavouriteMedia;
use App\Models\Table\Folders;
use App\Models\Table\Media;
use App\Models\Table\Users;
use App\Models\Table\UsersFolders;
use App\Models\Table\UsersMedia;

class Router
{
  private $routes = [];

  private function add($method, $uri, $controller, $middleware = null): void
  {
    $this->routes[] = [
      'uri' => $uri,
      'controller' => $controller,
      'method' => $method,
      'middleware' => $middleware
    ];
  }

  public function loadRoutesFromJson($path): void {
    $json = file_get_contents($path);
    $routes = json_decode($json, true);
    foreach ($routes as $route) {
      $method = strtoupper($route['method']);
      $uri = $route['uri'];
      $controller = [$route['controller'], $route['action']];
      $middleware = $route['middleware'] ?? null;
      $this->add($method, $uri, $controller, $middleware);
    }
  }

  public function route($uri, $method, $query = [])
  {
    foreach ($this->routes as $route) {
      if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
        //middleware execution first
        if (isset($route['middleware'])) {
          $middlewareClass = $route['middleware'];
          $middleware = new $middlewareClass();
          if (!$middleware->handle($query)) {
            return;
          }
        }
        $controller = $route['controller'];

        if (is_array($controller)) {
          [$class, $method] = $controller;
          $controllerInstance = $this->resolveController($class, $query);
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

    require base_path("App/views/system/{$code}.php");

    die();
  }

  protected function resolveController($class, array $query) {
    $config = require base_path('config/config.php');
    $db = new Database($config['db']);

    $usersModel = new Users($db);
    $mediaModel = new Media($db);
    $usersMediaModel = new UsersMedia($db);
    $faveMediaModel = new FavouriteMedia($db);
    $foldersModel = new Folders($db);
    $usersFoldersModel = new UsersFolders($db);

    $controllerMap = [
      // 'use' keyword for getting outer scope vars
      'App\Core\Main' => function () use ($class, $query) {
        $pageId = isset($query['page']) ? (int)$query['page'] : 1;
        $filters = array_filter($query, fn($key) => $key !== 'page', ARRAY_FILTER_USE_KEY);
        return new $class($pageId, $filters);
      },
      'App\Controllers\Favourites\Favourites' => function () use ($class, $query) {
      $pageId = isset($query['page']) ? (int)$query['page'] : 1;
      return new $class($pageId);
      },
      'App\Controllers\Auth\Login' => function() use ($class, $usersModel) {
        return new $class($usersModel);
      },
      'App\Controllers\Auth\Signup' => function() use ($class, $usersModel) {
        return new $class($usersModel);
      },
      'App\Controllers\Media\UploadImage' => function() use ($class, $mediaModel, $usersMediaModel) {
        return new $class($mediaModel, $usersMediaModel);
      },
      'App\Controllers\Auth\ChangePassword' => function() use ($class, $usersModel) {
        return new $class($usersModel);
      },
      'App\Controllers\Auth\Profile' => function() use ($class, $usersModel) {
        return new $class($usersModel);
      },
      'App\Controllers\Media\DeleteImage' => function() use ($class, $mediaModel, $usersModel, $query) {
        $mediaId = isset($query['id']) ? (int)$query['id'] : null;
        return new $class($mediaModel, $usersModel, $mediaId);
      },
      'App\Controllers\Media\FavouriteImage' => function() use ($class, $faveMediaModel) {
        return new $class($faveMediaModel);
      },
      'App\Controllers\Media\RenameMedia' => function() use ($class, $mediaModel, $usersModel) {
        return new $class($mediaModel, $usersModel);
      },
      'App\Controllers\Folders\CreateAlbum' => function() use ($class, $foldersModel, $usersFoldersModel) {
        return new $class($foldersModel, $usersFoldersModel);
      },
      'App\Controllers\Folders\EditAlbum' => function() use ($class, $foldersModel, $usersModel) {
        return new $class($foldersModel, $usersModel);
      }
    ];

    if (isset($controllerMap[$class])) {
      return $controllerMap[$class](); //retrieve and call the closure (anonymous function)
    }

    //if no mapping exists
    return new $class();
  }
}
