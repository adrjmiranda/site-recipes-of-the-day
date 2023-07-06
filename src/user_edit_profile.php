<?php
require_once __DIR__ . '/utils/globals.php';
require_once __DIR__ . '/connection/conn.php';
require_once __DIR__ . '/dao/CategoryDAO.php';
require_once __DIR__ . '/dao/UserDAO.php';

use dao\CategoryDAO;
use dao\UserDAO;

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
?>
<?php
require_once __DIR__ . '/templates/navbar.php';
?>
<div id="user-edit-profile" class="container-wrapper">
  <form action="user_edit_profile.php" id="edit-profile-form" method="post" enctype="multipart/form-data">
    <div class="profile-image"
      style="background-image: url('<?= $user->getProfileImage() == '' ? $BASE_URL . 'images/users/default_user.png' : $BASE_URL . 'images/users/' . $user->getProfileImage() ?>');">
    </div>
    <div class="input-field">
      <p>New profile image:</p>
      <label for="profile_image" id="label-profile-image">Upload new image</label>
      <input type="file" name="profile_image" id="profile_image">
    </div>
    <div class="input-field">
      <label for="name">New name:</label>
      <input type="text" name="name" id="name" placeholder="Your name">
    </div>
    <div class="input-field">
      <label for="email">E-mail</label>
      <input disabled type="email" name="email" id="email" placeholder="Your e-mail">
    </div>
    <div class="input-field">
      <label for="password">New password:</label>
      <input type="password" name="password" id="password" placeholder="Your new password">
    </div>
    <div class="input-field">
      <label for="confirm_password">Confirm your new password:</label>
      <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password">
    </div>
    <input type="submit" value="Update" class="btn">
  </form>
</div>
<?php
require_once __DIR__ . '/templates/footer.php';
?>