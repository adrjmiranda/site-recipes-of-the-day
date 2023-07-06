<?php
require_once __DIR__ . '/utils/globals.php';

require_once __DIR__ . '/connection/conn.php';

require_once __DIR__ . '/dao/CategoryDAO.php';
require_once __DIR__ . '/dao/RecipeDAO.php';
require_once __DIR__ . '/dao/UserDAO.php';

use dao\CategoryDAO;
use dao\RecipeDAO;
use dao\UserDAO;

$userDAO = new UserDAO($conn);
$categoryDAO = new CategoryDAO($conn);
$recipeDAO = new RecipeDAO($conn);

$categoriesBg = $categoryDAO->findAll();

$mostSearchedRecipes = $recipeDAO->findAll('rating', 4);
$topRatedRecipes = $recipeDAO->findAll('rating', 4);
$specialRecipes = $recipeDAO->findByCategory('special', 4);
$newRecipes = $recipeDAO->findAll('id', 12);

$user = null;

if (isset($_SESSION['token'])) {
  $token = $_SESSION['token'];

  $user = $userDAO->findByToken($token);
}
?>
<?php require_once __DIR__ . '/templates/navbar.php' ?>
<div id="banner">
  <?php foreach ($categoriesBg as $category): ?>
    <?php require __DIR__ . '/templates/category-bg.php' ?>
  <?php endforeach; ?>
</div>
</header>
<div id="most-searched-recipes">
  <div class="most-searched-recipes container-wrapper">
    <h3 class="title">Most searched recipes</h3>
    <?php if (!empty($mostSearchedRecipes)): ?>
      <?php foreach ($mostSearchedRecipes as $mostSearchedRecipe): ?>
        <?php require __DIR__ . '/templates/cards/most-searched-recipes-card.php' ?>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="no-recipe">No recipe registered.</p>
    <?php endif; ?>
  </div>
</div>
<div id="top-rated">
  <div class="top-rated container-wrapper">
    <h3 class="title">Top rated</h3>
    <?php if (!empty($topRatedRecipes)): ?>
      <?php foreach ($topRatedRecipes as $topRatedRecipe): ?>
        <?php require __DIR__ . '/templates/cards/top-rated-card.php' ?>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="no-recipe">No recipe registered.</p>
    <?php endif; ?>
  </div>
</div>
<div id="special">
  <div class="special container-wrapper">
    <h3 class="title">Special</h3>
    <?php if (!empty($specialRecipes)): ?>
      <?php foreach ($specialRecipes as $specialRecipe): ?>
        <?php require __DIR__ . '/templates/cards/special-card.php' ?>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="no-recipe">No recipe registered.</p>
    <?php endif; ?>
  </div>
</div>
<div id="new-recipes">
  <div class="new-recipes container-wrapper">
    <h3 class="title">New recipes</h3>
    <?php if (!empty($newRecipes)): ?>
      <?php foreach ($newRecipes as $newRecipe): ?>
        <?php require __DIR__ . '/templates/cards/recipe-card.php' ?>
      <?php endforeach; ?>
    <? else: ?>
      <p class="no-recipe">No recipe registered.</p>
    <?php endif; ?>
  </div>
</div>
<?php require_once __DIR__ . '/templates/footer.php' ?>