<?php

require_once __DIR__ . '/../connection/conn.php';
require_once __DIR__ . '/../dao/RecipeDAO.php';
require_once __DIR__ . '/../dao/AdminDAO.php';

use dao\RecipeDAO;
use dao\AdminDAO;

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

$recipe = $recipeDAO->findById($id);

if ($recipe) {
  $imagePath = dirname(__FILE__, 2) . '/images/recipes/' . $recipe->getRecipeImage();

  if ($recipeDAO->delete($id)) {
    if ($recipe->getRecipeImage() != '') {
      unlink($imagePath);
    }
  }
}

header('location: index.php');