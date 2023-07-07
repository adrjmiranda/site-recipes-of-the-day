<?php

namespace models;

class Recipe
{
  private $id;
  private $title;
  private $ingredients;
  private $method_of_preparation;
  private $tips;
  private $portions;
  private $preparation_time;
  private $rating;
  private $recipe_image;
  private $category;

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function setIngredients($ingredients)
  {
    $this->ingredients = $ingredients;
  }

  public function getIngredients()
  {
    return $this->ingredients;
  }

  public function setMethodOfPreparation($method_of_preparation)
  {
    $this->method_of_preparation = $method_of_preparation;
  }

  public function getMethodOfPreparation()
  {
    return $this->method_of_preparation;
  }

  public function setTips($tips)
  {
    $this->tips = $tips;
  }

  public function getTips()
  {
    return $this->tips;
  }

  public function setPortions($portions)
  {
    $this->portions = $portions;
  }

  public function getPortions()
  {
    return $this->portions;
  }

  public function setPreparationTime($preparation_time)
  {
    $this->preparation_time = $preparation_time;
  }

  public function getPreparationTime()
  {
    return $this->preparation_time;
  }

  public function setRating($rating)
  {
    $this->rating = $rating;
  }

  public function getRating()
  {
    return $this->rating;
  }

  public function setRecipeImage($recipe_image)
  {
    $this->recipe_image = $recipe_image;
  }

  public function getRecipeImage()
  {
    return $this->recipe_image;
  }

  public function setCategory($category)
  {
    $this->category = $category;
  }

  public function getCategory()
  {
    return $this->category;
  }
}

interface RecipeDAOInterface
{
  public function buildRecipe($data);
  public function createRecipe(Recipe $recipe);
  public function findAll($orderBy, $limit = null);
  public function findById($id);
  public function findByTitle($title, $limit = null);
  public function findByCategory($category, $limit = null);
  public function update(Recipe $recipe);
  public function delete($id);
}