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

  public function updateFolderName($folderId, $newName)
  {
    $query = "UPDATE folders SET folder_name = :folder_name WHERE folder_id = :folder_id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':folder_name', $newName);
    $stmt->bindParam(':folder_id', $folderId);
    return $stmt->execute();
  }
}
