<?php

namespace dao;

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/CommentDAO.php';

use models\UserDAOInterface;
use models\User;
use dao\CommentDAO;
use PDO;

class UserDAO implements UserDAOInterface
{
  private $conn;

  public function __construct(PDO $conn)
  {
    $this->conn = $conn;
  }

  public function buildUser($data)
  {
    $user = new User();

    $user->setId($data['id']);
    $user->setName($data['name']);
    $user->setEmail($data['email']);
    $user->setPassword($data['password']);
    $user->setProfileImage($data['profile_image']);
    $user->setToken($data['token']);

    return $user;
  }

  public function create(User $user)
  {
    $stmt = $this->conn->prepare('INSERT INTO users (
      name,
      email,
      password
    ) VALUES (
      :name,
      :email,
      :password
    )');

    $name = $user->getName();
    $email = $user->getEmail();
    $password = $user->getPassword();

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    try {
      $stmt->execute();
      return true;
    } catch (\PDOException $error) {
      return false;
    }
  }

  public function findAll()
  {
    $users = [];

    $stmt = $this->conn->prepare('SELECT * FROM users');

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetchAll();

      foreach ($data as $user) {
        $user = $this->buildUser($user);

        array_push($users, $user);
      }
    }

    return $users;
  }

  public function findById($id)
  {
    $user = null;

    $stmt = $this->conn->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');

    $stmt->bindParam(':id', $id);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetch();

      $user = $this->buildUser($data);
    }

    return $user;
  }

  public function findByEmail($email)
  {
    $user = null;

    $stmt = $this->conn->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');

    $stmt->bindParam(':email', $email);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetch();

      $user = $this->buildUser($data);
    }

    return $user;
  }

  public function findByToken($token)
  {
    if (!$token) {
      return null;
    }

    $user = null;

    $stmt = $this->conn->prepare('SELECT * FROM users WHERE token = :token LIMIT 1');

    $stmt->bindParam(':token', $token);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetch();

      $user = $this->buildUser($data);
    }

    return $user;
  }

  public function update(User $user)
  {
    $id = $user->getId();
    $name = $user->getName();
    $email = $user->getEmail();
    $password = $user->getPassword();
    $profile_image = $user->getProfileImage();
    $token = $user->getToken();

    $stmt = $this->conn->prepare('UPDATE users SET
      name = :name,
      email = :email,
      password = :password,
      profile_image = :profile_image,
      token = :token
    WHERE id = :id');

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':profile_image', $profile_image);
    $stmt->bindParam(':token', $token);

    try {
      $stmt->execute();

      return true;
    } catch (\PDOException $error) {
      return false;
    }
  }

  public function delete($id)
  {
    $commnetDAO = new CommentDAO($this->conn);

    $comment = $commnetDAO->findByUserId($id);

    if($comment) {
      $commnetDAO->delete($comment->getId());
    }

    $stmt = $this->conn->prepare('DELETE FROM users WHERE id = :id');

    $stmt->bindParam(':id', $id);

    $stmt->execute();
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