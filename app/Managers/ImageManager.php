<?php

namespace App\Managers;

 class ImageManager
 {
   private $imageModel;

   public function __construct(\App\Models\Image $imageModel)
   {
     $this->imageModel = $imageModel;
   }

   public function processImageUpload($image) {

     $targetDir = '../uploads/user_images/';
     $imageName = uniqid($_SESSION['user_id'] . '_') . basename($image['name']);
     $targetFile = $targetDir . $imageName;

     // uploaded file -> target directory
     if (move_uploaded_file($image['tmp_name'], $targetFile)) {
       // extract EXIF data (if available)
       $exif = @exif_read_data($targetFile);
       $takenDate = isset($exif['DateTimeOriginal']) ? date('Y-m-d H:i:s', strtotime($exif['DateTimeOriginal'])) : null;
       $uploadDate = date('Y-m-d H:i:s');

       // image info -> database
       return $this->imageModel->createImage($_SESSION['user_id'], basename($image['name']), $takenDate, $uploadDate, $targetFile);
     } else {
       return false;
     }

   }

   public function getImagesByUserID($userID) {
     return $this->imageModel->findImagesByUserID($userID);
   }

 }
