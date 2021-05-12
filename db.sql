CREATE TABLE `planete` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL
);

CREATE TABLE `localisation` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `restaurant_id` int NOT NULL,
  `planete_id` int NOT NULL
);

CREATE TABLE `restaurant` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `localisation` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
);

CREATE TABLE `menu` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `plat_id` int NOT NULL,
  `boisson_id` int NOT NULL,
  `price` int NOT NULL
);

CREATE TABLE `plat` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `recipe` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(255) NOT NULL
);

CREATE TABLE `boisson` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(255) NOT NULL
);

CREATE TABLE `liste` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `restaurant_id` INT NOT NULL,
  `menu_id` INT NOT NULL
);