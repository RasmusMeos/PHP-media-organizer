<?php

namespace App\Controllers\Auth;

use App\Core\BaseController;
use App\Models\Table\Users;

class Signup extends BaseController
{

  private $userModel;
  private $errors = [];

  public function __construct(Users $userModel)
  {
    $this->userModel = $userModel;
  }

  public function displaySignupForm() {
    $data = ['errors' => $_SESSION['errors_signup'] ?? []];
    unset($_SESSION['errors_signup']);
    $this->render('auth/signup', $data);
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
        if ($this->userModel->findByUsername($username)) {
          $this->errors['username_taken'] = 'Kasutajanimi juba eksisteerib';
        }
        if ($this->userModel->findByEmail($email)) {
          $this->errors['email_in_use'] = 'E-mail juba kasutusel';
        }
      }

      if (empty($this->errors)) {
        $hashedPassword = password_hash($pwd, PASSWORD_BCRYPT);
        $result = $this->userModel->createUser($username, $email, $hashedPassword);

        if ($result) {
          $_SESSION['user_id'] = (int)$this->userModel->getLastInsertedUserId();
          $_SESSION['username'] = $username;

          $this->redirect('/');
        } else {
          $this->errors['registration_failed'] = 'Registreerimine ebaõnnestus. Proovige uuesti.';
        }
      }
      if (!empty($this->errors)) {
        $_SESSION['errors_signup'] = $this->errors;
        $this->redirect("/signup");
      }
    }
    $this->redirect('/');
  }
}
