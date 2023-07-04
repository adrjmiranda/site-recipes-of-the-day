<?php

namespace models;

class Rating
{
  private $id;
  private $rating;
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

  public function setRating($rating)
  {
    $this->rating = $rating;
  }

  public function getRating()
  {
    return $this->rating;
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

interface RatingDAOInterface
{
  public function buildRating($data);
  public function create(Rating $rating);
  public function findByUserId($user_id);
  public function averageOfRates($recipe_id);
  public function update(Rating $rating);
}