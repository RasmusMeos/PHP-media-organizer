<?php

require_once '../config/session.php';
$config = require_once '../config/config.php';
require_once '../app/core/Autoloader.php';
require_once '../app/core/pathHelper.php';

App\Core\Autoloader::loadClass();


$db = new App\Core\Database($config['db']);

$imageModel = new App\Models\Image($db);
$imageManager = new App\Managers\ImageManager($imageModel);
$uploadController = new App\Controllers\Media\UploadImage($imageManager);

$errors = $uploadController->upload();

if ($errors) {
  $_SESSION['errors_upload'] = $errors;
  header('Location: /upload.php');
  exit();
}

// Render the upload view
require_once '../app/views/upload_view.php';

