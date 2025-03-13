<?php

namespace App\Controllers\Media;

use App\Core\BaseController;
use App\Models\Table\Media;
use App\Models\Table\Users;

class RenameMedia extends BaseController
{
  private $mediaModel;
  private $userModel;

  public function __construct(Media $mediaModel, Users $userModel)
  {
    $this->mediaModel = $mediaModel;
    $this->userModel = $userModel;
  }

  public function rename(): void
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      http_response_code(405); // Method Not Allowed
      echo json_encode(["error" => "Method not allowed."]);
      die();
    }

    $input = json_decode(file_get_contents("php://input"), true);
    $mediaId = $input['media_id'] ?? null;
    $newName = $input['media_name'] ?? null;

    if (!$mediaId || !$newName || strlen($newName) > 255) {
      http_response_code(400); // Bad Request
      echo json_encode(["error" => "Invalid input or name too long."]);
      die();
    }

    $userName = $_SESSION['username'] ?? null;
    if (!$userName) {
      http_response_code(401); // Unauthorized
      echo json_encode(["error" => "You must be logged in to perform this action."]);
      die();
    }

    // ownership verification
    $user = $this->userModel->findByUsername($userName);
    if (!$user || $user['user_id'] !== $_SESSION['user_id']) {
      http_response_code(403); // Forbidden
      echo json_encode(["error" => "You do not have permission to rename this media."]);
      die();
    }

    $success = $this->mediaModel->updateMediaName($mediaId, $newName);
    if (!$success) {
      http_response_code(500); // Internal Server Error
      echo json_encode(["error" => "Failed to update media name."]);
      die();
    }

    http_response_code(200);
    echo json_encode(["message" => "Media name updated successfully."]);
  }
}
