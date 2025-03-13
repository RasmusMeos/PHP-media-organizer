<?php

namespace App\Models\Table;

class FavouriteMedia
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db->getConnection();
  }

  public function addToFavourites($userId, $mediaId)
  {
    $query = "INSERT INTO favourite_media (user_id, media_id) VALUES (:user_id, :media_id)"; // ON CONFLICT DO NOTHING - not needed with isFavourite()
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':media_id', $mediaId);
    return $stmt->execute();
  }

  public function removeFromFavourites($userId, $mediaId)
  {
    $query = "DELETE FROM favourite_media WHERE user_id = :user_id AND media_id = :media_id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':media_id', $mediaId);
    return $stmt->execute();
  }

  public function isFavourite($userId, $mediaId)
  {
    $query = "SELECT 1 FROM favourite_media WHERE user_id = :user_id AND media_id = :media_id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':media_id', $mediaId);
    $stmt->execute();
    return $stmt->fetchColumn() !== false;
  }

  public function getUserFavorites($userId)
  {
    $query = "SELECT media_id FROM favourite_media WHERE user_id = :user_id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

}
