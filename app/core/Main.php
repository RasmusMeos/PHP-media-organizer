<?php

namespace App\Core;
use App\Managers\ImageManager;
use App\Models\Image;

class Main extends BaseController
{
  public function index()
  {
    $config = require base_path('config/config.php');
    $db = new Database($config['db']);

    $images = [];
    if (isset($_SESSION['user_id'])) {
      $imageModel = new Image($db);
      $imageManager = new ImageManager($imageModel);
      $images = $imageManager->getImagesByUserID($_SESSION['user_id']);
    }

    // Render the main_gallery view
    $this->render('main_gallery', [
      'images' => $images,
    ]);
  }
}
