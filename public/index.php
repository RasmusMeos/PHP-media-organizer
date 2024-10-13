<?php

require_once '../config/session.php';
$config = require_once '../config/config.php';

require_once '../app/Core/Database.php';
require_once '../app/Managers/ImageManager.php';
require_once '../app/Models/Image.php';

$db = new Database($config['db']);
$is_logged_in = isset($_SESSION['user_id']);



$images = [];
if($is_logged_in) {
  $imageModel = new Image($db);
  $imageManager = new ImageManager($imageModel);
  $images = $imageManager->getImagesByUserID($_SESSION['user_id']);

}

require_once '../app/Views/main_gallery_view.php';



echo __DIR__ . "\n" . dirname(__FILE__);









