<?php

namespace App\Controllers\Folders;

use App\Core\BaseController;
use App\Models\Table\Folders;
use App\Models\Table\Users;

class EditAlbum extends BaseController
{
  private Folders $foldersModel;
  private Users $userModel;

  public function __construct(Folders $foldersModel, Users $userModel)
  {
    $this->foldersModel = $foldersModel;
    $this->userModel = $userModel;
  }

  public function edit(): void
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      http_response_code(405); // Method Not Allowed
      echo json_encode(["error" => "Method not allowed."]);
      die();
    }

    $input = json_decode(file_get_contents("php://input"), true);
    $folderId = (int)$input['folder_id'] ?? null;
    $newName = $input['folder_name'] ?? null;
    $newDescription = $input['folder_desc'] ?? false;
    error_log("ID TYPE: " . gettype($folderId));
    error_log("NEW NAME TYPE: " . gettype($newName));
    error_log("DESCRIPTION TYPE: " . gettype($newDescription));

    if (!$folderId || !$newName || strlen($newName) > 255 || strlen($newDescription) > 255) {
      http_response_code(400); // Bad Request
      echo json_encode(["error" => "Invalid input or details too long."]);
      die();
    }

    // user session validation
    $userName = $_SESSION['username'] ?? null;
    if (!$userName) {
      http_response_code(401); // Unauthorized
      echo json_encode(["error" => "You must be logged in to perform this action."]);
      die();
    }

    // ownership verification
    $user = $this->userModel->findByUsername($userName);
    error_log(print_r($user, true));
    if (!$user || $user['user_id'] !== $_SESSION['user_id']) {
      http_response_code(403); // Forbidden
      echo json_encode(["error" => "You do not have permission to edit the details for this folder."]);
      die();
    }

    // updating details
    $success = $this->foldersModel->updateFolderDetails($folderId, $newName, $newDescription);
    if (!$success) {
      http_response_code(500); // Internal Server Error
      echo json_encode(["error" => "Failed to update folder details."]);
      die();
    }

    http_response_code(200);
    echo json_encode(["message" => "Folder details updated successfully."]);
  }
}

