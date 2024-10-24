<?php

namespace App\Managers;

class UserManager
{

  private $userModel;

  public function __construct( $userModel)
  {
    $this->userModel = $userModel;
  }

  public function register($username, $email, $pwd)
  {
    $pwdHashed = password_hash($pwd, PASSWORD_BCRYPT);
    return $this->userModel->createUser($username, $email, $pwdHashed);
  }

  public function verifyUsernameExists($username) {
    return $this->userModel->findByUsername($username);
  }

  public function verifyEmailExists($email) {
    return $this->userModel->findByEmail($email);
  }

  public function getLastRegisteredUserID() {
    return $this->userModel->getLastInsertedID();
  }


}
