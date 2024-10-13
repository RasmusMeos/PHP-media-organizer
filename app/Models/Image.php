<?php

class Image
{

  private $db;

  public function __construct($db)
  {
    $this->db = $db->getConnection();
  }

  public function createImage($userID, $imageName, $takenDate, $uploadDate, $filePath)
  {
    $query = "INSERT INTO images (user_id, image_name, taken_date, upload_date, file_path) 
              VALUES (:user_id, :image_name, :taken_date, :upload_date, :file_path)";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':user_id', $userID);
    $stmt->bindParam(':image_name', $imageName);
    $stmt->bindParam(':taken_date', $takenDate);
    $stmt->bindParam(':upload_date', $uploadDate);
    $stmt->bindParam(':file_path', $filePath);

    return $stmt->execute();
  }

  public function findImagesByUserID($userID) {
    $query = "SELECT * FROM images WHERE user_id = :user_id ORDER BY upload_date DESC";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':user_id', $userID);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }



}
