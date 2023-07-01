USE `recipesoftheday`;

CREATE TABLE IF NOT EXISTS `recipesoftheday`.`users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `profile_image` VARCHAR(255),
  `token` VARCHAR(255)
) CHARACTER SET utf8 COLLATE utf8_general_ci;