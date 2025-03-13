<?php

namespace App\Controllers\Auth;

use App\Core\BaseController;
use App\Models\Table\Users;

class ChangePassword extends BaseController
{
  private $userModel;
  private $errors = [];

  public function __construct(Users $userModel)
  {
    $this->userModel = $userModel;
  }
  public function displayChangePasswordForm() {
    $data = ['errors' => $_SESSION['errors_change_pwd'] ?? []];
    unset($_SESSION['errors_change_pwd']);
    $this->render('auth/change_password', $data);
  }

  public function changePassword() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $old_pwd = $_POST['old_pwd'];
      $new_pwd = $_POST['pwd'];
      $confirm_pwd = $_POST['pwd_confirm'];

      if (empty($old_pwd) || empty($new_pwd) || empty($confirm_pwd)) {
        $this->errors['empty_fields'] = 'Kõik väljad peavad olema täidetud.';
        $_SESSION['errors_change_pwd'] = $this->errors;
        $this->redirect('change-password');
      }
      $user = $this->userModel->findByUsername($_SESSION['username']);
      if ($user && password_verify($old_pwd, $user['pwd']) === false) {
        $this->errors['wrong_password'] = 'Sisestatud kehtiv parool on vale.';
        $_SESSION['errors_change_pwd'] = $this->errors;
        $this->redirect('change-password');
      }

      if ($new_pwd !== $confirm_pwd) {
        $this->errors['matching_pwd'] = 'Uue parooli väljad ei ühti.';
        $_SESSION['errors_change_pwd'] = $this->errors;
        $this->redirect('change-password');
      }
      $hashedPassword = password_hash($new_pwd, PASSWORD_BCRYPT);
      $result = $this->userModel->updateUserPassword($user['user_id'], $hashedPassword);
      if(!$result){
        $this->errors['pwd_update_failed'] = 'Parooli uuendamine ebaõnnestus.';
        $_SESSION['errors_change_pwd'] = $this->errors;
        $this->redirect('change-password');
      }
      $this -> redirect('/');
    }
    $this -> redirect('/');

  }
}
