<?php
namespace App\Core;

class BaseController {

  protected function render(string $view, array $data = []) {

    extract($data);

    $viewPath = __DIR__ . "/../app/views/" . $view . ".php";

    //Header partial
    include __DIR__ . "/../app/views/partials/header.php";

    if (file_exists($viewPath)) {
      include $viewPath;
    } else {
      echo "<p>View {$view} not found.</p>";
    }

    //Footer partial
    include __DIR__ . "/../app/views/partials/footer.php";

  }

  protected function redirect(string $url) {
    header("Location: {$url}");
    exit();
  }
}
