<?php

namespace App\Core\Middleware;

class AuthMiddleware implements MiddlewareIF {

  public function handle(): bool {
    if (!isset($_SESSION['user_id'])) {
      header("Location: /login");
      exit;
    }
    return true;
  }
}
