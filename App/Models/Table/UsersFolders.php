<?php

namespace App\Models\Table;

class UsersFolders
{
  private $db;
  public function __construct($db)
  {
    $this->db = $db->getConnection();
  }

  public function assignUserToFolder($userId, $folderId, bool $isAdmin)
  {
    $query = "INSERT INTO users_folders (user_id, folder_id, is_admin)
        VALUES (:user_id, :folder_id, :is_admin)";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':user_id', $userId);
    $stmt->bindValue(':folder_id', $folderId);
    $stmt->bindValue(':is_admin', $isAdmin, \PDO::PARAM_BOOL);
    return $stmt->execute();
  }

}
