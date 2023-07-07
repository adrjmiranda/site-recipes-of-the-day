<?php
require_once __DIR__ . '/utils/globals.php';
require_once __DIR__ . '/connection/conn.php';
require_once __DIR__ . '/dao/UserDAO.php';
require_once __DIR__ . '/dao/CategoryDAO.php';

use dao\UserDAO;
use dao\CategoryDAO;

$userDAO = new UserDAO($conn);
$categoryDAO = new CategoryDAO($conn);

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
<div id="user-profile" class="container-wrapper">
  <div class="profile-container">
    <div class="profile-image"
      style="background-image: url('<?= $user->getProfileImage() == '' ? $BASE_URL . 'images/users/default_user.png' : $BASE_URL . 'images/users/' . $user->getId() . '/' . $user->getProfileImage() ?>');">
    </div>
    <div class="profile-name">
      <h2>
        <?= $user->getName() ?>
      </h2>
    </div>
    <div class="profile-info">
      <div class="profile-email">
        <p><span>E-mail:</span>
          <?= $user->getEmail() ?>
        </p>
      </div>
    </div>
    <a href="<?= $BASE_URL ?>user_edit_profile.php" class="btn">Edit</a>
  </div>
</div>
<?php
require_once __DIR__ . '/templates/footer.php';
?>