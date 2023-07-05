<?php

require_once __DIR__ . '/../connection/conn.php';
require_once __DIR__ . '/../utils/globals.php';

require_once __DIR__ . '/../dao/UserDAO.php';
require_once __DIR__ . '/../dao/RecipeDAO.php';
require_once __DIR__ . '/../dao/RatingDAO.php';
require_once __DIR__ . '/../models/Rating.php';

use dao\UserDAO;
use dao\RatingDAO;
use dao\RecipeDAO;
use models\Rating;

$userDAO = new UserDAO($conn);
$ratingDAO = new RatingDAO($conn);
$recipeDAO = new RecipeDAO($conn);

$user = null;
$recipe = null;

if (isset($_SESSION['token'])) {
  $token = $_SESSION['token'];

  $user = $userDAO->findByToken($token);
}

$rating = new Rating();

if (!empty($_GET)) {
  if (isset($_GET['rating']) && isset($_GET['recipe_id'])) {
    $rate = filter_input(INPUT_GET, 'rating');
    $recipe_id = filter_input(INPUT_GET, 'recipe_id');

    $recipe = $recipeDAO->findById($recipe_id);

    if ($recipe && $user) {
      if ($rate && $recipe_id) {

        $user_id = $user->getId();
        $rate = intval($rate);

        if ($rate > 0 && $rate < 6) {
          $rating->setRating($rate);
          $rating->setUserId($user_id);
          $rating->setRecipeId($recipe_id);

          $alreadyRate = $ratingDAO->findByUserIdAndRecipeId($user_id, $recipe_id);

          if ($alreadyRate) {
            $alreadyRate->setRating($rate);
            $ratingDAO->update($alreadyRate);
          } else {
            $ratingDAO->create($rating);
          }
        }
      }
    }
  }
}

header('location: ' . $BASE_URL . '/../' . 'recipe.php?id=' . $recipe_id);