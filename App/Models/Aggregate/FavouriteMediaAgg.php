<?php

namespace app\Models\Aggregate;

class FavouriteMediaAgg
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db->getConnection();
  }

  public function getFavouriteMedia($userId, $limit, $offset)
  {
    $query = "SELECT m.*
                  FROM favourite_media fm
                  JOIN media m ON fm.media_id = m.media_id
                  WHERE fm.user_id = :user_id
                  ORDER BY m.created_at DESC
                  LIMIT :limit OFFSET :offset";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':limit', $limit);
    $stmt->bindParam(':offset', $offset);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function getFavouriteMediaTotalCount($userId) {
    $query = "SELECT COUNT(*) AS total
                  FROM favourite_media fm
                  JOIN media m ON fm.media_id = m.media_id
                  WHERE fm.user_id = :user_id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    return $stmt->fetchColumn();
  }
}

