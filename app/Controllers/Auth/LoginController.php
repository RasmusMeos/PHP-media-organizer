<?php

namespace App\Controllers\Auth;



class LoginController {

  private $userManager;
  private $errors = [];


  public function __construct(\UserManager $userManager)
  {
    $this->userManager = $userManager;
  }

  public function login() {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $username = $_POST['username'];
      $password = $_POST['password'];

      if (empty($username) || empty($password)) {
        $this->errors['empty_fields'] = 'Kõik väljad peavad olema täidetud.';
      } else {
        $user = $this->userManager->verifyUsernameExists($username);

        if ($user && password_verify($password, $user['pwd'])) {
          $_SESSION['user_id'] = $user['user_id'];
          $_SESSION['username'] = $user['username'];
          header('Location: /index.php');
          exit();
        } else {
          $this->errors['invalid_credentials'] = 'Vale kasutajanimi või parool.';
        }
      }

      return $this->errors;
    }

    return null;
  }

}
