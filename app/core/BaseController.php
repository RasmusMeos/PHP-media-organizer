<?php
namespace App\Core;

class BaseController {

  protected function render(string $view, array $data = []) {

    extract($data);

    $viewPath = base_path("app/views/{$view}.php");

    if (file_exists($viewPath)) {
      include $viewPath;
    } else {
      echo "<p>View {$view} not found.</p>";
    }

  }

  protected function redirect(string $url) {
    header("Location: {$url}");
    exit();
  }
}
