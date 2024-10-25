<?php

namespace App\Controllers\Auth;

use App\Core\BaseController;
class Signup extends BaseController
{

  private $userManager;
  private $errors = [];

  public function __construct(\App\Managers\UserManager $userManager)
  {
    $this->userManager = $userManager;
  }

  public function signup()
  {
    $this->errors = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $pwd = $_POST['password'];



      if (empty($username) || empty($email) || empty($pwd)) {
        $this->errors['empty_fields'] = 'Kõik väljad peavad olema täidetud';
      }

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->errors['invalid_email'] = 'Sisestatud e-mail ei ole sobiv.';
        print_r($this->errors);
      }

      if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        $this->errors['invalid_username'] = 'Kasutajanimi tohib sisaldada ainult tähti ja/või numbreid';
      }

      if (empty($this->errors)) {
        if ($this->userManager->verifyUsernameExists($username)) {
          $this->errors['username_taken'] = 'Kasutajanimi juba eksisteerib';
        }
        if ($this->userManager->verifyEmailExists($email)) {
          $this->errors['email_in_use'] = 'E-mail juba kasutusel';
        }
      }

      if (empty($this->errors)) {
        $result = $this->userManager->register($username, $email, $pwd);
        if ($result === true) {

          $_SESSION['user_id'] = $this->userManager->getLastRegisteredUserID();
          $_SESSION['username'] = $username;

          header('Location: /index.php');
          exit();
        } else {
          $this->errors['registration_failed'] = 'Registreerimine ebaõnnestus. Proovige uuesti.';
        }
      }
      return $this->errors;
    }
    return null;
  }
}
