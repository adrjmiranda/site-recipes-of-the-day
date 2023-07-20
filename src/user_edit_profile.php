<?php
require_once __DIR__ . '/utils/globals.php';
require_once __DIR__ . '/utils/Error.php';
require_once __DIR__ . '/utils/validations.php';
require_once __DIR__ . '/utils/format_input.php';
require_once __DIR__ . '/connection/conn.php';
require_once __DIR__ . '/dao/CategoryDAO.php';
require_once __DIR__ . '/dao/UserDAO.php';

use dao\CategoryDAO;
use dao\UserDAO;
use utils\Error;

$categoryDAO = new CategoryDAO($conn);
$userDAO = new UserDAO($conn);

$user = null;

if (isset($_SESSION['token'])) {
  $token = $_SESSION['token'];

  $user = $userDAO->findByToken($token);
}

if (!$user) {
  header('location: index.php');
}

if (!empty($_POST)) {
  if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
    $name = filter_input(INPUT_POST, 'name');
    $password = filter_input(INPUT_POST, 'password');
    $confirm_password = filter_input(INPUT_POST, 'confirm_password');

    if (isEmpty($name)) {
      Error::setError('ERR_EMPTY_NAME', true);
    } else {
      Error::setError('ERR_EMPTY_NAME', false);

      if (isInvalidName($name)) {
        Error::setError('ERR_INVALID_NAME', true);
      } else {
        Error::setError('ERR_INVALID_NAME', false);

        $newUserData = $user;

        $name = removeUnnecessarySpaces($name);
        $newUserData->setName($name);

        if (!isEmpty($password)) {
          if (isInvalidPassword($password)) {
            Error::setError('ERR_INVALID_PASSWORD', true);
          } else {
            Error::setError('ERR_INVALID_PASSWORD', false);

            if (isEmpty($confirm_password)) {
              Error::setError('ERR_EMPTY_CONFIRM_PASSWORD', true);
            } else {
              Error::setError('ERR_EMPTY_CONFIRM_PASSWORD', false);

              if (ifPasswordAndPasswordConfirmationDoNotMatch($password, $confirm_password)) {
                Error::setError('ERR_INVALID_CONFIRM_PASSWORD', true);
              } else {
                Error::setError('ERR_INVALID_CONFIRM_PASSWORD', false);

                $finalPassword = $newUserData->generatePasswordHash($password);

                $newUserData->setPassword($finalPassword);
              }
            }
          }
        } else {
          Error::setError('ERR_INVALID_PASSWORD', false);
        }

        // profile image
        if ($_FILES['profile_image'] && $_FILES['profile_image']['tmp_name']) {
          $profile_image = $_FILES['profile_image'];

          $imagesTypes = ['image/jpeg', 'image/jpg', 'image/png'];
          $jpgArray = ['image/jpeg', 'image/jpg'];

          if (in_array($profile_image['type'], $imagesTypes)) {
            Error::setError('ERR_INVALID_IMAGE_TYPE', false);

            if (in_array($profile_image['type'], $jpgArray)) {
              $imageFile = imagecreatefromjpeg($profile_image['tmp_name']);
            } else {
              $imageFile = imagecreatefrompng($profile_image['tmp_name']);
            }

            $imageName = $newUserData->generateImageName();

            $path = 'images/users/' . $newUserData->getId();

            if (!file_exists($path)) {
              mkdir($path);
            }

            if (imagejpeg($imageFile, $path . '/' . $imageName, 100)) {
              if ($newUserData->getProfileImage() != '') {
                $lastProfileImage = $newUserData->getProfileImage();
                unlink($path . '/' . $lastProfileImage);
              }

              $newUserData->setProfileImage($imageName);
              Error::setError('ERR_UPDATE_PROFILE_IMAGE', false);
            } else {
              Error::setError('ERR_UPDATE_PROFILE_IMAGE', true);
            }
          } else {
            Error::setError('ERR_INVALID_IMAGE_TYPE', true);
          }
        }

        // update user
        if ($userDAO->update($newUserData)) {
          Error::setError('ERR_UPDATING_USER', false);
        } else {
          Error::setError('ERR_UPDATING_USER', true);
        }
      }
    }
  } else {
    Error::setError('ERR_UPDATING_USER', true);
  }
}
?>
<?php
require_once __DIR__ . '/templates/navbar.php';
?>
<div id="user-edit-profile" class="container-wrapper">
  <form action="user_edit_profile.php" id="edit-profile-form" method="post" enctype="multipart/form-data">
    <div class="error empty-fields">
      <?php if (Error::$ERROR_TYPES['ERR_UPDATING_USER']): ?>
        <p>
          <?= Error::$ERROR_MSG['ERR_UPDATING_USER'] ?>
        </p>
      <?php endif; ?>
    </div>
    <div class="profile-image"
      style="background-image: url('<?= $user->getProfileImage() == '' ? $BASE_URL . 'images/users/default_user.png' : $BASE_URL . 'images/users/' . $user->getId() . '/' . $user->getProfileImage() ?>');">
    </div>
    <div class="input-field">
      <p>New profile image:</p>
      <label for="profile_image" id="label-profile-image">Upload new image</label>
      <input type="file" name="profile_image" id="profile_image">
      <div class="error">
        <?php if (Error::$ERROR_TYPES['ERR_INVALID_IMAGE_TYPE']): ?>
          <p>
            <?= Error::$ERROR_MSG['ERR_INVALID_IMAGE_TYPE'] ?>
          </p>
        <?php elseif (Error::$ERROR_TYPES['ERR_UPDATE_PROFILE_IMAGE']): ?>
          <p>
            <?= Error::$ERROR_MSG['ERR_UPDATE_PROFILE_IMAGE'] ?>
          </p>
        <?php endif; ?>
      </div>
    </div>
    <div class="input-field">
      <label for="name">New name:</label>
      <input type="text" name="name" id="name" placeholder="Your name"
        value="<?= isset($name) ? $name : $user->getName() ?>">
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
      <label for="email">E-mail</label>
      <input disabled type="email" name="email" id="email" placeholder="Your e-mail" value="<?= $user->getEmail() ?>">
    </div>
    <div class="input-field">
      <label for="password">New password:</label>
      <input type="password" name="password" id="password" placeholder="Your new password">
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
    <div class="input-field">
      <label for="confirm_password">Confirm your new password:</label>
      <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password">
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
    <input type="submit" value="Update" class="btn">
  </form>
</div>
<?php
require_once __DIR__ . '/templates/footer.php';
?>