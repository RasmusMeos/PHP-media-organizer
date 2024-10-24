<?php
// config failid
require_once '../config/session.php';
$config = require '../config/config.php';
//require '../config/config.php';



require_once '../app/core/Database.php';
require_once '../app/Controllers/Signup.php';
require_once '../app/Managers/UserManager.php';
require_once '../app/Models/User.php';

// init. db ühendus
$db = new Database($config['db']);

$userModel = new User($db);
$userManager = new UserManager($userModel);
$signupController = new SignupController($userManager);

// 'signup' form handler
$errors = $signupController->signup();

if ($errors) {
  $_SESSION['errors_signup'] = $errors;
  header('Location: /signup.php');
  exit();
}

require_once '../app/views/signup_view.php';
