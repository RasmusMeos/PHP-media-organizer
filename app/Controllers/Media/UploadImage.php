<?php

namespace App\Controllers\Media;

use \App\Core\BaseController;
use App\Models\Table\Media;
use App\Models\Table\UsersMedia;

class UploadImage extends BaseController
{
  private $mediaModel;
  private $usersMediaModel;
  private $errors = [];

  public function __construct(Media $mediaModel, UsersMedia $usersMediaModel)
  {
    $this->mediaModel = $mediaModel;
    $this->usersMediaModel = $usersMediaModel;
  }

  public function displayUploadForm() {
    $data = ['errors' => $_SESSION['errors_upload'] ?? []];
    unset($_SESSION['errors_upload']);
    $this->render('media/upload_form', $data);
  }

  public function upload() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
      $image = $_FILES['image'];

      // validate file upload
      if ($image['error'] !== UPLOAD_ERR_OK) {
        $this->errors['upload_error'] = 'Pildi üles laadimisel esines viga.';
      } else {
        // check file type
        $fileType = mime_content_type($image['tmp_name']);
        if (strpos($fileType, 'image/') === false) {
          $this->errors['invalid_file_type'] = 'Tegu pole pildiga, palun lae üles pildifail.';
        } else {
          $this->processImageUpload($image, $fileType);
        }
      }

      if (!empty($this->errors)) {
        $_SESSION['errors_upload'] = $this->errors;
        $this->redirect('/upload');
      }
      $this->redirect('/'); //success

    }
    $this->redirect('/upload'); //not POST request
  }

  private function processImageUpload($image, $fileType)
  {
    $mediaName = pathinfo($image['name'], PATHINFO_FILENAME);
    $fileExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $fileName = uniqid() . '_' . time() . '.' . $fileExtension;
    $targetDir = base_path('uploads/images/');
    $targetFile = $targetDir . $fileName;

    // uploaded file -> target directory
    if (move_uploaded_file($image['tmp_name'], $targetFile)) {
      $fileSize = filesize($targetFile);
      $takenDate = $this->extractTakenDate($targetFile);

      // inserting entry to media table
      $mediaId = $this->mediaModel->createMedia(
        $mediaName, $fileType, $fileSize, $fileName, $takenDate
      );

      // linking to user in users_media table
      if ($mediaId) {
        $this->usersMediaModel->linkUserToMedia($_SESSION['user_id'], $mediaId);
      } else {
        $this->errors['database_error'] = 'Sisestamine andmebaasi ebaõnnestus.';
      }
    } else {
      $this->errors['file_upload_failed'] = 'Üleslaetud faili liigutamine ebaõnnestus.';
    }
  }

  private function extractTakenDate($filePath)
  {
    $exif = @exif_read_data($filePath);
    return isset($exif['DateTimeOriginal']) ? date('Y-m-d H:i:s', strtotime($exif['DateTimeOriginal'])) : null;
  }




}
