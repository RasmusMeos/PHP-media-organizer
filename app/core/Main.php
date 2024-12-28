<?php

// Landing page controller
namespace App\Core;
use app\Models\Aggregate\UserMediaAgg;
use App\Models\Table\FavouriteMedia;
use App\Models\Table\Users;

class Main extends BaseController
{
  private int $pageId;
  private array $filters;
  public function __construct(int $pageId = 1, array $filters = []) {
    $this->pageId = $pageId;
    $this->filters = $filters;
  }
  public function index(): void
  {
    if (isset($_SESSION['user_id'])) {
      $config = require base_path('config/config.php');
      $db = new Database($config['db']);
      $usersMediaModel = new UserMediaAgg($db);
      $userModel = new Users($db);
      $faveMediaModel = new FavouriteMedia($db);

      $pagination = $this->getPaginationData($usersMediaModel, $this->pageId);
      if (!$pagination) {
        $this->render('media/main_gallery', [
          'totalPages' => 0,
        ]);
        exit();
      }
      if ($pagination['currentPage'] > $pagination['totalPages']) {
        $this->redirect('/');
      }
      $favourites = array_column($faveMediaModel->getUserFavorites($_SESSION['user_id']), 'media_id');
      $_SESSION['screen_name'] = $userModel->getUserScreenName($_SESSION['user_id']);

      // logged in
      $this->render('media/main_gallery', array_merge($pagination, [
          'favourites' => $favourites,
      ]));
    } else {
      // not logged in
      $this->render('media/main_gallery');
    }
  }

    private function getPaginationData(UserMediaAgg $model, int $pageId): array|bool
  {
      $itemsPerPage = 2;
      $totalItems = $model->getUserMediaCount($_SESSION['user_id'], $this->filters);
      if ($totalItems === 0 && empty($this->filters)) return false;
      $totalPages = (int)max(1, (ceil($totalItems / $itemsPerPage)));
      $offset = ($pageId - 1) * $itemsPerPage;
      $media = $model->getUserMedia($_SESSION['user_id'], $itemsPerPage, $offset, $this->filters);
      if (empty($media)) {
        $this->redirect('/empty-result');
      }


      return [
        'images' => $media,
        'currentPage' => $pageId,
        'totalPages' => $totalPages,
        'baseEndpoint' => '/',
      ];
  }
}
