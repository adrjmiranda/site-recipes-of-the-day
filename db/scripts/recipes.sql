CREATE DATABASE IF NOT EXISTS `recipesoftheday`;
USE `recipesoftheday`;

CREATE TABLE IF NOT EXISTS `recipesoftheday`.`recipes` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `ingredients` TEXT NOT NULL,
  `method_of_preparation` TEXT NOT NULL,
  `tips` VARCHAR(255) NOT NULL,
  `portions` VARCHAR(255) NOT NULL,
  `preparation_time` INT(11) UNSIGNED NOT NULL,
  `rating` VARCHAR(255) NOT NULL,
  `recipe_image` VARCHAR(255) NOT NULL,
  `category` VARCHAR(255) NOT NULL
);