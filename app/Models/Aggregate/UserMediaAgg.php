<?php

namespace app\Models\Aggregate;

class UserMediaAgg
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db->getConnection();
  }

  public function getUserMedia($userId, $limit, $offset)
  {
    $query = "SELECT m.*
                  FROM users_media um
                  JOIN media m ON um.media_id = m.media_id
                  WHERE um.user_id = :user_id
                  ORDER BY m.created_at DESC 
                  LIMIT :limit OFFSET :offset";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':limit', $limit);
    $stmt->bindParam(':offset', $offset);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

public function getUserMediaTotalCount($userId) {
  $query = "SELECT COUNT(*) AS total
                  FROM users_media um
                  JOIN media m ON um.media_id = m.media_id
                  WHERE um.user_id = :user_id";
  $stmt = $this->db->prepare($query);
  $stmt->bindParam(':user_id', $userId);
  $stmt->execute();
  return $stmt->fetchColumn();
}

}
