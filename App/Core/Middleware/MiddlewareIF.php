<?php

namespace App\Core\Middleware;

interface MiddlewareIF
{
  # @return true if request is allowed, false if not
  public function handle(): bool;
}
