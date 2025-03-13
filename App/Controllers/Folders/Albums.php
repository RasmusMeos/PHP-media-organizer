<?php

namespace App\Controllers\Folders;
use App\Core\BaseController;
use App\Core\Database;
use App\Models\Aggregate\UserFoldersAgg;

class Albums extends BaseController
{
  public function index(): void {

    if (isset($_SESSION['user_id'])) {
      $config = require base_path('config/config.php');
      $db = new Database($config['db']);
      $userFoldersModel = new UserFoldersAgg($db);
      $folders = $userFoldersModel->getUserFolders($_SESSION['user_id']);

      $data = [
        'errors' => $_SESSION['errors_folder_creation'] ?? [],
        'success' => $_SESSION['success_folder_creation'] ?? '',
        'folder_desc' => $_SESSION['folder_desc'] ?? '',
        'folders' => $folders];

      unset($_SESSION['errors_folder_creation']);
      unset($_SESSION['success_folder_creation']);
      unset($_SESSION['folder_desc']);
      $this->render("folders/albums", $data);
    } else {
      $this-> redirect("/login");
    }

  }

}
