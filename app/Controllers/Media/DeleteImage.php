<?php

namespace App\Controllers\Media;

use App\Core\BaseController;
use App\Models\Table\Media;
use App\Models\Table\Users;

class DeleteImage extends BaseController
{
  private $mediaModel;
  private $userModel;
  private int $mediaId;
  public function __construct(Media $mediaModel, Users $userModel, $mediaId)
  {
    $this->mediaModel = $mediaModel;
    $this->userModel = $userModel;
    $this->mediaId = $mediaId;
  }

  public function deleteImage()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

      if (is_null($this->mediaId)) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Invalid request: Missing image ID."]);
        die();
      }

      $media = $this->mediaModel->findMediaById($this->mediaId);
      $user = $this->userModel->findByUsername($_SESSION['username']);

      if (!$media || $user['user_id'] !== $_SESSION['user_id']) {
        http_response_code(403); // Forbidden
        echo json_encode(["error" => "You do not have permission to delete this image."]);
        die();
      }

      // deleting the image from the server
      $filePath = base_path("uploads/images/{$media['file_name']}");
      if (file_exists($filePath)) {
        unlink($filePath);
      }

      // deleting the record from the database
      if (!$this->mediaModel->deleteMediaById($this->mediaId)) {
        http_response_code(500); // Internal Server Error
        echo json_encode(["error" => "Failed to delete the image."]);
        die();
      }
      http_response_code(200); // success
      echo json_encode(["message" => "Image deleted successfully."]);
      die();
    }

    // if not a DELETE request
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Method not allowed."]);
    die();
  }

}
