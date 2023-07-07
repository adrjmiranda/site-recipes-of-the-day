<?php

namespace dao;

require_once __DIR__ . '/../models/Rating.php';

use models\Rating;
use models\RatingDAOInterface;
use PDO;

class RatingDAO implements RatingDAOInterface
{
  private $conn;

  public function __construct(PDO $conn)
  {
    $this->conn = $conn;
  }

  public function buildRating($data)
  {
    $rating = new Rating();

    $rating->setId($data['id']);
    $rating->setRating($data['rating']);
    $rating->setUserId($data['user_id']);
    $rating->setRecipeId($data['recipe_id']);

    return $rating;
  }

  public function create(Rating $rating)
  {
    $rate = $rating->getRating();
    $user_id = $rating->getUserId();
    $recipe_id = $rating->getRecipeId();

    $stmt = $this->conn->prepare('INSERT INTO rates (rating, user_id, recipe_id) VALUES (:rating, :user_id, :recipe_id)');

    $stmt->bindParam(':rating', $rate);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':recipe_id', $recipe_id);

    try {
      $stmt->execute();

      return true;
    } catch (\PDOException $e) {
      return false;
    }
  }

  public function findByUserIdAndRecipeId($user_id, $recipe_id)
  {
    $rating = null;

    $stmt = $this->conn->prepare('SELECT * FROM rates WHERE user_id = :user_id AND recipe_id = :recipe_id LIMIT 1');

    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':recipe_id', $recipe_id);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetch();

      $rating = $this->buildRating($data);
    }

    return $rating;
  }

  public function averageOfRates($recipe_id)
  {
    $average = 0;

    $stmt = $this->conn->prepare('SELECT AVG(rating) FROM rates WHERE recipe_id = :recipe_id');

    $stmt->bindParam(':recipe_id', $recipe_id);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $average = $stmt->fetch();

      $average = ceil(floatval($average['AVG(rating)']));
    }

    return $average;
  }

  public function update(Rating $rating)
  {
    $id = $rating->getId();
    $rate = $rating->getRating();
    $user_id = $rating->getUserId();
    $recipe_id = $rating->getRecipeId();

    $stmt = $this->conn->prepare('UPDATE rates SET rating = :rating, user_id = :user_id, recipe_id = :recipe_id WHERE id = :id');

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':rating', $rate);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':recipe_id', $recipe_id);

    try {
      $stmt->execute();

      return true;
    } catch (\PDOException $th) {
      return false;
    }
  }
}