<a href="<?= $BASE_URL . 'recipe.php?id=' . $newRecipe->getId() ?>" class="recipe-card">
  <div class="recipe-image"
    style="background-image: url('<?= $newRecipe->getRecipeImage() === '' ? $BASE_URL . 'assets/imgs/categories/' . str_replace(' ', '_', $newRecipe->getCategory()) . '.jpg' : $BASE_URL . 'images/recipes/' . $newRecipe->getRecipeImage() ?>');">
    <h4>
      <?= $newRecipe->getTitle() ?>
    </h4>
    <div class="recipe-time"><i class="bi bi-stopwatch"></i>
      <?= $newRecipe->getPreparationTime() ?>min
    </div>
    <span class="rating"><i class="bi bi-star-fill"></i>
      <?= $newRecipe->getRating() === 0 ? '-' : $newRecipe->getRating() ?>
    </span>
  </div>
</a>