<?php
require_once __DIR__ . '/../utils/globals.php';
require_once __DIR__ . '/../utils/Error.php';

use utils\Error;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recipes Of The Day</title>
  <link rel="stylesheet" href="<?= $BASE_URL ?>/../platform/css/styles.css">
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
</head>

<body>
  <div id="admin-login" class="container">
    <form action="" method="post">
      <h2>Login to Platform</h2>
      <div class="profile-image"
        style="background-image: url('<?= $BASE_URL . '/../platform/assets/profile_image_default.svg' ?>');"></div>
      <div class="input-field">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" placeholder="Your e-mail">
      </div>
      <div class="input-field">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Your password">
      </div>
      <input type="submit" class="btn" value="Enter">
    </form>
  </div>
</body>

</html>