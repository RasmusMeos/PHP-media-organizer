<?php

require_once '../config/session.php';
$config = require_once '../config/config.php';

require_once '../app/core/Database.php';
require_once '../app/core/BaseController.php';
require_once '../app/Controllers/Auth/Login.php';
require_once '../app/Managers/UserManager.php';
require_once '../app/Models/User.php';
require_once '../app/Managers/UserManager.php';

$db = new App\Core\Database($config['db']);

$userModel = new App\Models\User($db);
$userManager = new App\Managers\UserManager($userModel);
$loginController = new App\Controllers\Auth\Login($userManager);

$errors = $loginController->login();

if ($errors) {
  $_SESSION['errors_login'] = $errors;
  header('Location: login.php');
  exit();
}

require_once '../app/views/login_view.php';
