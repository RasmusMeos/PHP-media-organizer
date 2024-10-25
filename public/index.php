<?php

require_once '../config/session.php';
require_once '../app/core/Autoloader.php';
require_once '../app/core/pathHelper.php';
$config = require_once '../config/config.php';


App\Core\Autoloader::loadClass();

$db = new App\Core\Database($config['db']);
$is_logged_in = isset($_SESSION['user_id']);



$images = [];
if($is_logged_in) {
  $imageModel = new App\Models\Image($db);
  $imageManager = new App\Managers\ImageManager($imageModel);
  $images = $imageManager->getImagesByUserID($_SESSION['user_id']);

}

require_once '../app/views/main_gallery.php';



echo __DIR__ . "<br>" ;









