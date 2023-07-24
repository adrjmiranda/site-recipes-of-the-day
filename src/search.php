<?php
require_once __DIR__ . '/utils/globals.php';
require_once __DIR__ . '/connection/conn.php';

require_once __DIR__ . '/dao/CategoryDAO.php';
require_once __DIR__ . '/dao/UserDAO.php';
require_once __DIR__ . '/dao/RecipeDAO.php';

use dao\CategoryDAO;
use dao\UserDAO;
use dao\RecipeDAO;

$userDAO = new UserDAO($conn);

$user = null;

if (isset($_SESSION['token'])) {
  $token = $_SESSION['token'];

  $user = $userDAO->findByToken($token);
}

$categoryDAO = new CategoryDAO($conn);
$recipeDAO = new RecipeDAO($conn);

$search = filter_input(INPUT_POST, 'search');

$results = $recipeDAO->findByTitle($search, 16);
?>
<?php
require_once __DIR__ . '/templates/navbar.php';
?>
<div id="category" class="container-wrapper results">
  <h3 class="result-title">Results for:
    <span>
      <?= $search ?>
    </span>
  </h3>
  <div id="category-recipes">
    <?php if (count($results) > 0): ?>
      <?php foreach ($results as $newRecipe): ?>
        <?php require __DIR__ . '/templates/cards/recipe-card.php' ?>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No recipe found.</p>
    <?php endif; ?>
  </div>
</div>
<?php
require_once __DIR__ . '/templates/footer.php';
?>