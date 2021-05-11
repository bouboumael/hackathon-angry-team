CREATE TABLE `restaurant` (
  `id` int PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `localisation` text NOT NULL,
  `menu_id` INT NOT NULL,
  `image` varchar(255) NOT NULL
);

CREATE TABLE `menu` (
  `id` int PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `plat_id` int NOT NULL,
  `boisson_id` int NOT NULL
);

CREATE TABLE `plat` (
  `id` int PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `recipe` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(255) NOT NULL
);

CREATE TABLE `boisson` (
  `id` int PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(255) NOT NULL
);

ALTER TABLE `plat` ADD FOREIGN KEY (`id`) REFERENCES `menu` (`plat_id`);

ALTER TABLE `boisson` ADD FOREIGN KEY (`id`) REFERENCES `menu` (`boisson_id`);

ALTER TABLE `menu` ADD FOREIGN KEY (`id`) REFERENCES `restaurant` (`menu_id`);