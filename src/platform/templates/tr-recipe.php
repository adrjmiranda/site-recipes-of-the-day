<tr>
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
    <button class="edit-recipe"><i class="bi bi-pencil-square"></i></button>
    <button class="delete-recipe"><i class="bi bi-trash"></i></button>
  </td>
</tr>