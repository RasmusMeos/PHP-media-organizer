<?php

// Landing page controller
namespace App\Core;
use app\Models\Aggregate\UserMediaAgg;

class Main extends BaseController
{
  public function index()
  {
    $config = require base_path('config/config.php');
    $db = new Database($config['db']);

    $images = [];
    if (isset($_SESSION['user_id'])) {
      $usersMediaModel = new UserMediaAgg($db);
      $images = $usersMediaModel->getUserMedia($_SESSION['user_id']);
    }

    // Render the main_gallery view
    $this->render('main_gallery', [
      'images' => $images,
    ]);
  }
}
