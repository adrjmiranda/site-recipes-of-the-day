<?php
require_once __DIR__ . '/utils/globals.php';

require_once __DIR__ . '/connection/conn.php';

require_once __DIR__ . '/dao/RecipeDAO.php';
require_once __DIR__ . '/dao/CommentDAO.php';
require_once __DIR__ . '/dao/UserDAO.php';

use dao\RecipeDAO;
use dao\CommentDAO;
use dao\UserDAO;

$recipeDAO = new RecipeDAO($conn);
$commentDAO = new CommentDAO($conn);
$userDAO = new UserDAO($conn);

$id = filter_input(INPUT_GET, 'id');

$recipe = $recipeDAO->findById($id);

if (!$recipe) {
  header('location: index.php');
}

$mostSearchedRecipes = $recipeDAO->findAll('id', 5);

$comments = $commentDAO->findByRecipeId($recipe->getId());

$user = null;
$alreadyCommented = null;

if (isset($_SESSION['token'])) {
  $token = $_SESSION['token'];

  $user = $userDAO->findByToken($token);
  $alreadyCommented = $commentDAO->checkIfUserHasAlreadyCommented($user, $recipe);
}
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
          <a
            href="<?= $BASE_URL ?>process/process_rating.php?rating=1&user_id=<?= $user->getId() ?>&recipe_id=<?= $recipe->getId() ?>"><i
              class="bi bi-star" data-star=1></i></a>
          <a
            href="<?= $BASE_URL ?>process/process_rating.php?rating=2&user_id=<?= $user->getId() ?>&recipe_id=<?= $recipe->getId() ?>"><i
              class="bi bi-star" data-star=2></i></a>
          <a
            href="<?= $BASE_URL ?>process/process_rating.php?rating=3&user_id=<?= $user->getId() ?>&recipe_id=<?= $recipe->getId() ?>"><i
              class="bi bi-star" data-star=3></i></a>
          <a
            href="<?= $BASE_URL ?>process/process_rating.php?rating=4&user_id=<?= $user->getId() ?>&recipe_id=<?= $recipe->getId() ?>"><i
              class="bi bi-star" data-star=4></i></a>
          <a
            href="<?= $BASE_URL ?>process/process_rating.php?rating=5&user_id=<?= $user->getId() ?>&recipe_id=<?= $recipe->getId() ?>"><i
              class="bi bi-star" data-star=5></i></a>
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
      <?php if (!empty($mostSearchedRecipes)): ?>
        <?php foreach ($mostSearchedRecipes as $mostSearchedRecipe): ?>
          <?php require __DIR__ . '/templates/cards/most-searched-recipes-card.php' ?>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="no-recipe">No recipe registered.</p>
      <?php endif; ?>
    </div>
  </div>
</div>
<div id="comments-container" class="container-wrapper">
  <?php if (!$user): ?>
    <div class="not-authorized">
      <p>Log in to say what you think of this recipe!</p>
    </div>
  <?php endif; ?>
  <h4>Comments:</h4>
  <?php if (!$alreadyCommented): ?>
    <form action="<?= $BASE_URL ?>process/process_comment.php" id="comment-form" method="post">
      <label for="comment">
        <i class="bi bi-chat-text-fill"></i>
      </label>
      <?php if ($user): ?>
        <input type="hidden" name="recipe_id" value="<?= $recipe->getId() ?>">
        <input type="hidden" name="user_id" value="<?= $user->getId() ?>">
        <input type="text" name="comment" id="comment" placeholder="What did you think of this recipe?" required>
        <button class="btn">comment</button>
      <?php else: ?>
        <input type="text" name="comment" id="comment" placeholder="What did you think of this recipe?" disabled>
        <!-- <button class="btn">comment</button> -->
        <input type="submit" value="comment" class="btn" disabled>
      <?php endif; ?>
    </form>
  <?php endif; ?>
  <div id="comments">
    <?php if (isset($comments)): ?>
      <?php foreach ($comments as $comment): ?>
        <?php require __DIR__ . '/templates/comment.php' ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>
<?php
require_once __DIR__ . '/templates/footer.php';
?>