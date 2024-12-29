<?php

namespace App\Controllers\Favourites;
use App\Core\BaseController;
use App\Core\Database;
use app\Models\Aggregate\FavouriteMediaAgg;
use app\Models\Aggregate\UserMediaAgg;
use App\Models\Table\FavouriteMedia;

class Favourites extends BaseController
{
  private int $pageId;
  public function __construct(int $pageId = 1) {
    $this->pageId = $pageId;
  }

  public function index()
  {
    $config = require base_path('config/config.php');
    $db = new Database($config['db']);

    if (isset($_SESSION['user_id'])) {
      $faveMediaModelAgg = new FavouriteMediaAgg($db);
      $faveMediaModel = new FavouriteMedia($db);

      $pagination = $this->getPaginationData($faveMediaModelAgg, $this->pageId);
      if ($pagination['currentPage'] > $pagination['totalPages']) {
        $this->redirect('/favourites');
      }
      $favourites = array_column($faveMediaModel->getUserFavorites($_SESSION['user_id']), 'media_id');
      $this->render('favourites/favourites_gallery', array_merge($pagination, [
        'favourites' => $favourites,
      ]));
    }
    else {
      $this->redirect('/');
    }
  }

  private function getPaginationData(FavouriteMediaAgg $model, int $pageId): array
  {
    $itemsPerPage = 5;
    $totalItems = $model->getFavouriteMediaTotalCount($_SESSION['user_id']);
    $totalPages = (int)max(1, (ceil($totalItems / $itemsPerPage)));
    $offset = ($pageId - 1) * $itemsPerPage;
    $images = $model->getFavouriteMedia($_SESSION['user_id'], $itemsPerPage, $offset);

    return [
      'has_content' => true,
      'images' => $images,
      'currentPage' => $pageId,
      'totalPages' => $totalPages,
      'baseEndpoint' => '/favourites',
    ];
  }
}
