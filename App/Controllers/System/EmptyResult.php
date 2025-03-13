<?php
namespace App\Controllers\System;
use App\Core\BaseController;

class EmptyResult extends BaseController
{
  public function index() {
    $this->render('system/empty_result');
  }
}
