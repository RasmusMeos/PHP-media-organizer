<?php

namespace App\Core;

// use PDO, PDOException;
class Database {
  private $pdo;
  private $table;

  public function __construct($config) {
    // DSN (Data Source Name)
    $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

    // PDO ühenduse loomine
    try {
      $this->pdo = new \PDO($dsn, $config['user'], $config['password']);
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


  // Common CRUD operations
  public function findById($id)
  {
    $query = "SELECT * FROM {$this->table} WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public function insert($data)
  {
    $fields = implode(', ', array_keys($data));
    $placeholders = ':' . implode(', :', array_keys($data));

    $query = "INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})";
    $stmt = $this->db->prepare($query);

    foreach ($data as $key => $value) {
      $stmt->bindValue(":{$key}", $value);
    }

    return $stmt->execute();
  }

  public function deleteById($id)
  {
    $query = "DELETE FROM {$this->table} WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }


}

