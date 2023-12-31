<?php

require_once __DIR__ . '/../utils/globals.php';
require_once __DIR__ . '/../utils/validations.php';
require_once __DIR__ . '/../connection/conn.php';
require_once __DIR__ . '/../models/Comment.php';
require_once __DIR__ . '/../dao/CommentDAO.php';
require_once __DIR__ . '/../dao/UserDAO.php';
require_once __DIR__ . '/../dao/RecipeDAO.php';

use dao\CommentDAO;
use models\Comment;
use dao\UserDAO;
use dao\RecipeDAO;

$userDAO = new UserDAO($conn);
$recipeDAO = new RecipeDAO($conn);

$commentDAO = new CommentDAO($conn);

if (!empty($_POST)) {
  if (isset($_POST['user_id']) && isset($_POST['recipe_id']) && isset($_POST['comment'])) {
    $user_id = filter_input(INPUT_POST, 'user_id');
    $recipe_id = filter_input(INPUT_POST, 'recipe_id');
    $comm = filter_input(INPUT_POST, 'comment');

    $user = $userDAO->findById($user_id);
    $recipe = $recipeDAO->findById($recipe_id);

    $alreadyCommented = $commentDAO->checkIfUserHasAlreadyCommented($user, $recipe);

    if ($user && $recipe && !$alreadyCommented) {
      if (!isInvalidComment($comm)) {
        $comment = new Comment();

        $comment->setUserId($user_id);
        $comment->setRecipeId($recipe_id);
        $comment->setComment($comm);

        $commentDAO->create($comment);

        header('location: ' . $_SERVER['HTTP_REFERER']);
      }
    }
  }
}