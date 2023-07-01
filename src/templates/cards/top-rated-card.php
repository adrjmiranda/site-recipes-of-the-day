<a href="#" class="top-rated-card">
  <div class="top-rated-image"
    style="background-image: url('<?= $topRatedRecipe->getRecipeImage() === '' ? $BASE_URL . 'assets/imgs/categories/' . str_replace(' ', '_', $topRatedRecipe->getCategory()) . '.jpg' : $BASE_URL . 'images/recipes/' . $topRatedRecipe->getId() . '/' . $topRatedRecipe->getRecipeImage() ?>');">
    >
    <div class="top-rated-title">
      <h4>
        <?= $topRatedRecipe->getTitle() ?>
      </h4>
    </div>
    <div class="top-rated-rating"><i class="bi bi-star-fill"></i>
      <?= $topRatedRecipe->getRating() === 0 ? '' : $topRatedRecipe->getRating() ?>
    </div>
  </div>
</a>