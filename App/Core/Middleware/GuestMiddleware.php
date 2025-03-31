<?php

namespace App\Core\Middleware;

class GuestMiddleware implements MiddlewareIF
{
  public function handle(): bool
  {
    if (isset($_SESSION['user_id'])) {
      header("Location: /");
      exit;
    }
    return true;
  }
}
