<?php

namespace App\Models\Table;

class UsersMedia
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db->getConnection();
  }

  // Link a user to a media entry
  public function linkUserToMedia($userId, $mediaId)
  {
    $query = "INSERT INTO users_media (user_id, media_id) VALUES (:user_id, :media_id)";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':media_id', $mediaId);
    return $stmt->execute();
  }

  // Unlink a user from a media entry
  public function unlinkUserFromMedia($userId, $mediaId)
  {
    $query = "DELETE FROM users_media WHERE user_id = :user_id AND media_id = :media_id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':media_id', $mediaId);
    return $stmt->execute();
  }
}
