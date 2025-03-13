<?php

namespace App\Models\Aggregate;

class UserFoldersAgg
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db->getConnection();
  }

  public function getUserFolders($userId)
  {
    $query = "
            SELECT f.folder_id, f.folder_name, f.folder_description, f.created_at, uf.is_admin
            FROM users_folders uf
            JOIN folders f ON uf.folder_id = f.folder_id
            WHERE uf.user_id = :user_id
            ORDER BY f.created_at DESC
        ";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':user_id', $userId);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
}

