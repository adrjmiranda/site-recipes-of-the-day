<?php
require_once __DIR__ . '/../utils/globals.php';
require_once __DIR__ . '/../connection/conn.php';
require_once __DIR__ . '/../dao/AdminDAO.php';
require_once __DIR__ . '/../dao/RecipeDAO.php';

use dao\AdminDAO;
use dao\RecipeDAO;

$adminDAO = new AdminDAO($conn);
$recipeDAO = new RecipeDAO($conn);

$admin = null;

if (isset($_SESSION['token'])) {
  $token = $_SESSION['token'];

  $admin = $adminDAO->findByToken($token);
}

if (!$admin) {
  header('location: login.php');
}

$recipes = $recipeDAO->findAll('id');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>without bootstrap</title>
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
          <button class="btn logout"><i class="bi bi-box-arrow-right"></i></button>
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
  <!-- <div id="summernote"></div> -->
  <script>
    $('#summernote').summernote({
      placeholder: 'Hello stand alone ui',
      tabsize: 2,
      height: 120,
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