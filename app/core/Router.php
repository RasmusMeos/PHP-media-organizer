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

  private function add($method, $uri, $controller)
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

  public function delete($uri, $controller)
  {
    $this->add('DELETE', $uri, $controller);
  }



  public function route($uri, $method, $query = [])
  {
    foreach ($this->routes as $route) {
      if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
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

    require base_path("app/views/system/{$code}.php");

    die();
  }
  protected function resolveController($class, array $query) {
    //echo "Resolving controller for {$class}...<br>";
    if ($class === 'App\Core\Main' && !empty($query)) {
      $pageId = isset($query['page']) ? (int)$query['page'] : 1;
      $filters = array_filter($query, fn($key) => $key !== 'page', ARRAY_FILTER_USE_KEY);
      return new $class($pageId, $filters);
    }
    if ($class === 'App\Controllers\Favourites\Favourites' && !empty($query)) {
      $pageId = isset($query['page']) ? (int)$query['page'] : 1;
      return new $class($pageId);
    }
    if ($class === 'App\Controllers\Auth\Login') {
      $config = require base_path('config/config.php');
      $db = new Database($config['db']);
      $userModel = new Users($db);
      return new $class($userModel);
    }
    if ($class === 'App\Controllers\Auth\Signup') {
      $config = require base_path('config/config.php');
      $db = new Database($config['db']);
      $userModel = new Users($db);
      return new $class($userModel);
    }
    if ($class === 'App\Controllers\Media\UploadImage') {
      $config = require base_path('config/config.php');
      $db = new Database($config['db']);
      $mediaModel = new Media($db);
      $usersMediaModel = new UsersMedia($db);
      return new $class($mediaModel, $usersMediaModel);
    }
    if ($class === 'App\Controllers\Auth\ChangePassword'){
      $config = require base_path('config/config.php');
      $db = new Database($config['db']);
      $userModel = new Users($db);
      return new $class($userModel);
    }
    if ($class === 'App\Controllers\Auth\Profile'){
      $config = require base_path('config/config.php');
      $db = new Database($config['db']);
      $userModel = new Users($db);
      return new $class($userModel);
    }
    if ($class === 'App\Controllers\Media\DeleteImage') {
      $config = require base_path('config/config.php');
      $db = new Database($config['db']);
      $mediaModel = new Media($db);
      $userModel = new Users($db);
      $mediaId = (int)$query['id'];
      return new $class($mediaModel, $userModel, $mediaId);
    }
    if ($class === 'App\Controllers\Media\FavouriteImage'){
      $config = require base_path('config/config.php');
      $db = new Database($config['db']);
      $faveMediaModel = new FavouriteMedia($db);
      return new $class($faveMediaModel);
    }
    if ($class === 'App\Controllers\Media\RenameMedia'){
      $config = require base_path('config/config.php');
      $db = new Database($config['db']);
      $mediaModel = new Media($db);
      $userModel = new Users($db);
      return new $class($mediaModel, $userModel);
    }
    if ($class === 'App\Controllers\Folders\CreateAlbum') {
      $config = require base_path('config/config.php');
      $db = new Database($config['db']);
      $foldersModel = new Folders($db);
      $usersFoldersModel = new UsersFolders($db);
      return new $class($foldersModel, $usersFoldersModel);
    }
    return new $class();
  }

}
