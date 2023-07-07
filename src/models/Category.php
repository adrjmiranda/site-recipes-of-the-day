<?php

namespace models;

class Category
{
  private $id;
  private $category_image;
  private $category_name;

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setCategoryImage($category_image)
  {
    $this->category_image = $category_image;
  }

  public function getCategoryImage()
  {
    return $this->category_image;
  }

  public function setCategoryName($category_name)
  {
    $this->category_name = $category_name;
  }

  public function getCategoryName()
  {
    return $this->category_name;
  }
}

interface CategoryDAOInterface
{
  public function buildCategory($data);
  public function create(Category $category);
  public function findAll();
  public function findById($id);
  public function findByCategoryName($category_name);
  public function update(Category $category);
  public function delete($id);
}