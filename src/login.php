<?php
require_once __DIR__ . '/utils/globals.php';
require_once __DIR__ . '/utils/validations.php';
require_once __DIR__ . '/utils/Error.php';

use utils\Error;

if (!empty($_POST)) {
  if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    if (isEmpty($email) || isEmpty($password)) {
      Error::setError('ERR_ALL_FIELDS_EMPTY', true);

      if (isEmpty($email)) {
        Error::setError('ERR_EMPTY_EMAIL', true);
      } else {
        Error::setError('ERR_EMPTY_EMAIL', false);
      }

      if (isEmpty($password)) {
        Error::setError('ERR_EMPTY_PASSWORD', true);
      } else {
        Error::setError('ERR_EMPTY_PASSWORD', false);
      }
    } else {
      Error::setError('ERR_ALL_FIELDS_EMPTY', false);

      if (isInvalidEmail($email) || isInvalidPassword($password)) {
        if (isInvalidEmail($email)) {
          Error::setError('ERR_INVALID_EMAIL', true);
        } else {
          Error::setError('ERR_INVALID_EMAIL', false);
        }

        if (isInvalidPassword($password)) {
          Error::setError('ERR_INVALID_PASSWORD', true);
        } else {
          Error::setError('ERR_INVALID_PASSWORD', false);
        }
      } else {
        Error::clearErrors();

        // validate user
      }
    }
  } else {
    Error::setError('ERR_LOGIN_FAILED', true);
  }
}
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
  <!-- scripts -->
  <script src="<?= $BASE_URL ?>js/show-pass.js" defer></script>
</head>

<body>
  <div id="form-container">
    <form action="login.php" id="register-form" method="post">
      <h2>Login:</h2>
      <div class="error empty-fields">
        <?php if (Error::$ERROR_TYPES['ERR_ALL_FIELDS_EMPTY']): ?>
          <p>
            <?= Error::$ERROR_MSG['ERR_ALL_FIELDS_EMPTY'] ?>
          </p>
        <?php elseif (Error::$ERROR_TYPES['ERR_LOGIN_FAILED']): ?>
          <p>
            <?= Error::$ERROR_MSG['ERR_LOGIN_FAILED'] ?>
          </p>
        <?php endif; ?>
      </div>
      <div class="input-field">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" placeholder="Your e-mail"
          value="<?= isset($_POST['email']) ? $email : '' ?>">
        <i class="bi bi-envelope-fill"></i>
        <div class="error">
          <?php if (Error::$ERROR_TYPES['ERR_EMPTY_EMAIL']): ?>
            <p>
              <?= Error::$ERROR_MSG['ERR_EMPTY_EMAIL'] ?>
            </p>
          <?php elseif (Error::$ERROR_TYPES['ERR_INVALID_EMAIL']): ?>
            <p>
              <?= Error::$ERROR_MSG['ERR_INVALID_EMAIL'] ?>
            </p>
          <?php endif; ?>
        </div>
      </div>
      <div class="input-field">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Your password"
          value="<?= isset($_POST['password']) ? $password : '' ?>">
        <div class="show-pass" id="show-pass">
          <i class="bi bi-lock-fill hidden"></i>
          <i class="bi bi-unlock-fill"></i>
          <div class="error">
            <?php if (Error::$ERROR_TYPES['ERR_EMPTY_PASSWORD']): ?>
              <p>
                <?= Error::$ERROR_MSG['ERR_EMPTY_PASSWORD'] ?>
              </p>
            <?php elseif (Error::$ERROR_TYPES['ERR_INVALID_PASSWORD']): ?>
              <p>
                <?= Error::$ERROR_MSG['ERR_INVALID_PASSWORD'] ?>
              </p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <button type="submit" class="btn form-btn">Login</button>
      <p class="change-form">You don't have an account yet. <a href="<?= $BASE_URL ?>register.php">Register</a>.</p>
    </form>
  </div>
</body>