<?php

namespace dao;

require_once __DIR__ . '/../models/Category.php';

use PDO;
use models\Category;
use models\CategoryDAOInterface;

class CategoryDAO implements CategoryDAOInterface
{
  private $conn;

  public function __construct(PDO $conn)
  {
    $this->conn = $conn;
  }

  public function buildCategory($data)
  {
    $category = new Category();

    $category->setId($data['id']);
    $category->setCategoryImage($data['category_image']);
    $category->setCategoryName($data['category_name']);

    return $category;
  }

  public function create(Category $category)
  {
    $category_image = $category->getCategoryImage();
    $category_name = $category->getCategoryName();

    $stmt = $this->conn->prepare('INSERT INTO categories (
      category_image,
      category_name
    ) VALUES (
      :category_image,
      :category_name
    )');

    $stmt->bindParam(':category_image', $category_image);
    $stmt->bindParam(':category_name', $category_name);

    $stmt->execute();
  }

  public function findAll()
  {
    $categories = [];

    $stmt = $this->conn->prepare('SELECT * FROM categories');

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetchAll();

      foreach ($data as $category) {
        $category = $this->buildCategory($category);

        array_push($categories, $category);
      }
    }

    return $categories;
  }

  public function findById($id)
  {
    $category = null;

    $stmt = $this->conn->prepare('SELECT * FROM categories WHERE id = :id LIMIT 1');

    $stmt->bindParam(':id', $id);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetch();

      $category = $this->buildCategory($data);
    }

    return $category;
  }

  public function findByCategoryName($category_name)
  {
    $category = null;

    $stmt = $this->conn->prepare('SELECT * FROM categories WHERE category_name = :category_name LIMIT 1');

    $stmt->bindParam(':category_name', $category_name);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $data = $stmt->fetch();

      $category = $this->buildCategory($data);
    }

    return $category;
  }

  public function update(Category $category)
  {
    $id = $category->getId();
    $category_image = $category->getCategoryImage();
    $category_name = $category->getCategoryName();

    $stmt = $this->conn->prepare('UPDATE categories SET
      category_image = :category_image,
      category_name = :category_name 
    WHERE id = :id');

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':category_image', $category_image);
    $stmt->bindParam(':category_name', $category_name);

    $stmt->execute();
  }

  public function delete($id)
  {
    $stmt = $this->conn->prepare('DELETE FROM categories WHERE id = :id');

    $stmt->bindParam(':id', $id);

    $stmt->execute();
  }
}