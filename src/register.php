<?php
require_once __DIR__ . '/utils/globals.php';
require_once __DIR__ . '/connection/conn.php';
require_once __DIR__ . '/utils/validations.php';
require_once __DIR__ . '/utils/format_input.php';
require_once __DIR__ . '/utils/Error.php';

require_once __DIR__ . '/dao/UserDAO.php';
require_once __DIR__ . '/models/User.php';

use utils\Error;
use dao\UserDAO;
use models\User;

$user = new User();
$userDAO = new UserDAO($conn);

if (!empty($_POST)) {
  if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    $confirm_password = filter_input(INPUT_POST, 'confirm_password');

    if (isEmpty($name) || isEmpty($email) || isEmpty($password) || isEmpty($confirm_password)) {
      Error::setError('ERR_ALL_FIELDS_EMPTY', true);

      if (isEmpty($name)) {
        Error::setError('ERR_EMPTY_NAME', true);
      } else {
        Error::setError('ERR_EMPTY_NAME', false);
      }

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

      if (isEmpty($confirm_password)) {
        Error::setError('ERR_EMPTY_CONFIRM_PASSWORD', true);
      } else {
        Error::setError('ERR_EMPTY_CONFIRM_PASSWORD', false);
      }
    } else {
      Error::setError('ERR_ALL_FIELDS_EMPTY', false);

      if (isInvalidName($name) || isInvalidEmail($email) || isInvalidPassword($password)) {
        if (isInvalidName($name)) {
          Error::setError('ERR_INVALID_NAME', true);
        } else {
          Error::setError('ERR_INVALID_NAME', false);
        }

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

        if (ifPasswordAndPasswordConfirmationDoNotMatch($password, $confirm_password)) {
          Error::setError('ERR_INVALID_CONFIRM_PASSWORD', true);
        } else {
          Error::setError('ERR_INVALID_CONFIRM_PASSWORD', false);

          $name = removeUnnecessarySpaces($name);

          $user->setName($name);
          $user->setEmail($email);

          $finalPassword = $user->generatePasswordHash($password);

          $user->setPassword($finalPassword);

          if ($userDAO->create($user)) {
            Error::setError('ERR_REGISTRATION_FAILED', false);
            header('location: login.php');
          } else {
            Error::setError('ERR_REGISTRATION_FAILED', true);
          }
        }
      }
    }
  } else {
    Error::setError('ERR_REGISTRATION_FAILED', true);
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
    <form action="register.php" id="register-form" method="post">
      <h2>Create an account:</h2>
      <div class="error empty-fields">
        <?php if (Error::$ERROR_TYPES['ERR_ALL_FIELDS_EMPTY']): ?>
          <p>
            <?= Error::$ERROR_MSG['ERR_ALL_FIELDS_EMPTY'] ?>
          </p>
        <?php elseif (Error::$ERROR_TYPES['ERR_REGISTRATION_FAILED']): ?>
          <p>
            <?= Error::$ERROR_MSG['ERR_REGISTRATION_FAILED'] ?>
          </p>
        <?php endif; ?>
      </div>
      <div class="input-field">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" placeholder="Your name"
          value="<?= isset($_POST['name']) ? $name : '' ?>" required>
        <i class="bi bi-person-fill"></i>
        <div class="error">
          <?php if (Error::$ERROR_TYPES['ERR_EMPTY_NAME']): ?>
            <p>
              <?= Error::$ERROR_MSG['ERR_EMPTY_NAME'] ?>
            </p>
          <?php elseif (Error::$ERROR_TYPES['ERR_INVALID_NAME']): ?>
            <p>
              <?= Error::$ERROR_MSG['ERR_INVALID_NAME'] ?>
            </p>
          <?php endif; ?>
        </div>
      </div>
      <div class="input-field">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" placeholder="Your e-mail"
          value="<?= isset($_POST['email']) ? $email : '' ?>" required>
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
          value="<?= isset($_POST['password']) ? $password : '' ?>" required minlength="8">
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
      <div class="input-field">
        <label for="confirm_password">Confirm password:</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password"
          value="<?= isset($_POST['confirm_password']) ? $confirm_password : '' ?>" required>
        <div class="show-pass" id="show-confirm-pass">
          <i class="bi bi-lock-fill hidden"></i>
          <i class="bi bi-unlock-fill"></i>
          <div class="error">
            <?php if (Error::$ERROR_TYPES['ERR_EMPTY_CONFIRM_PASSWORD']): ?>
              <p>
                <?= Error::$ERROR_MSG['ERR_EMPTY_CONFIRM_PASSWORD'] ?>
              </p>
            <?php elseif (Error::$ERROR_TYPES['ERR_INVALID_CONFIRM_PASSWORD']): ?>
              <p>
                <?= Error::$ERROR_MSG['ERR_INVALID_CONFIRM_PASSWORD'] ?>
              </p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <button type="submit" class="btn form-btn">Register</button>
      <p class="change-form">Already have an account? <a href="<?= $BASE_URL ?>login.php">Login</a>.</p>
    </form>
  </div>
</body>