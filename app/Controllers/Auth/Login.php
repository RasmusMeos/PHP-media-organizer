<?php

namespace App\Controllers\Auth;

use App\Core\BaseController;
use App\Managers\UserManager;

class Login extends BaseController {

  private $userManager;
  private $errors = [];


  public function __construct(UserManager $userManager)
  {
    $this->userManager = $userManager;
  }

  public function displayLoginForm() {
      $data = ['errors' => $_SESSION['errors_login'] ?? []];
      unset($_SESSION['errors_login']);
      $this->render('auth/login', $data);
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
          $this->redirect("/");
        } else {
          $this->errors['invalid_credentials'] = 'Vale kasutajanimi või parool.';
        }
      }

      if (!empty($this->errors)) {
        $_SESSION['errors_login'] = $this->errors;
        $this->redirect("/login");
      }
    }
    // If not POST request:
    $this->redirect("/login");
  }

}
