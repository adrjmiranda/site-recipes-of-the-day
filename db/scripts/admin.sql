CREATE DATABASE IF NOT EXISTS `recipesoftheday` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `recipesoftheday`;

CREATE TABLE IF NOT EXISTS `recipesoftheday`.`admin` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO `admin` (`name`, `email`, `password`) VALUES ('admin', 'admin@admin.com', '$2y$10$h126IwyA0.aifLu8FBpre.hVf93aLDktsEenHBPGqW7zwYIR9Zk2C');