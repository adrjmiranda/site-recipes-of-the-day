<?php

namespace dao;

require_once __DIR__ . '/../models/Recipe.php';

use models\Recipe;
use models\RecipeDAOInterface;
use PDO;

class RecipeDAO implements RecipeDAOInterface
{
  private $conn;

  public function __construct(PDO $conn)
  {
    $this->conn = $conn;
  }

  public function buildRecipe($data)
  {
    $recipe = new Recipe();

    $recipe->setId($data['id']);
    $recipe->setTitle($data['title']);
    $recipe->setIngredients($data['ingredients']);
    $recipe->setMethodOfPreparation($data['method_of_preparation']);
    $recipe->setTips($data['tips']);
    $recipe->setPortions($data['portions']);
    $recipe->setPreparationTime($data['preparation_time']);
    $recipe->setRating($data['rating']);
    $recipe->setRecipeImage($data['recipe_image']);
    $recipe->setCategory($data['category']);

    return $recipe;
  }

  public function createRecipe(Recipe $recipe)
  {
    $stmt = $this->conn->prepare('INSERT INTO recipes (
      title,
      ingredients,
      method_of_preparation,
      tips,
      portions,
      preparation_time,
      rating,
      recipe_image,
      category
    ) VALUES (
      :title,
      :ingredients,
      :method_of_preparation,
      :tips,
      :portions,
      :preparation_time,
      :rating,
      :recipe_image,
      :category
    )');

    $title = $recipe->getTitle();
    $ingredients = $recipe->getIngredients();
    $method_of_preparation = $recipe->getMethodOfPreparation();
    $tips = $recipe->getTips();
    $portions = $recipe->getPortions();
    $preparation_time = $recipe->getPreparationTime();
    $rating = $recipe->getRating();
    $recipe_image = $recipe->getRecipeImage();
    $category = $recipe->getCategory();

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':ingredients', $ingredients);
    $stmt->bindParam(':method_of_preparation', $method_of_preparation);
    $stmt->bindParam(':tips', $tips);
    $stmt->bindParam(':portions', $portions);
    $stmt->bindParam(':preparation_time', $preparation_time);
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':recipe_image', $recipe_image);
    $stmt->bindParam(':category', $category);

    try {
      $stmt->execute();
      return true;
    } catch (\PDOException $e) {
      return false;
    }
  }

  public function findAll($orderBy, $limit = null)
  {
    $recipes = [];

    $query = 'SELECT * FROM recipes ORDER BY replace_name DESC LIMIT';

    switch ($orderBy) {
      case 'title':
        $query = str_replace('replace_name', $orderBy, $query);
        break;
      case 'rating':
        $query = str_replace('replace_name', $orderBy, $query);
        break;
      case 'category':
        $query = str_replace('replace_name', $orderBy, $query);
        break;
      default:
        $query = str_replace('replace_name', $orderBy, $query);
        break;
    }

    if ($limit) {
      $query = $query . ' ' . ':limit';
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    } else {
      $stmt = $this->conn->prepare($query);
    }

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetchAll();

      foreach ($data as $recipe) {
        $recipe = $this->buildRecipe($recipe);

        array_push($recipes, $recipe);
      }
    }

    return $recipes;
  }

  public function findById($id)
  {
    $recipe = [];

    $stmt = $this->conn->prepare('SELECT * FROM recipes WHERE id = :id LIMIT 1');

    $stmt->bindParam(':id', $id);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetch();

      $recipe = $this->buildRecipe($data);
    }

    return $recipe;
  }

  public function findByTitle($title, $limit = null)
  {
    $recipes = [];


    if ($limit) {
      $stmt = $this->conn->prepare('SELECT * FROM recipes WHERE title = :title LIMIT :limit');
      $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    } else {
      $stmt = $this->conn->prepare('SELECT * FROM recipes WHERE title = :title');
    }

    $stmt->bindParam(':title', $title);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetchAll();

      foreach ($data as $recipe) {
        $recipe = $this->buildRecipe($recipe);

        array_push($recipes, $recipe);
      }
    }

    return $recipes;
  }

  public function findByCategory($category, $limit = null)
  {
    $recipes = [];

    if ($limit) {
      $stmt = $this->conn->prepare('SELECT * FROM recipes WHERE category = :category ORDER BY id DESC LIMIT :limit');
      $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    } else {
      $stmt = $this->conn->prepare('SELECT * FROM recipes WHERE category = :category ORDER BY id DESC');
    }

    $stmt->bindParam(':category', $category);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetchAll();

      foreach ($data as $recipe) {
        $recipe = $this->buildRecipe($recipe);

        array_push($recipes, $recipe);
      }
    }

    return $recipes;
  }

  public function update(Recipe $recipe)
  {
    $stmt = $this->conn->prepare('UPDATE recipes SET 
      title = :title,
      ingredients = :ingredients,
      method_of_preparation = :method_of_preparation,
      tips = :tips,
      portions = :portions,
      preparation_time = :preparation_time,
      rating = :rating,
      recipe_image = :recipe_image,
      category = :category
    WHERE id = :id');

    $id = $recipe->getId();
    $title = $recipe->getTitle();
    $ingredients = $recipe->getIngredients();
    $method_of_preparation = $recipe->getMethodOfPreparation();
    $tips = $recipe->getTips();
    $portions = $recipe->getPortions();
    $preparation_time = $recipe->getPreparationTime();
    $rating = $recipe->getRating();
    $recipe_image = $recipe->getRecipeImage();
    $category = $recipe->getCategory();

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':ingredients', $ingredients);
    $stmt->bindParam(':method_of_preparation', $method_of_preparation);
    $stmt->bindParam(':tips', $tips);
    $stmt->bindParam(':portions', $portions);
    $stmt->bindParam(':preparation_time', $preparation_time);
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':recipe_image', $recipe_image);
    $stmt->bindParam(':category', $category);

    $stmt->execute();
  }

  public function delete($id)
  {
    $stmt = $this->conn->prepare('DELETE FROM recipes WHERE id = :id');

    $stmt->bindParam(':id', $id);

    $stmt->execute();
  }

}