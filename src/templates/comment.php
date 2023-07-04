<?php
$user = $userDAO->findById($comment->getUserId());
?>
<div class="comment">
  <div class="user-profile">
    <?php if ($user->getProfileImage() == ''): ?>
      <div class="profile-image">
        <i class="bi bi-person-circle"></i>
      </div>
    <?php else: ?>
      <div class="profile-image"
        style="background-image: url('<?= $BASE_URL ?>images/users/<?= $user->getId() ?>/<?= $user->getProfileImage() ?>');">
      </div>
    <?php endif; ?>
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