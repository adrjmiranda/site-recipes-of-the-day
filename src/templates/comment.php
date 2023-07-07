<?php
$user = $userDAO->findById($comment->getUserId());
?>
<div class="comment">
  <div class="user-profile">
    <div class="profile-image"
      style="background-image: url('<?= $user->getProfileImage() == '' ? $BASE_URL . 'images/users/default_user.png' : $BASE_URL . 'images/users/' . $user->getId() . '/' . $user->getProfileImage() ?>');">
    </div>
    <div class="profile-name">
      <h5>
        <?= $user->getName() ?>
      </h5>
    </div>
  </div>
  <div class="user-comment">
    <p>
      <?= $comment->getComment() ?>
    </p>
  </div>
</div>