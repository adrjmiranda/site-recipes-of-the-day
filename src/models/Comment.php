<?php

namespace models;

require_once __DIR__ . '/User.php';

use models\User;

class Comment
{
  private $id;
  private $comment;
  private $user_id;
  private $recipe_id;

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setComment($comment)
  {
    $this->comment = $comment;
  }

  public function getComment()
  {
    return $this->comment;
  }

  public function setUserId($user_id)
  {
    $this->user_id = $user_id;
  }

  public function getUserId()
  {
    return $this->user_id;
  }

  public function setRecipeId($recipe_id)
  {
    $this->recipe_id = $recipe_id;
  }

  public function getRecipeId()
  {
    return $this->recipe_id;
  }
}

interface CommentDAOInterface
{
  public function buildComment($data);
  public function create(Comment $comment);
  public function findAll();
  public function findById($id);
  public function findByUserId($user_id);
  public function findByRecipeId($recipe_id);
  public function update(Comment $comment);
  public function delete($id);
  public function checkIfUserHasAlreadyCommented(User $user);
}