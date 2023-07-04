<?php

require_once __DIR__ . '/../connection/conn.php';
require_once __DIR__ . '/../utils/globals.php';

// require_once __DIR__ . '/../dao/UserDAO.php';
require_once __DIR__ . '/../dao/RatingDAO.php';
// require_once __DIR__ . '/../dao/RecipeDAO.php';
require_once __DIR__ . '/../models/Rating.php';
// require_once __DIR__ . '/../models/User.php';
// require_once __DIR__ . '/../models/Recipe.php';

// use dao\UserDAO;
use dao\RatingDAO;
// use dao\RecipeDAO;
use models\Rating;

// use models\User;
// use models\Recipe;

// $userDAO = new UserDAO($conn);
$ratingDAO = new RatingDAO($conn);
// $recipeDAO = new RecipeDAO($conn);

$rating = new Rating();

if (!empty($_GET)) {
  if (isset($_GET['rating']) && isset($_GET['user_id']) && isset($_GET['recipe_id'])) {
    $rate = filter_input(INPUT_GET, 'rating');
    $user_id = filter_input(INPUT_GET, 'user_id');
    $recipe_id = filter_input(INPUT_GET, 'recipe_id');

    if ($rate && $user_id && $recipe_id) {


      $rate = intval($rate);

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

      header('location: ' . $BASE_URL . '/../' . 'recipe.php?id=' . $recipe_id);
    }
  }
}