<?php
require_once __DIR__ . '/utils/globals.php';

require_once __DIR__ . '/connection/conn.php';

require_once __DIR__ . '/dao/RecipeDAO.php';

use dao\RecipeDAO;

$recipeDAO = new RecipeDAO($conn);

$id = filter_input(INPUT_GET, 'id');

$recipe = $recipeDAO->findById($id);

if (!$recipe) {
  header('location: index.php');
}

$mostSearchedRecipes = $recipeDAO->findAll('id', 5);
?>
<?php
require_once __DIR__ . '/templates/navbar.php';
?>
</header>
<div id="recipe-container" class="container-wrapper">
  <div id="recipe">
    <div id="recipe-image">
      <div class="recipe-photo"
        style="background-image: url('<?= $recipe->getRecipeImage() === '' ? $BASE_URL . 'assets/imgs/categories/' . str_replace(' ', '_', $recipe->getCategory()) . '.jpg' : $BASE_URL . 'images/recipes/' . $recipe->getId() . '/' . $recipe->getRecipeImage() ?>');">
        <div class="title">
          <h1>
            <?= $recipe->getTitle() ?>
          </h1>
        </div>
      </div>
      <div class="info">
        <div class="portions-and-time">
          <div class="portions"><i class="bi bi-circle-half"></i>
            <?= $recipe->getPortions() ?> portions
          </div>
          <div class="time"><i class="bi bi-clock-fill"></i>
            <?= $recipe->getPreparationTime() ?>min
          </div>
        </div>
        <div class="rating">
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star"></i>
        </div>
      </div>
    </div>
    <div id="recipe-body">
      <div id="ingredients">
        <h4 class="title">Ingredients:</h4>
        <ul>
          <?php foreach (json_decode($recipe->getIngredients(), true) as $ingredient): ?>
            <li>
              <i class="bi bi-check-lg"></i>
              <?= $ingredient ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div id="method-of-preparation">
        <h4 class="title">Methods of preparation:</h4>
        <p>
          <?= $recipe->getMethodOfPreparation() ?>
        </p>
      </div>
      <div id="tips">
        <h4 class="title">Tips:</h4>
        <p>
          <?= $recipe->getTips() ?>
        </p>
      </div>
    </div>
  </div>
  <div id="others-recipes">
    <h4 class="title">you might also like...</h4>
    <div class="others">
      <?php foreach ($mostSearchedRecipes as $mostSearchedRecipe): ?>
        <?php require __DIR__ . '/templates/cards/most-searched-recipes-card.php' ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<div id="comments-container" class="container-wrapper">
  <h4>Comments:</h4>
  <form action="#" id="comment-form">
    <label for="comment">
      <i class="bi bi-chat-text-fill"></i>
    </label>
    <input type="text" name="comment" id="comment" placeholder="What did you think of this recipe?">
    <button class="btn">comment</button>
  </form>
  <div id="comments">
    <div class="comment">
      <div class="user-profile">
        <div class="profile-image">
          <i class="bi bi-person-circle"></i>
        </div>
        <div class="profile-name">
          <h5>User name</h5>
        </div>
      </div>
      <div class="user-comment">
        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking
          at its layout. The poin.</p>
      </div>
    </div>
  </div>
</div>
<?php
require_once __DIR__ . '/templates/footer.php';
?>