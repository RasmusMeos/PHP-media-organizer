<?php
// config failid
require_once '../config/session.php';
$config = require '../config/config.php';
//require '../config/config.php';


require_once '../app/core/BaseController.php';
require_once '../app/core/Database.php';
require_once '../app/Controllers/Auth/Signup.php';
require_once '../app/Managers/UserManager.php';
require_once '../app/Models/User.php';

// init. db ühendus
$db = new App\Core\Database($config['db']);

$userModel = new App\Models\User($db);
$userManager = new App\Managers\UserManager($userModel);
$signupController = new App\Controllers\Auth\Signup($userManager);

// 'signup' form handler
$errors = $signupController->signup();

if ($errors) {
  $_SESSION['errors_signup'] = $errors;
  header('Location: /signup.php');
  exit();
}

require_once '../app/views/signup_view.php';
