<tr>
  <td class="hide">
    <?= $recipe->getId() ?>
  </td>
  <td class="recipe-title">
    <?= $recipe->getTitle() ?>
  </td>
  <td class="recipe-category">
    <?= $recipe->getCategory() ?>
  </td>
  <td class="recipe-rating">
    <?= $recipe->getRating() ?>
  </td>
  <td class="td-actions recipe-actions">
    <a href="<?= $BASE_URL ?>/../platform/edit_recipe.php?id=<?= $recipe->getId() ?>" class="edit-recipe"><i
        class="bi bi-pencil-square"></i></a>
    <a href="<?= $BASE_URL ?>/../platform/delete_recipe.php?id=<?= $recipe->getId() ?>" class="delete-recipe"><i
        class="bi bi-trash"></i></a>
  </td>
</tr>