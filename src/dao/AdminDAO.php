<?php

namespace dao;

require_once __DIR__ . '/../models/Admin.php';

use models\Admin;
use models\AdminDAOInterface;
use PDO;

class AdminDAO implements AdminDAOInterface
{
  private $conn;

  public function __construct(PDO $conn)
  {
    $this->conn = $conn;
  }

  public function buildAdmin($data)
  {
    $admin = new Admin();

    $admin->setId($data['id']);
    $admin->setName($data['name']);
    $admin->setEmail($data['email']);
    $admin->setPassword($data['password']);
    $admin->setToken($data['token']);

    return $admin;
  }

  public function findByToken($token)
  {
    $admin = null;

    $stmt = $this->conn->prepare('SELECT * FROM admin WHERE token = :token LIMIT 1');

    $stmt->bindParam(':token', $token);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetch();

      $admin = $this->buildAdmin($data);
    }

    return $admin;
  }

  public function findByEmail($email)
  {
    $admin = null;

    $stmt = $this->conn->prepare('SELECT * FROM admin WHERE email = :email LIMIT 1');

    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetch();

      $admin = $this->buildAdmin($data);
    }

    return $admin;
  }

  public function update(Admin $admin)
  {
    $id = $admin->getId();
    $name = $admin->getName();
    $email = $admin->getEmail();
    $password = $admin->getPassword();
    $token = $admin->getToken();

    $stmt = $this->conn->prepare('UPDATE admin SET name = :name, email = :email, password = :password, token = :token WHERE id = :id');

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':token', $token);

    try {
      $stmt->execute();

      return true;
    } catch (\PDOException $e) {
      return false;
    }
  }

  public function validatePassword($password, $hash)
  {
    return password_verify($password, $hash);
  }

  public function setTokenToSession($token)
  {
    $_SESSION['token'] = $token;
  }
}