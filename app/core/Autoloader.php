<?php

namespace App\Core;

class Autoloader {

  public static function loadClass() {
    spl_autoload_register(function ($class) {
      $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);
      echo "Class name: " . $classPath ."<br>";
      $file = base_path($classPath . '.php');
      echo "Full path: " . $file . "<br>";

      if (file_exists($file)) {
        require_once $file;
      } else {
        throw new \Exception('Autoload error: ' . $class . ' not found <br>');
      }
    });
  }

}
