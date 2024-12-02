<?php

// Landing page controller
namespace App\Core;
use app\Models\Aggregate\UserMediaAgg;
use App\Models\Table\Users;
use Couchbase\User;

class Main extends BaseController
{
  public function index()
  {
    $config = require base_path('config/config.php');
    $db = new Database($config['db']);

    $images = [];
    if (isset($_SESSION['user_id'])) {
      $usersMediaModel = new UserMediaAgg($db);
      $userModel = new Users($db);
      $images = $usersMediaModel->getUserMedia($_SESSION['user_id']);
      $_SESSION['screen_name'] = $userModel->getUserScreenName($_SESSION['user_id']);
    }

    // Render the main_gallery view
    $this->render('media/main_gallery', [
      'images' => $images,
    ]);
  }
}
