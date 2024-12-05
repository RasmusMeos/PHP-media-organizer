<?php

namespace App\Controllers\Media;

use App\Core\BaseController;
use App\Models\Table\Media;
use App\Models\Table\Users;

class DeleteImage extends BaseController
{
  private $mediaModel;
  private $userModel;
  private $method;
  public function __construct(Media $mediaModel, Users $userModel, $method)
  {
    $this->mediaModel = $mediaModel;
    $this->userModel = $userModel;
    $this->method = $method;
  }

  public function deleteImage()
  {
    if ($this->method === 'DELETE') {
      $mediaId = $_POST['media-id'] ?? null;

      if (!$mediaId) {
        http_response_code(400); // Bad Request
        die("Invalid request: Missing image ID.");
      }

      $media = $this->mediaModel->findMediaById($mediaId);
      $user = $this->userModel->findByUsername($_SESSION['username']);

      if (!$media || $user['user_id'] !== $_SESSION['user_id']) {
        http_response_code(403); // Forbidden
        die("You do not have permission to delete this image.");
      }

      // deleting the image from the server
      $filePath = base_path("uploads/images/{$media['file_name']}");
      if (file_exists($filePath)) {
        unlink($filePath);
      }

      // deleting the record from the database
      if (!$this->mediaModel->deleteMediaById($mediaId)) {
        http_response_code(500); // Internal Server Error
        die("Failed to delete the image.");
      }

      $_SESSION['success_message'] = "Image deleted successfully.";
      $this->redirect('/');
    }

    // if not a DELETE request
    http_response_code(405); // Method Not Allowed
    die("Method not allowed.");
  }

}
