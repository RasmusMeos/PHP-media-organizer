<?php

namespace App\Controllers\Media;

use App\Core\BaseController;
use App\Models\Table\FavouriteMedia;

class FavouriteImage extends BaseController
{
  private $faveMediaModel;

  public function __construct(FavouriteMedia $faveMediaModel)
  {
    $this->faveMediaModel = $faveMediaModel;
  }


  public function toggleFavourite()
  {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      http_response_code(405); // Method Not Allowed
      echo json_encode(["error" => "Method not allowed."]);
      die();
    }
    $rawData = file_get_contents('php://input');
    $data = json_decode($rawData, true);

    $mediaId = $data['media_id'] ?? null;
    $action = $data['action'] ?? null;

    if (!$mediaId || !in_array($action, ['favourite', 'unfavourite'])) {
      http_response_code(400); // Bad Request
      echo json_encode(["error" => "Invalid request parameters."]);
      die();
    }

    $userId = $_SESSION['user_id'] ?? null;

    if (!$userId) {
      http_response_code(401); // Unauthorized
      echo json_encode(["error" => "You must be logged in to perform this action."]);
      die();
    }
    // checking current status
    $isFavourited = $this->faveMediaModel->isFavourite($userId, $mediaId);

    if ($action === 'favourite') {
      if ($isFavourited) {
        http_response_code(200);
        echo json_encode(["message" => "Image is already in favourites."]);
        return;
      }
      $success = $this->faveMediaModel->addToFavourites($userId, $mediaId);

      if (!$success) {
        http_response_code(500); // Internal Server Error
        echo json_encode(["error" => "Failed to add to favourites."]);
        die();
      }

      http_response_code(200); // successful insert
      echo json_encode(["message" => "Image added to favourites."]);

    } elseif ($action === 'unfavourite') {
      if (!$isFavourited) {
        http_response_code(200);
        echo json_encode(["message" => "Image is not in favourites."]);
        return;
      }

      $success = $this->faveMediaModel->removeFromFavourites($userId, $mediaId);

      if (!$success) {
        http_response_code(500); // Internal Server Error
        echo json_encode(["error" => "Failed to remove from favourites."]);
        die();
      }

      http_response_code(200); // successful deletion
      echo json_encode(["message" => "Image removed from favourites."]);


    }
  }
}
