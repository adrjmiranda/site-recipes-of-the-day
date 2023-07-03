<?php

namespace models;

class User
{
  private $id;
  private $name;
  private $email;
  private $password;
  private $profile_image;
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

  public function setProfileImage($profile_image)
  {
    $this->profile_image = $profile_image;
  }

  public function getProfileImage()
  {
    return $this->profile_image;
  }

  public function setToken($token)
  {
    $this->token = $token;
  }

  public function getToken()
  {
    return $this->token;
  }

  public function generatePasswordHash($password)
  {
    return password_hash($password, PASSWORD_DEFAULT);
  }

  public function generateToken()
  {
    return bin2hex(random_bytes(60)) . uniqid('', true);
  }

  public function generateImageName($profile_image)
  {
    return bin2hex(random_bytes(60)) . '.jpeg';
  }
}

interface UserDAOInterface
{
  public function buildUser($data);
  public function create(User $user);
  public function findAll();
  public function findById($id);
  public function findByEmail($email);
  public function findByToken($token);
  public function update(User $user);
  public function delete($id);
}