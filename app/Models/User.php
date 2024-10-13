<?php

class User
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
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

  public function findByUsername($username)
  {
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

public function getLastInsertedID() {
    return $this->db->lastInsertId();
}





}
