<tr>
  <td class="hide">
    <?= $recipe->getId() ?>
  </td>
  <td>
    <?= $recipe->getTitle() ?>
  </td>
  <td>
    <?= $recipe->getCategory() ?>
  </td>
  <td>
    <?= $recipe->getRating() ?>
  </td>
  <td class="td-actions">
    <a href="<?= $BASE_URL ?>/../platform/edit_recipe.php?id=<?= $recipe->getId() ?>" class="edit-recipe"><i
        class="bi bi-pencil-square"></i></a>
    <a href="<?= $BASE_URL ?>/../platform/delete_recipe.php?id=<?= $recipe->getId() ?>" class="delete-recipe"><i
        class="bi bi-trash"></i></a>
  </td>
</tr>