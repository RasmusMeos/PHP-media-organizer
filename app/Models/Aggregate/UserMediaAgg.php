<?php

namespace app\Models\Aggregate;

class UserMediaAgg
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db->getConnection();
  }

  public function getUserMedia($userId)
  {
    $query = "SELECT m.*
                  FROM users_media um
                  JOIN media m ON um.media_id = m.media_id
                  WHERE um.user_id = :user_id
                  ORDER BY m.created_at DESC";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
}
