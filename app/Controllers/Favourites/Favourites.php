<?php

namespace App\Controllers\Favourites;
use App\Core\BaseController;
use App\Core\Database;
use app\Models\Aggregate\FavouriteMediaAgg;
use App\Models\Table\FavouriteMedia;

class Favourites extends BaseController
{

  public function index()
  {
    $config = require base_path('config/config.php');
    $db = new Database($config['db']);

    $images = [];
    if (isset($_SESSION['user_id'])) {
      $faveMediaModelAgg = new FavouriteMediaAgg($db);
      $faveMediaModel = new FavouriteMedia($db);
      $images = $faveMediaModelAgg->getFavouriteMedia($_SESSION['user_id']);
      $favourites = array_column($faveMediaModel->getUserFavorites($_SESSION['user_id']), 'media_id');

    }
      $this->render('favourites/favourites_gallery', [
        'images' => $images,
        'favourites' => $favourites
      ]);

  }
}
