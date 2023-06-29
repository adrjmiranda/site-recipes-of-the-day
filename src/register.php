<?php
require_once __DIR__ . '/utils/globals.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?= $BASE_URL ?>assets/recipesoftheday_icon.svg" type="image/x-icon">
  <title>Recipes Of The Day</title>
  <!-- style sheet -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>css/styles.css">
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Pacifico&display=swap"
    rel="stylesheet">
  <!-- bootstrap icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
  <div class="container">
    <form action="register.php" id="register-form" method="post">
      <h2>Create an account:</h2>
      <div class="input-field">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" placeholder="Your name">
        <i class="bi bi-person-fill"></i>
      </div>
      <div class="input-field">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" placeholder="Your e-mail">
        <i class="bi bi-envelope-fill"></i>
      </div>
      <div class="input-field">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Your password">
        <div class="show-pass">
          <i class="bi bi-lock-fill"></i>
          <i class="bi bi-unlock-fill"></i>
        </div>
      </div>
      <div class="input-field">
        <label for="confirm_password">Confirm password:</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password">
        <div class="show-pass">
          <i class="bi bi-lock-fill"></i>
          <i class="bi bi-unlock-fill"></i>
        </div>
      </div>
      <input type="submit" value="Register" class="btn">
    </form>
  </div>
</body>