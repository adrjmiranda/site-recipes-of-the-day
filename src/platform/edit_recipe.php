<?php

require_once __DIR__ . '/../connection/conn.php';
require_once __DIR__ . '/../utils/globals.php';
require_once __DIR__ . '/../utils/Error.php';
require_once __DIR__ . '/../dao/AdminDAO.php';
require_once __DIR__ . '/../dao/RecipeDAO.php';
require_once __DIR__ . '/../dao/CategoryDAO.php';
require_once __DIR__ . '/utils/validations.php';

use utils\Error;
use dao\AdminDAO;
use dao\RecipeDAO;
use dao\CategoryDAO;

$adminDAO = new AdminDAO($conn);

$admin = null;

if (isset($_SESSION['token'])) {
  $token = $_SESSION['token'];

  $admin = $adminDAO->findByToken($token);
}

if (!$admin) {
  header('location: login.php');
}

$id = filter_input(INPUT_GET, 'id');

$recipeDAO = new RecipeDAO($conn);
$categoryDAO = new CategoryDAO($conn);

$recipe = $recipeDAO->findById($id);

if (!$recipe) {
  header('location: index.php');
}

$categories = $categoryDAO->findAll();

if (isset($_POST)) {
  if (
    isset($_POST['title'])
    && isset($_POST['method_of_preparation'])
    && isset($_POST['tips'])
    && isset($_POST['portions'])
    && isset($_POST['preparation_time'])
    && isset($_POST['category'])
  ) {
    $title = filter_input(INPUT_POST, 'title');
    $method_of_preparation = filter_input(INPUT_POST, 'method_of_preparation');
    $tips = filter_input(INPUT_POST, 'tips');
    $portions = filter_input(INPUT_POST, 'portions');
    $preparation_time = filter_input(INPUT_POST, 'preparation_time');
    $category = filter_input(INPUT_POST, 'category');

    if (isset($_POST['ingredients'])) {
      $ingredients = $_POST['ingredients'];
    } else {
      $ingredients = json_decode($recipe->getIngredients());
    }

    if (
      isEmpty($title) ||
      isEmpty($ingredients) ||
      isEmpty($method_of_preparation) ||
      isEmpty($tips) ||
      isEmpty($portions) ||
      isEmpty($preparation_time) ||
      isEmpty($category)
    ) {
      Error::setError('ERR_UPDATING_RECIPE', true);

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
          Error::setError('ERR_INVALID_PORTIONS', true);
        } else {
          Error::setError('ERR_INVALID_PORTIONS', false);
        }

        if (isInvalidPreparationTime($preparation_time)) {
          Error::setError('ERR_INVALID_PREPARATION_TIME', true);
        } else {
          Error::setError('ERR_INVALID_PREPARATION_TIME', false);
        }

        if (isInvalidCategory($category)) {
          Error::setError('ERR_INVALID_CATEGORY', true);
        } else {
          Error::setError('ERR_INVALID_CATEGORY', false);
        }
      } else {
        Error::clearErrors();

        $title = removeUnnecessarySpaces($title);
        $ing = json_encode($ingredients);

        $recipe_image = $recipe->getRecipeImage();

        if (isset($_FILES['recipe_image']) && isset($_FILES['recipe_image']['tmp_name'])) {
          $size = intval($_FILES['recipe_image']['size']);

          if ($size > 2000000) {
            Error::setError('ERR_TOO_LARGE_IMAGE', true);
          } else {
            Error::setError('ERR_TOO_LARGE_IMAGE', false);

            $enableTypes = ['image/jpg', 'image/jpeg', 'image/png'];
            $jpgTypes = ['image/jpg', 'image/jpeg'];

            if (in_array($_FILES['recipe_image']['type'], $enableTypes)) {
              Error::setError('ERR_INVALID_IMAGE', false);

              if (in_array($_FILES['recipe_image']['type'], $jpgTypes)) {
                $imageFile = imagecreatefromjpeg($_FILES['recipe_image']['tmp_name']);
              } else {
                $imageFile = imagecreatefrompng($_FILES['recipe_image']['tmp_name']);
              }

              $imageName = $recipe->generateImageName();

              if ($recipe->getRecipeImage() != '') {
                $imagePath = dirname(__FILE__, 2) . '/images/recipes/' . $recipe->getRecipeImage();
                unlink($imagePath);
              }

              if (imagejpeg($imageFile, '../images/recipes/' . $imageName, 100)) {
                $recipe_image = $imageName;
              }
            }
          }
        } else {
          Error::setError('ERR_INVALID_IMAGE', true);
        }


        $recipe->setTitle($title);
        $recipe->setIngredients($ing);
        $recipe->setMethodOfPreparation($method_of_preparation);
        $recipe->setTips($tips);
        $recipe->setPortions($portions);
        $recipe->setPreparationTime($preparation_time);
        $recipe->setRecipeImage($recipe_image);
        $recipe->setCategory($category);

        if ($recipeDAO->update($recipe)) {
          Error::clearErrors();
          unset($_POST);
          header('location: index.php');
        } else {
          Error::setError('ERR_UPDATING_RECIPE', true);
          unset($_POST);
        }

      }
    }
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
  <script src="<?= $BASE_URL ?>/../platform/js/add-ingredient.js" defer></script>
  <script src="<?= $BASE_URL ?>/../platform/js/image-preview.js" defer></script>
</head>

<body>
  <div id="edit-recipe-container">
    <div id="add-recipe">
      <form action="edit_recipe.php?id=<?= $recipe->getId() ?>" method="post" enctype="multipart/form-data">
        <h3>Update recipe:</h3>
        <div class="form-left">
          <div class="recipe-image input-field">
            <div class="image">
              <img
                src="<?= $recipe->getRecipeImage() != '' ? $BASE_URL . '/../images/recipes/' . $recipe->getRecipeImage() : '' ?>"
                id="recipe_image_preview">
            </div>
            <label for="recipe_image">Add an Image</label>
            <input type="file" name="recipe_image" id="recipe_image" class="hide">
          </div>
          <div class="title-and-portions-and-time">
            <div class="recipe-title input-field">
              <label for="title">Title:</label>
              <input type="text" name="title" id="title"
                value="<?= isset($_POST['title']) ? $title : $recipe->getTitle() ?>">
              <?php if (Error::$ERROR_TYPES['ERR_INVALID_TITLE']): ?>
                <div class="error">
                  <p>
                    <?= Error::$ERROR_MSG['ERR_INVALID_TITLE'] ?>
                  </p>
                </div>
              <?php endif; ?>
              <?php if (Error::$ERROR_TYPES['ERR_EMPTY_TITLE']): ?>
                <div class="error">
                  <p>
                    <?= Error::$ERROR_MSG['ERR_EMPTY_TITLE'] ?>
                  </p>
                </div>
              <?php endif; ?>
            </div>
            <div class="recipe-portion input-field">
              <label for="portions">Portions:</label>
              <input type="number" name="portions" id="portions" min="1"
                value="<?= isset($_POST['portions']) ? $portions : $recipe->getPortions() ?>">
              <?php if (Error::$ERROR_TYPES['ERR_INVALID_PORTIONS']): ?>
                <div class="error">
                  <p>
                    <?= Error::$ERROR_MSG['ERR_INVALID_PORTIONS'] ?>
                  </p>
                </div>
              <?php endif; ?>
              <?php if (Error::$ERROR_TYPES['ERR_EMPTY_PORTIONS']): ?>
                <div class="error">
                  <p>
                    <?= Error::$ERROR_MSG['ERR_EMPTY_PORTIONS'] ?>
                  </p>
                </div>
              <?php endif; ?>
            </div>
            <div class="recipe-portion input-field">
              <label for="preparation_time">Preparation Time (in minutes):</label>
              <input type="number" name="preparation_time" id="preparation_time" min="1"
                value="<?= isset($_POST['preparation_time']) ? $preparation_time : $recipe->getPreparationTime() ?>">
              <?php if (Error::$ERROR_TYPES['ERR_INVALID_PREPARATION_TIME']): ?>
                <div class="error">
                  <p>
                    <?= Error::$ERROR_MSG['ERR_INVALID_PREPARATION_TIME'] ?>
                  </p>
                </div>
              <?php endif; ?>
              <?php if (Error::$ERROR_TYPES['ERR_EMPTY_PREPARATION_TIME']): ?>
                <div class="error">
                  <p>
                    <?= Error::$ERROR_MSG['ERR_EMPTY_PREPARATION_TIME'] ?>
                  </p>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="form-right">
          <div class="recipe-category input-field">
            <label for="category">Category</label>
            <select name="category" id="category">
              <option value="">Choice a category</option>
              <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat->getCategoryName() ?>" <?= isset($_POST['category']) ? ($category == $cat->getCategoryName() ? 'selected' : '') : ($recipe->getCategory() == $cat->getCategoryName() ? 'selected' : '') ?>>
                  <?= $cat->getCategoryName() ?>
                </option>
              <?php endforeach; ?>
            </select>
            <?php if (Error::$ERROR_TYPES['ERR_INVALID_CATEGORY']): ?>
              <div class="error">
                <p>
                  <?= Error::$ERROR_MSG['ERR_INVALID_CATEGORY'] ?>
                </p>
              </div>
            <?php endif; ?>
            <?php if (Error::$ERROR_TYPES['ERR_EMPTY_CATEGORY']): ?>
              <div class="error">
                <p>
                  <?= Error::$ERROR_MSG['ERR_EMPTY_CATEGORY'] ?>
                </p>
              </div>
            <?php endif; ?>
          </div>
          <div class="recipe-ingredients input-field">
            <label for="ingredient">Ingredients:</label>
            <input type="text" name="ingredient" id="ingredient">
            <?php if (Error::$ERROR_TYPES['ERR_EMPTY_INGREDIENTS']): ?>
              <div class="error">
                <p>
                  <?= Error::$ERROR_MSG['ERR_EMPTY_INGREDIENTS'] ?>
                </p>
              </div>
            <?php endif; ?>
            <i class="bi bi-plus-square-fill" data-add-recipe></i>
            <ul id="ingredients-area">
              <?php if (isset($_POST['ingredients'])): ?>
                <?php foreach ($ingredients as $key => $ingredient): ?>
                  <li>
                    <?= $ingredient ?> <i class="bi bi-dash-square-fill" data-order="<?= $key ?>"></i>
                  </li>
                <?php endforeach; ?>
              <?php else: ?>
                <?php foreach (json_decode($recipe->getIngredients()) as $key => $ingredient): ?>
                  <li>
                    <?= $ingredient ?> <i class="bi bi-dash-square-fill" data-order="<?= $key ?>"></i>
                  </li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
            <div id="ingredients" class="hide">
              <?php if (isset($_POST['ingredients'])): ?>
                <?php foreach ($ingredients as $key => $ingredient): ?>
                  <input type="checkbox" name="ingredients[]" value="<?= $ingredient ?>" checked="checked"
                    data-order="<?= $key ?>">
                <?php endforeach; ?>
              <?php else: ?>
                <?php foreach (json_decode($recipe->getIngredients()) as $key => $ingredient): ?>
                  <input type="checkbox" name="ingredients[]" value="<?= $ingredient ?>" checked="checked"
                    data-order="<?= $key ?>">
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
          <div class="recipe-method-of-preparation input-field">
            <label for="method_of_preparation">Method of Preparation:</label>
            <textarea id="method_of_preparation"
              name="method_of_preparation"><?= isset($_POST['method_of_preparation']) ? $method_of_preparation : $recipe->getMethodOfPreparation() ?></textarea>
            <?php if (Error::$ERROR_TYPES['ERR_EMPTY_METHOD_PREPARATION']): ?>
              <div class="error">
                <p>
                  <?= Error::$ERROR_MSG['ERR_EMPTY_METHOD_PREPARATION'] ?>
                </p>
              </div>
            <?php endif; ?>
          </div>
          <div class="recipe-tips input-field">
            <label for="tips">Tips:</label>
            <textarea id="tips" name="tips"><?= isset($_POST['tips']) ? $tips : $recipe->getTips() ?></textarea>
            <?php if (Error::$ERROR_TYPES['ERR_EMPTY_TIPS']): ?>
              <div class="error">
                <p>
                  <?= Error::$ERROR_MSG['ERR_EMPTY_TIPS'] ?>
                </p>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="form-actions">
          <a href="index.php" type="button" id="cancel-add-recipe">Cancel</a>
          <button type="submit">Update Recipe</button>
        </div>
      </form>
    </div>
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
  </script>
</body>

</html>