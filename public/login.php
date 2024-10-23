<?php

require_once '../config/session.php';
$config = require_once '../config/config.php';

require_once '../app/Core/Database.php';
require_once '../app/Controllers/Auth/LoginController.php';
require_once '../app/Managers/UserManager.php';
require_once '../app/Models/User.php';

$db = new Database($config['db']);

$userModel = new User($db);
$userManager = new UserManager($userModel);
$loginController = new LoginController($userManager);

$errors = $loginController->login();

if ($errors) {
  $_SESSION['errors_login'] = $errors;
  header('Location: login.php');
  exit();
}

require_once '../app/views/login_view.php';
