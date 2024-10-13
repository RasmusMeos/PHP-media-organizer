<?php

require_once '../config/session.php';
$config = require_once '../config/config.php';

require_once '../app/Core/Database.php';
require_once '../app/Controllers/UploadController.php';
require_once '../app/Managers/ImageManager.php';
require_once '../app/Models/Image.php';

$db = new Database($config['db']);

$imageModel = new Image($db);
$imageManager = new ImageManager($imageModel);
$uploadController = new UploadController($imageManager);

$errors = $uploadController->upload();

if ($errors) {
  $_SESSION['errors_upload'] = $errors;
  header('Location: /upload.php');
  exit();
}

// Render the upload view
require_once '../app/Views/upload_view.php';

