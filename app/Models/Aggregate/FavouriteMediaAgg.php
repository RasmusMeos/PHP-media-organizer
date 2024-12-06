<?php

namespace app\Models\Aggregate;

class FavouriteMediaAgg
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db->getConnection();
  }

  public function getFavouriteMedia($userId)
  {
    $query = "SELECT m.*
                  FROM favourite_media fm
                  JOIN media m ON fm.media_id = m.media_id
                  WHERE fm.user_id = :user_id
                  ORDER BY m.created_at DESC";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
}

