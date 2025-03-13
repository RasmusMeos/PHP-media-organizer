<?php

namespace App\Models\Table;

class Folders
{
  private $db;
  public function __construct($db)
  {
    $this->db = $db->getConnection();
  }

  public function getLastCreatedFolderID() {
    return $this->db->lastInsertId();
  }

  public function createFolder($folderName, $folderDesc = NULL) {
    $query = "INSERT INTO folders (folder_name, folder_description) VALUES (:folder_name, :folder_description)";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':folder_name', $folderName);
    $stmt->bindParam(':folder_description', $folderDesc);
    return $stmt->execute();
  }

  public function updateFolderDetails(int $folderId, string $newName, string|bool $newDesc): bool
  {
    $query = "UPDATE folders SET folder_name = :folder_name";
    $params = [':folder_name' => $newName, ':folder_id' => $folderId];

    if ($newDesc !== false) {
      $query .= ", folder_description = :folder_desc";
      $params[':folder_desc'] = $newDesc;
    }

    $query .= " WHERE folder_id = :folder_id";

    $stmt = $this->db->prepare($query);
    foreach ($params as $param => $value) {
      $stmt->bindValue($param, $value);
    }
    return $stmt->execute();
  }
}
