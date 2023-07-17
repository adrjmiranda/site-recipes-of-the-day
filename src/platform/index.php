<?php
require_once __DIR__ . '/../utils/globals.php';
require_once __DIR__ . '/../connection/conn.php';
require_once __DIR__ . '/../utils/Error.php';
require_once __DIR__ . '/utils/validations.php';
require_once __DIR__ . '/../dao/AdminDAO.php';
require_once __DIR__ . '/../dao/RecipeDAO.php';
require_once __DIR__ . '/../dao/CategoryDAO.php';

use dao\AdminDAO;
use dao\RecipeDAO;
use dao\CategoryDAO;
use utils\Error;

$adminDAO = new AdminDAO($conn);
$recipeDAO = new RecipeDAO($conn);
$categoryDAO = new CategoryDAO($conn);

$admin = null;

if (isset($_SESSION['token'])) {
  $token = $_SESSION['token'];

  $admin = $adminDAO->findByToken($token);
}

if (!$admin) {
  header('location: login.php');
}

$recipes = $recipeDAO->findAll('id');
$categories = $categoryDAO->findAll();

// try add recipe

if (isset($_POST)) {
  if (
    isset($_POST['title'])
    && isset($_POST['ingredients'])
    && isset($_POST['method_of_preparation'])
    && isset($_POST['tips'])
    && isset($_POST['portions'])
    && isset($_POST['preparation_time'])
    && isset($_POST['category'])
  ) {
    $title = filter_input(INPUT_POST, 'title');
    $ingredients = filter_input(INPUT_POST, 'ingredients');
    $method_of_preparation = filter_input(INPUT_POST, 'method_of_preparation');
    $tips = filter_input(INPUT_POST, 'tips');
    $portions = filter_input(INPUT_POST, 'portions');
    $preparation_time = filter_input(INPUT_POST, 'preparation_time');
    $category = filter_input(INPUT_POST, 'category');

    if (
      isEmpty($title) ||
      isEmpty($ingredients) ||
      isEmpty($method_of_preparation) ||
      isEmpty($tips) ||
      isEmpty($portions) ||
      isEmpty($preparation_time) ||
      isEmpty($category)
    ) {
      if (isEmpty($title)) {
        Error::setError('ERR_EMPTY_TITLE', true);
      } else {
        Error::setError('ERR_EMPTY_TITLE', false);
      }

      if (isEmpty($ingredients)) {
        Error::setError('ERR_EMPTY_INGREDIENTS', true);
      } else {
        Error::setError('ERR_EMPTY_INGREDIENTS', false);
      }

      if (isEmpty($method_of_preparation)) {
        Error::setError('ERR_EMPTY_METHOD_PREPARATION', true);
      } else {
        Error::setError('ERR_EMPTY_METHOD_PREPARATION', false);
      }

      if (isEmpty($tips)) {
        Error::setError('ERR_EMPTY_TIPS', true);
      } else {
        Error::setError('ERR_EMPTY_TIPS', false);
      }

      if (isEmpty($portions)) {
        Error::setError('ERR_EMPTY_PORTIONS', true);
      } else {
        Error::setError('ERR_EMPTY_PORTIONS', false);
      }

      if (isEmpty($preparation_time)) {
        Error::setError('ERR_EMPTY_PREPARATION_TIME', true);
      } else {
        Error::setError('ERR_EMPTY_PREPARATION_TIME', false);
      }

      if (isEmpty($category)) {
        Error::setError('ERR_EMPTY_CATEGORY', true);
      } else {
        Error::setError('ERR_EMPTY_CATEGORY', false);
      }
    } else {
      Error::clearErrors();

      if (isInvalidTitle($title) || isInvalidPortions($portions) || isInvalidPreparationTime($preparation_time) || isInvalidCategory($category)) {
        if (isInvalidTitle($title)) {
          Error::setError('ERR_INVALID_TITLE', true);
        } else {
          Error::setError('ERR_INVALID_TITLE', false);
        }

        if (isInvalidPortions($portions)) {
          Error::setError('ERR_INVALID_TITLE', true);
        } else {
          Error::setError('ERR_INVALID_TITLE', false);
        }

        if (isInvalidPreparationTime($preparation_time)) {
          Error::setError('ERR_INVALID_TITLE', true);
        } else {
          Error::setError('ERR_INVALID_TITLE', false);
        }

        if (isInvalidCategory($category)) {
          Error::setError('ERR_INVALID_TITLE', true);
        } else {
          Error::setError('ERR_INVALID_TITLE', false);
        }
      } else {
        Error::clearErrors();

        // try add recipe
      }
    }
  } else {
    Error::setError('ERR_FILURE_TO_ADD_RECIPE', true);
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?= $BASE_URL ?>/../platform/assets/profile_image_default.svg" type="image/x-icon">
  <title>Platform - Recipes Of The Day</title>
  <link rel="stylesheet" href="<?= $BASE_URL ?>/../platform/css/styles.css">
  <!-- summernote -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
  <!-- data tables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
  <!-- bootstrap icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- scripts -->
  <script src="<?= $BASE_URL ?>/../platform/js/scripts.js" defer></script>
  <script src="<?= $BASE_URL ?>/../platform/js/show-add-recipe.js" defer></script>
  <script src="<?= $BASE_URL ?>/../platform/js/add-recipe.js" defer></script>
</head>

<body>
  <div class="home">
    <div id="more-options" class="hide">
      <div class="profile">
        <div class="profile-image"></div>
        <h4 class="profile-name">Admin Name</h4>
      </div>
      <div class="options">
        <ul>
          <li>
            <a href="#">Recipes</a>
          </li>
          <li>
            <a href="#">Categories</a>
          </li>
        </ul>
      </div>
    </div>
    <div id="content">
      <nav id="navbar">
        <button id="more" class="btn">
          <i class="bi bi-list"></i>
        </button>
        <div id="nav-actions">
          <button class="btn add"><i class="bi bi-plus-lg"></i> Add Recipe</button>
          <button class="btn"><i class="bi bi-box-arrow-right"></i></button>
        </div>
      </nav>
      <div id="recipes-list">
        <h2>Recipes Added:</h2>
        <div id="recipes">
          <table id="recipes-table" class="display compact" style="width:100%">
            <thead>
              <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Rating</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($recipes): ?>
                <?php foreach ($recipes as $recipe): ?>
                  <?php require __DIR__ . '/templates/tr-recipe.php' ?>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td class="td-actions">
                    <button class="edit-recipe"><i class="bi bi-pencil-square"></i></button>
                    <button class="delete-recipe"><i class="bi bi-trash"></i></button>
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div id="add-recipe" class="hide">
    <form action="index.php" method="post" enctype="multipart/form-data">
      <h3>Add a new recipe:</h3>
      <div class="form-left">
        <div class="recipe-image input-field">
          <div class="image"></div>
          <label for="recipe_image">Add an Image</label>
          <input type="file" name="recipe_image" id="recipe_image" class="hide">
        </div>
        <div class="title-and-portions-and-time">
          <div class="recipe-title input-field">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title">
          </div>
          <div class="recipe-portion input-field">
            <label for="portions">Portions:</label>
            <input type="number" name="portions" id="portions" min="1">
          </div>
          <div class="recipe-portion input-field">
            <label for="preparation_time">Preparation Time (in minutes):</label>
            <input type="number" name="preparation_time" id="preparation_time" min="1">
          </div>
        </div>
      </div>
      <div class="form-right">
        <div class="recipe-category input-field">
          <label for="category">Category</label>
          <select name="category" id="category">
            <option value="">Choice a category</option>
            <?php foreach ($categories as $category): ?>
              <option value="<?= $category->getCategoryName() ?>">
                <?= $category->getCategoryName() ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="recipe-ingredients input-field">
          <label for="ingredient">Ingredients:</label>
          <input type="text" name="ingredient" id="ingredient">
          <i class="bi bi-plus-square-fill" data-add-recipe></i>
          <ul id="ingredients-area"></ul>
          <div id="ingredients" class="hide"></div>
        </div>
        <div class="recipe-method-of-preparation input-field">
          <label for="method_of_preparation">Method of Preparation:</label>
          <textarea id="method_of_preparation" name="method_of_preparation"></textarea>
        </div>
        <div class="recipe-tips input-field">
          <label for="tips">Tips:</label>
          <textarea id="tips" name="tips"></textarea>
        </div>
      </div>
      <div class="form-actions">
        <button type="button" id="cancel-add-recipe">Cancel</button>
        <button type="submit">Add Recipe</button>
      </div>
    </form>
  </div>

  <!-- init -->
  <script>
    $('#method_of_preparation').summernote({
      placeholder: 'Add recipe preparation methods.',
      tabsize: 2,
      height: 154,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });

    $('#tips').summernote({
      placeholder: 'Give recipe preparation tips.',
      tabsize: 2,
      height: 154,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });

    $(document).ready(function () {
      $('#recipes-table').DataTable();
    });
  </script>
</body>

</html>