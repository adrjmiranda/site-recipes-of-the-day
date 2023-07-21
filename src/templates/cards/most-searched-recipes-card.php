<a href="<?= $BASE_URL . 'recipe.php?id=' . $mostSearchedRecipe->getId() ?>" class="most-searched-recipes-card">
  <div class="most-searched-image"
    style="background-image: url('<?= $mostSearchedRecipe->getRecipeImage() === '' ? $BASE_URL . 'assets/imgs/categories/' . str_replace(' ', '_', $mostSearchedRecipe->getCategory()) . '.jpg' : $BASE_URL . 'images/recipes/' . $mostSearchedRecipe->getRecipeImage() ?>');">
    >
    <div class="most-searched-time"><i class="bi bi-clock"></i>
      <?= $mostSearchedRecipe->getPreparationTime() ?>min
    </div>
  </div>
  <div class="most-searched-title">
    <h4>
      <?= $mostSearchedRecipe->getTitle() ?>
    </h4>
  </div>
</a>