<?php
require_once __DIR__ . '/utils/globals.php';

require_once __DIR__ . '/connection/conn.php';

require_once __DIR__ . '/dao/RecipeDAO.php';

use dao\RecipeDAO;

$recipeDAO = new RecipeDAO($conn);

$topRatedRecipes = $recipeDAO->findAll('rating', 4);
$specialRecipes = $recipeDAO->findByCategory('special', 4);
$newRecipes = $recipeDAO->findAll('id', 12);

$categoriesBg = [
  'rice_and_risotto.jpg',
  'birds.jpg',
  'meat.jpg',
  'pastas.jpg',
  'cakes.jpg',
  'sweets_and_desserts.jpg',
  'salads.jpg',
  'snacks_and_snacks.jpg',
  'starters_and_snacks.jpg',
  'breads.jpg',
  'fishes_and_sea_food.jpg',
  'drinks.jpg',
  'soups_and_broths.jpg',
  'special.jpg'
];
?>
<?php require_once __DIR__ . '/templates/navbar.php' ?>
<div id="banner">
  <?php foreach ($categoriesBg as $categoryBg): ?>
    <div class="category-bg container-wrapper"
      style="background: linear-gradient(rgba(0, 0, 0, .1), rgba(0, 0, 0, .1)), url('assets/imgs/categories/<?= $categoryBg ?>') no-repeat center; background-size: cover;">
    </div>
  <?php endforeach; ?>
</div>
</header>
<div id="most-searched-recipes">
  <div class="most-searched-recipes container-wrapper">
    <h3 class="title">Most searched recipes</h3>
    <div class="most-searched-recipes-card">
      <div class="most-searched-image">
        <div class="most-searched-time"><i class="bi bi-clock"></i> 20min</div>
      </div>
      <div class="most-searched-title">
        <h4>Lorem Ipsum is simply dummy</h4>
      </div>
    </div>
    <div class="most-searched-recipes-card">
      <div class="most-searched-image">
        <div class="most-searched-time"><i class="bi bi-clock"></i> 20min</div>
      </div>
      <div class="most-searched-title">
        <h4>Lorem Ipsum is simply dummy</h4>
      </div>
    </div>
    <div class="most-searched-recipes-card">
      <div class="most-searched-image">
        <div class="most-searched-time"><i class="bi bi-clock"></i> 20min</div>
      </div>
      <div class="most-searched-title">
        <h4>Lorem Ipsum is simply dummy</h4>
      </div>
    </div>
    <div class="most-searched-recipes-card">
      <div class="most-searched-image">
        <div class="most-searched-time"><i class="bi bi-clock"></i> 20min</div>
      </div>
      <div class="most-searched-title">
        <h4>Lorem Ipsum is simply dummy</h4>
      </div>
    </div>
  </div>
</div>
<div id="top-rated">
  <div class="top-rated container-wrapper">
    <h3 class="title">Top rated</h3>
    <?php foreach ($topRatedRecipes as $topRatedRecipe): ?>
      <?php require __DIR__ . '/templates/cards/top-rated-card.php' ?>
    <?php endforeach; ?>
  </div>
</div>
<div id="special">
  <div class="special container-wrapper">
    <h3 class="title">Special</h3>
    <?php foreach ($specialRecipes as $specialRecipe): ?>
      <?php require __DIR__ . '/templates/cards/special-card.php' ?>
    <?php endforeach; ?>
  </div>
</div>
<div id="new-recipes">
  <div class="new-recipes container-wrapper">
    <h3 class="title">New recipes</h3>
    <?php foreach ($newRecipes as $newRecipe): ?>
      <?php require __DIR__ . '/templates/cards/recipe-card.php' ?>
    <?php endforeach; ?>
  </div>
</div>
<?php require_once __DIR__ . '/templates/footer.php' ?>