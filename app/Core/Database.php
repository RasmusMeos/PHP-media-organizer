<?php

class Database {
  private $pdo;

  public function __construct($config) {
    // DSN (Data Source Name)
    $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

    // PDO ühenduse loomine
    try {
      $this->pdo = new PDO($dsn, $config['user'], $config['password']);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      // Kui ühendus ebaõnnestub
      echo "Database connection failed: " . $e->getMessage();
      die();
    }
  }

  public function getConnection() {
    return $this->pdo;
  }

}

