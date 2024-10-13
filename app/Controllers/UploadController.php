<?php

require_once '../app/Managers/ImageManager.php';

class UploadController
{
  private $imageManager;
  private $errors = [];

  public function __construct(ImageManager $imageManager)
  {
    $this->imageManager = $imageManager;
  }

  public function upload()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
      $image = $_FILES['image'];
      print_r($image);

      // validate file upload
      if ($image['error'] !== UPLOAD_ERR_OK) {
        $this->errors['upload_error'] = 'Pildi üles laadimisel esines viga.';
      } else {
        // check file type
        $fileType = mime_content_type($image['tmp_name']);
        if (strpos($fileType, 'image/') === false) {
          $this->errors['invalid_file_type'] = 'Tegu pole pildiga, palun lae üles pildifail.';
        }

        // image upload and processing
        if (empty($this->errors)) {
          $result = $this->imageManager->processImageUpload($image);

          if ($result !== true) {
            $this->errors['upload_failed'] = 'Pildi üleslaadimine ebaõnnestus. Palun proovi uuesti.';
          } else {
            header('Location: /index.php');
            exit();
          }
        }
      }

      return $this->errors;
    }

    return null;
  }
}
