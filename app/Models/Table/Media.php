<?php

namespace App\Models\Table;

class Media
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db->getConnection();
  }

  // add a record to media table
  public function createMedia($mediaName, $mimeType, $fileSize, $fileName, $takenDate = null, $description = null, $downloadUrl = null)
  {
    $query = "INSERT INTO media (media_name, mime_type, file_size, file_name, taken_date, media_description, download_url)
              VALUES (:media_name, :mime_type, :file_size, :file_name, :taken_date, :media_description, :download_url)";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':media_name', $mediaName);
    $stmt->bindParam(':mime_type', $mimeType);
    $stmt->bindParam(':file_size', $fileSize);
    $stmt->bindParam(':file_name', $fileName);
    $stmt->bindParam(':taken_date', $takenDate);
    $stmt->bindParam(':media_description', $description);
    $stmt->bindParam(':download_url', $downloadUrl);

    return $stmt->execute() ? $this->db->lastInsertId() : false;
  }


  public function findMediaById($mediaId)
  {
    $query = "SELECT * FROM media WHERE media_id = :media_id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':media_id', $mediaId);
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public function deleteMediaById($mediaId)
  {
    $query = "DELETE FROM media WHERE media_id = :media_id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':media_id', $mediaId);
    return $stmt->execute();
  }
}
