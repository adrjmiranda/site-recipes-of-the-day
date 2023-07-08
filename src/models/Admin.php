<?php

namespace models;

class Admin
{
  private $id;
  private $name;
  private $email;
  private $password;
  private $token;

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setToken($token)
  {
    $this->token = $token;
  }

  public function getToken()
  {
    return $this->token;
  }

  public function generateToken()
  {
    return bin2hex(random_bytes(60)) . uniqid('', true);
  }

  public function generatePasswordHash($password)
  {
    return password_hash($password, PASSWORD_DEFAULT);
  }
}

interface AdminDAOInterface
{
  public function buildAdmin($data);
  public function findByToken($token);
  public function findByEmail($email);
  public function update(Admin $admin);
  public function validatePassword($password, $hash);
  public function setTokenToSession($token);
}