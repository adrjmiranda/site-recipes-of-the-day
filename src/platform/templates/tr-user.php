<tr>
  <td class="hide">
    <?= $user->getId() ?>
  </td>
  <td class="users-email">
    <?= $user->getEmail() ?>
  </td>
  <td class="users-name">
    <?= $user->getName() ?>
  </td>
  <td class="td-actions users-actions">
    <a href="<?= $BASE_URL ?>/../platform/delete_user.php?id=<?= $user->getId() ?>" class="delete-user"><i
        class="bi bi-trash"></i></a>
  </td>
</tr>