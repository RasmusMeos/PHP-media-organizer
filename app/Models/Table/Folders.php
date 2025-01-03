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
}
