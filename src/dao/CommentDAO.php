<?php

namespace dao;

require_once __DIR__ . '/../models/Comment.php';

use models\CommentDAOInterface;
use models\Comment;
use PDO;

class CommentDAO implements CommentDAOInterface
{
  private $conn;

  public function __construct(PDO $conn)
  {
    $this->conn = $conn;
  }

  public function buildComment($data)
  {
    $comment = new Comment();

    $comment->setId($data['id']);
    $comment->setComment($data['comment']);
    $comment->setUserId($data['user_id']);
    $comment->setRecipeId($data['recipe_id']);

    return $comment;
  }

  public function create(Comment $comment)
  {
    $comm = $comment->getComment();
    $user_id = $comment->getUserId();
    $recipe_id = $comment->getRecipeId();

    $stmt = $this->conn->prepare('INSERT INTO comments (comment, user_id, recipe_id) VALUES (:comment, :user_id, :recipe_id)');

    $stmt->bindParam(':comment', $comm);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':recipe_id', $recipe_id);

    $stmt->execute();
  }

  public function findAll()
  {
    $comments = [];

    $stmt = $this->conn->prepare('SELECT * FROM comments ORDER BY id DESC');

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetchAll();

      foreach ($data as $comment) {
        $comment = $this->buildComment($comment);

        array_push($comments, $comment);
      }
    }

    return $comments;
  }

  public function findById($id)
  {
    $comment = null;

    $stmt = $this->conn->prepare('SELECT * FROM comments WHERE id = :id LIMIT 1');

    $stmt->bindParam(':id', $id);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $comment = $this->buildComment($comment);
    }

    return $comment;
  }

  public function findByUserId($user_id)
  {
    $comment = null;

    $stmt = $this->conn->prepare('SELECT * FROM comments WHERE user_id = :user_id LIMIT 1');

    $stmt->bindParam(':user_id', $user_id);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $comment = $this->buildComment($comment);
    }

    return $comment;
  }

  public function findByRecipeId($recipe_id)
  {
    $comment = null;

    $stmt = $this->conn->prepare('SELECT * FROM comments WHERE recipe_id = :recipe_id LIMIT 1');

    $stmt->bindParam(':recipe_id', $recipe_id);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $comment = $this->buildComment($comment);
    }

    return $comment;
  }

  public function update(Comment $comment)
  {
    $id = $comment->getId();
    $comm = $comment->getComment();
    $user_id = $comment->getUserId();
    $recipe_id = $comment->getRecipeId();

    $stmt = $this->conn->prepare('UPDATE comments SET
      comment = :comment,
      user_id = :user_id,
      recipe_id = :recipe_id
    WHERE id = :id');

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':comment', $comm);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':recipe_id', $recipe_id);

    $stmt->execute();
  }

  public function delete($id)
  {
    $stmt = $this->conn->prepare('DELETE FROM comments WHERE id = :id');

    $stmt->bindParam(':id', $id);

    $stmt->execute();
  }
}