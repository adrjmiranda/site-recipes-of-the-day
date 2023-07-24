<?php
require_once __DIR__ . '/../utils/globals.php';
require_once __DIR__ . '/../connection/conn.php';
require_once __DIR__ . '/../utils/validations.php';
require_once __DIR__ . '/../utils/Error.php';

require_once __DIR__ . '/../dao/AdminDAO.php';

use utils\Error;
use dao\AdminDAO;

if (!empty($_POST)) {
  if (isset($_POST['email']) && isset($_POST['password'])) {
    Error::setError('ERR_LOGIN_FAILED', false);

    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    if (isEmpty($email) || isEmpty($password)) {
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
    } elseif (isInvalidEmail($email) || isInvalidPassword($password)) {
      // Error::clearErrors();

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
      $adminDAO = new AdminDAO($conn);
      $admin = $adminDAO->findByEmail($email);

      if ($adminDAO->validatePassword($password, $admin->getPassword())) {
        Error::setError('ERR_INCORRECT_EMAIL_OR_PASSWORD', false);

        $token = $admin->generateToken();

        $adminDAO->setTokenToSession($token);

        $admin->setToken($token);

        if ($adminDAO->update($admin)) {
          Error::setError('ERR_LOGIN_FAILED', false);

          header('location: index.php');
        } else {
          Error::setError('ERR_LOGIN_FAILED', true);
        }
      } else {
        Error::setError('ERR_INCORRECT_EMAIL_OR_PASSWORD', true);
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
  <link rel="shortcut icon" href="<?= $BASE_URL ?>/../platform/assets/profile_image_default.svg" type="image/x-icon">
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
    <form action="login.php" method="post">
      <h2>Login to Platform</h2>
      <div class="general-error">
        <?php if (Error::$ERROR_TYPES['ERR_LOGIN_FAILED']): ?>
          <p>
            <?= Error::$ERROR_MSG['ERR_LOGIN_FAILED'] ?>
          </p>
        <?php elseif (Error::$ERROR_TYPES['ERR_INCORRECT_EMAIL_OR_PASSWORD']): ?>
          <p>
            <?= Error::$ERROR_MSG['ERR_INCORRECT_EMAIL_OR_PASSWORD'] ?>
          </p>
        <?php endif; ?>
      </div>
      <div class="profile-image"
        style="background-image: url('<?= $BASE_URL . '/../platform/assets/profile_image_default.svg' ?>');"></div>
      <div class="input-field">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" placeholder="Your e-mail">
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
        <input type="password" name="password" id="password" placeholder="Your password">
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
      <input type="submit" class="btn" value="Enter">
    </form>
  </div>
</body>

</html>