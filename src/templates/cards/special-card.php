<a href="#" class="special-card">
  <div class="special-card-image"
    style="background-image: url('<?= $specialRecipe->getRecipeImage() === '' ? $BASE_URL . 'assets/imgs/categories/' . str_replace(' ', '_', $specialRecipe->getCategory()) . '.jpg' : $BASE_URL . 'images/recipes/' . $specialRecipe->getId() . '/' . $specialRecipe->getRecipeImage() ?>');">
    ></div>
  <div class="special-info">
    <div class="special-title">
      <h4>
        <?= $specialRecipe->getTitle() ?>
      </h4>
    </div>
    <div class="special-time">
      <span><i class="bi bi-clock-fill"></i>
        <?= $specialRecipe->getPreparationTime() ?>min
      </span>
    </div>
  </div>
</a>