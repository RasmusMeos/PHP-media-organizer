<?php

namespace App\Models\Table;

class Users
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db->getConnection();
  }

  public function createUser($username, $email, $pwdHashed) {
    $query = "INSERT INTO users (username, email, pwd) VALUES (:username, :email,:pwd)";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pwd', $pwdHashed);
    return $stmt->execute();
  }

public function findByEmail($email)
{
  $query = "SELECT * FROM users WHERE email = :email";
  $stmt = $this->db->prepare($query);
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  return $stmt->fetch(\PDO::FETCH_ASSOC);
}

  public function findByUsername($username)
  {
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

public function getLastInsertedUserId() {
    return $this->db->lastInsertId();
}

  public function updateUserScreenName($userId, $newUserName)
  {
    $query = "UPDATE users SET screen_name = :screen_name WHERE user_id = :user_id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':screen_name', $newUserName);
    $stmt->bindParam(':user_id', $userId);
    return $stmt->execute();
  }

  public function updateUserPassword($userId, $newPassword){
    $query = "UPDATE users SET pwd = :pwd WHERE user_id = :user_id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':pwd', $newPassword);
    $stmt->bindParam(':user_id', $userId);
    return $stmt->execute();
  }

  public function getUserScreenName($userId){
    $query = "SELECT screen_name FROM users WHERE user_id = :user_id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $result['screen_name'] ?? null;
  }






}
