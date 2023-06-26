USE `recipesoftheday`;

CREATE TABLE IF NOT EXISTS `recipesoftheday`.`categories` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `category` VARCHAR(255) NOT NULL
);

INSERT INTO `categories` (`category`) VALUES ('rice and risotto');
INSERT INTO `categories` (`category`) VALUES ('birds');
INSERT INTO `categories` (`category`) VALUES ('meat');
INSERT INTO `categories` (`category`) VALUES ('pastas');
INSERT INTO `categories` (`category`) VALUES ('cakes');
INSERT INTO `categories` (`category`) VALUES ('sweets and desserts');
INSERT INTO `categories` (`category`) VALUES ('salads');
INSERT INTO `categories` (`category`) VALUES ('snacks and snacks');
INSERT INTO `categories` (`category`) VALUES ('starters and snacks');
INSERT INTO `categories` (`category`) VALUES ('breads');
INSERT INTO `categories` (`category`) VALUES ('fishes and sea food');
INSERT INTO `categories` (`category`) VALUES ('drinks');
INSERT INTO `categories` (`category`) VALUES ('sauces and pâtés');
INSERT INTO `categories` (`category`) VALUES ('soups and broths');
INSERT INTO `categories` (`category`) VALUES ('special');