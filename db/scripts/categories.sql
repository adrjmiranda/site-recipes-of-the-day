USE `recipesoftheday`;

CREATE TABLE IF NOT EXISTS `recipesoftheday`.`categories` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `category_image` VARCHAR(255) UNIQUE NOT NULL,
  `category_name` VARCHAR(255) UNIQUE NOT NULL
) CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO `categories` (`category_image`, `category_name`) VALUES ('rice_and_risotto.jpg', 'rice and risotto');
INSERT INTO `categories` (`category_image`, `category_name`) VALUES ('birds.jpg', 'birds');
INSERT INTO `categories` (`category_image`, `category_name`) VALUES ('meat.jpg', 'meat');
INSERT INTO `categories` (`category_image`, `category_name`) VALUES ('pastas.jpg', 'pastas');
INSERT INTO `categories` (`category_image`, `category_name`) VALUES ('cakes.jpg', 'cakes');
INSERT INTO `categories` (`category_image`, `category_name`) VALUES ('sweets_and_desserts.jpg', 'sweets and desserts');
INSERT INTO `categories` (`category_image`, `category_name`) VALUES ('salads.jpg', 'salads');
INSERT INTO `categories` (`category_image`, `category_name`) VALUES ('snacks_and_snacks.jpg', 'snacks and snacks');
INSERT INTO `categories` (`category_image`, `category_name`) VALUES ('starters_and_snacks.jpg', 'starters and snacks');
INSERT INTO `categories` (`category_image`, `category_name`) VALUES ('breads.jpg', 'breads');
INSERT INTO `categories` (`category_image`, `category_name`) VALUES ('fishes_and_sea_food.jpg', 'fishes and sea food');
INSERT INTO `categories` (`category_image`, `category_name`) VALUES ('drinks.jpg', 'drinks');
INSERT INTO `categories` (`category_image`, `category_name`) VALUES ('soups_and_broths.jpg', 'soups and broths');
INSERT INTO `categories` (`category_image`, `category_name`) VALUES ('special.jpg', 'special');