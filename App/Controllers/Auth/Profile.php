<?php

namespace App\Controllers\Auth;

use App\Core\BaseController;
use App\Models\Table\Users;

class Profile extends BaseController
{
  private $userModel;
  public function __construct(Users $userModel)
  {
    $this->userModel = $userModel;
  }

  public function profile() {
    if (!isset($_SESSION['user_id'])) {
      $this->redirect('/login'); // redirect to login if not authenticated
    }

    $user_data = $this->userModel->findByUsername($_SESSION['username']);
    $data = ['errors' => $_SESSION['errors_profile'] ?? [],
      'user_data' => $user_data ?? []];
    unset($_SESSION['errors_profile']);

    $this->render('auth/profile', $data);
    }


  public function changeScreenName() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $screenName = trim($_POST['screen_name']);
      if (empty($screenName)) {
        $_SESSION['errors_profile'] = ['screen_name_empty' => 'Teistele nähtava nime väli on tühi.'];
        $this->redirect('/profile');
      } else {
        $updated = $this->userModel->updateUserScreenName($_SESSION['user_id'], $screenName);
        if ($updated) {
          $_SESSION['screen_name'] = $screenName;
        } else {
          $_SESSION['errors_profile'] = ['update_failed' => 'Nime uuendamine ebaõnnestus.'];
        }
        $this->redirect('/');
      }
      $this->redirect('/profile');
    }
  }


}
