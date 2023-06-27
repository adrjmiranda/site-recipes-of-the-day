USE `recipesoftheday`;

CREATE TABLE IF NOT EXISTS `recipesoftheday`.`categories` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `category_image` VARCHAR(255) NOT NULL,
  `category` VARCHAR(255) NOT NULL
);

INSERT INTO `categories` (`category_image`, `category`) VALUES ('rice_and_risotto.jpg', 'rice and risotto');
INSERT INTO `categories` (`category_image`, `category`) VALUES ('birds.jpg', 'birds');
INSERT INTO `categories` (`category_image`, `category`) VALUES ('meat.jpg', 'meat');
INSERT INTO `categories` (`category_image`, `category`) VALUES ('pastas.jpg', 'pastas');
INSERT INTO `categories` (`category_image`, `category`) VALUES ('cakes.jpg', 'cakes');
INSERT INTO `categories` (`category_image`, `category`) VALUES ('sweets_and_desserts.jpg', 'sweets and desserts');
INSERT INTO `categories` (`category_image`, `category`) VALUES ('salads.jpg', 'salads');
INSERT INTO `categories` (`category_image`, `category`) VALUES ('snacks_and_snacks.jpg', 'snacks and snacks');
INSERT INTO `categories` (`category_image`, `category`) VALUES ('starters_and_snacks.jpg', 'starters and snacks');
INSERT INTO `categories` (`category_image`, `category`) VALUES ('breads.jpg', 'breads');
INSERT INTO `categories` (`category_image`, `category`) VALUES ('fishes_and_sea_food.jpg', 'fishes and sea food');
INSERT INTO `categories` (`category_image`, `category`) VALUES ('drinks.jpg', 'drinks');
INSERT INTO `categories` (`category_image`, `category`) VALUES ('sauces_and_pâtés.jpg', 'sauces and pâtés');
INSERT INTO `categories` (`category_image`, `category`) VALUES ('soups_and_broths.jpg', 'soups and broths');
INSERT INTO `categories` (`category_image`, `category`) VALUES ('special.jpg', 'special');