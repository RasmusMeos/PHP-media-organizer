<?php

namespace app\Models\Aggregate;

class UserMediaAgg
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db->getConnection();
  }

  public function getUserMedia($userId, $limit, $offset, array $filters = [])
  {
    $baseQuery = "
        SELECT m.*
        FROM users_media um
        JOIN media m ON um.media_id = m.media_id
        WHERE um.user_id = :user_id
    ";

    $params = [':user_id' => $userId];
    $conditions = [];

    // applying media filters (if needed)
    if (isset($filters['type'])) {
      $conditions[] = "m.mime_type LIKE :type";
      $params[':type'] = "{$filters['type']}%";
    }

    if (isset($filters['order']) && in_array(strtolower($filters['order']), ['asc', 'desc'])) {
      $order = strtoupper($filters['order']);
    } else {
      $order = 'DESC'; // Default ordering
    }

    // conditions and ordering
    if (!empty($conditions)) {
      $baseQuery .= ' AND ' . implode(' AND ', $conditions);
    }

    $baseQuery .= " ORDER BY m.created_at $order LIMIT :limit OFFSET :offset";

    // pagination parameters
    $params[':limit'] = $limit;
    $params[':offset'] = $offset;

    $stmt = $this->db->prepare($baseQuery);
    foreach ($params as $key => $value) {
      $stmt->bindValue($key, $value);
    }

    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }


public function getUserMediaCount($userId, array $filters = []) {
  $baseQuery = "SELECT COUNT(*) AS total
                  FROM users_media um
                  JOIN media m ON um.media_id = m.media_id
                  WHERE um.user_id = :user_id";

  $params = [':user_id' => $userId];
  $conditions = [];
  if (isset($filters['type'])) {
    $conditions[] = "m.mime_type LIKE :type";
    $params[':type'] = "{$filters['type']}%";
  }
  if (!empty($conditions)) {
    $baseQuery .= ' AND ' . implode(' AND ', $conditions);
  }

  $stmt = $this->db->prepare($baseQuery);
  foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
  }
  $stmt->execute();
  return $stmt->fetchColumn();
}

}
