<?php

namespace App\Core;

// use PDO, PDOException;
class Database {
  private $pdo;

  // PDO ühenduse loomine
  public function __construct($config) {

    try {
      // DSN (Data Source Name)
      if ($config['driver'] == 'sqlite') {
        $dsn = "sqlite:{$config['database']}";
        $this->pdo = new \PDO($dsn);
      } else {
        $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
        $this->pdo = new \PDO($dsn, $config['user'], $config['password']);
      }
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    } catch (\PDOException $e) {
      // Kui ühendus ebaõnnestub
      echo "Database connection failed: " . $e->getMessage();
      die();
    }
  }
  public function getConnection() {
    return $this->pdo;
  }

}

