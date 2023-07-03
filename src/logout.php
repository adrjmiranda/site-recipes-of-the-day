<?php

require_once __DIR__ . '/utils/globals.php';
require_once __DIR__ . '/connection/conn.php';
require_once __DIR__ . '/dao/UserDAO.php';

use dao\UserDAO;

$userDAO = new UserDAO($conn);

if (isset($_SESSION['token'])) {
  $token = $_SESSION['token'];

  $user = $userDAO->findByToken($token);

  $userDAO->destroyToken($user);
}

$_SESSION = array();

if (ini_get("session.use_cookies")) {
  $params = session_get_cookie_params();
  setcookie(
    session_name(),
    '', time() - 42000,
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]
  );
}

session_destroy();

header('location: index.php');