<?php

require_once __DIR__ . '/../utils/globals.php';
require_once __DIR__ . '/../connection/conn.php';
require_once __DIR__ . '/../dao/UserDAO.php';
require_once __DIR__ . '/../dao/AdminDAO.php';

use dao\UserDAO;
use dao\AdminDAO;

$adminDAO = new AdminDAO($conn);

$admin = null;

if (isset($_SESSION['token'])) {
  $token = $_SESSION['token'];

  $admin = $adminDAO->findByToken($token);
}

if (!$admin) {
  header('location: login.php');
}

$id = filter_input(INPUT_GET, 'id');

$userDAO = new UserDAO($conn);

$user = $userDAO->findById($id);

if ($user) {
  $imagePath = dirname(__FILE__, 2) . '/images/users/' . $user->getProfileImage();

  if ($userDAO->delete($id)) {
    if ($user->getProfileImage() != '') {
      unlink($imagePath);
    }
  }
}

header('location: users_list.php');