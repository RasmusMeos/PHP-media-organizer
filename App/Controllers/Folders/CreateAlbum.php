<?php

namespace App\Controllers\Folders;
use App\Core\BaseController;
use App\Models\Table\Folders;
use App\Models\Table\UsersFolders;

class CreateAlbum extends BaseController
{
  private Folders $albumModel;
  private UsersFolders $usersAlbumsModel;
  public function __construct(Folders $albumModel, UsersFolders $usersAlbumsModel)
  {
    $this->albumModel = $albumModel;
    $this->usersAlbumsModel = $usersAlbumsModel;
  }
  public function createFolder(): void {
      if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $this->redirect("/albums");
      }
    $folderName = trim($_POST['folder_name'] ?? '');
    $folderDesc = trim($_POST['folder_desc'] ?? '');

    if (empty($folderName)) {
      $_SESSION['errors_folder_creation']['empty-folder-name'] = "Folder name can't be empty!";
      $_SESSION['folder_desc'] = !empty($folderDesc) ? $folderDesc : '';
      $this->redirect("/albums");
    }

    $folderAdded = $this->albumModel->createFolder($folderName, $folderDesc);
    $folderID = $this->albumModel->getLastCreatedFolderID();
    $userLinked = $this->usersAlbumsModel->assignUserToFolder($_SESSION['user_id'], $folderID, true);


    if (!$folderAdded || !$userLinked) {
      $_SESSION['errors_folder_creation']['error-folder-create'] = "Folder creation failed. Please try again!";
      $this->redirect("/albums");
    }
    $_SESSION['success_folder_creation'] = "Folder created successfully!";
    $this->redirect("/albums");
  }
}
