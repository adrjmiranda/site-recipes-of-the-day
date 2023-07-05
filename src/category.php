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
$categoryDao = new CategoryDAO($conn);
$recipeDAO = new RecipeDAO($conn);

$user = null;

if (isset($_SESSION['token'])) {
  $token = $_SESSION['token'];

  $user = $userDAO->findByToken($token);
}

if (!empty($_GET)) {
  if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id');

    $categ = $categoryDao->findById($id);
  }
}

if (!isset($categ)) {
  header('location: index.php');
}

$recipesByCategory = $recipeDAO->findByCategory($categ->getCategoryName(), 16);
$recipesByCategoryAll = $recipeDAO->findByCategory($categ->getCategoryName());
?>
<?php
require_once __DIR__ . '/templates/navbar.php';
?>
<div id="category" class="container-wrapper">
  <div id="category-banner"
    style="background: linear-gradient(rgba(0, 0, 0, .1), rgba(0, 0, 0, .1)), url('<?= $BASE_URL ?>assets/imgs/categories/<?= $categ->getCategoryImage() ?>') no-repeat center; background-size: cover;">
    ">
    <h1>
      <?= $categ->getCategoryName() ?>
    </h1>
    <div id="category-qtd">
      <span id="qtd">
        <?= count($recipesByCategoryAll) ?>
      </span> <span>recipes</span>
    </div>
    <div class="category-simbol">
      <img src="<?= $BASE_URL ?>assets/imgs/category_simbol.svg" alt="Category Simbol">
    </div>
  </div>
  <div id="category-recipes">
    <?php if (count($recipesByCategory) > 0): ?>
      <?php foreach ($recipesByCategory as $newRecipe): ?>
        <?php require __DIR__ . '/templates/cards/recipe-card.php' ?>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No recipe registered.</p>
    <?php endif; ?>
  </div>
</div>
<?php
require_once __DIR__ . '/templates/footer.php';
?>