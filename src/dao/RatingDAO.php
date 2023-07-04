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

    $stmt->execute();
  }

  public function findByUserId($user_id)
  {
  }

  public function averageOfRates($recipe_id)
  {
  }

  public function update(Rating $rating)
  {
  }
}