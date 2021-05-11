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

ALTER TABLE `menu` ADD FOREIGN KEY (`plat_id`) REFERENCES `plat` (`id`);

ALTER TABLE `menu` ADD FOREIGN KEY (`boisson_id`) REFERENCES `boisson` (`id`);

ALTER TABLE `restaurant` ADD FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);