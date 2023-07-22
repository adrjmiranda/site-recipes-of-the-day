<tr>
  <td class="hide">
    <?= $user->getId() ?>
  </td>
  <td>
    <?= $user->getEmail() ?>
  </td>
  <td>
    <?= $user->getName() ?>
  </td>
  <td class="td-actions">
    <a href="<?= $BASE_URL ?>/../platform/delete_user.php?id=<?= $user->getId() ?>" class="delete-user"><i
        class="bi bi-trash"></i></a>
  </td>
</tr>