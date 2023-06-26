USE `recipesoftheday`;

CREATE TABLE IF NOT EXISTS `recipesoftheday`.`comments` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `comment` VARCHAR(255) NOT NULL,
  `user_id` INT(11) UNSIGNED NOT NULL,
  `recipe_id` INT(11) UNSIGNED NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `recipesoftheday`.`users` (`id`),
  FOREIGN KEY (`recipe_id`) REFERENCES `recipesoftheday`.`recipes` (`id`)
);