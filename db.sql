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
  `boisson_id` int NOT NULL
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

INSERT INTO plat (name, recipe, price, image) VALUES ('Cornet de carbonne', 'Grand cornet, remplis de poussière de carbonne', 15, 'https://picsum.photos/seed/picsum/200/300');
INSERT INTO plat (name, recipe, price, image) VALUES ('Rocher à la martienne', 'Roche tout droit venu de mars concasser', 25, 'https://picsum.photos/seed/picsum/200/300');
INSERT INTO plat (name, recipe, price, image) VALUES ('Boulons des ancien', 'Boulons plus ou moin rouillé ayant très certainement appartenue à un robot aillant foulé la terre martienne', 5, 'https://picsum.photos/seed/picsum/200/300');
INSERT INTO plat (name, recipe, price, image) VALUES ('Plat surprise', "Personne ne sait vraimment se qu'il y a dedans...", 55, 'https://picsum.photos/seed/picsum/200/300');

INSERT INTO boisson (name, price, image) VALUES ("Bidon d'huile", 15, 'https://picsum.photos/seed/picsum/200/300');
INSERT INTO boisson (name, price, image) VALUES ("Bidon d'essence", 12, 'https://picsum.photos/seed/picsum/200/300');
INSERT INTO boisson (name, price, image) VALUES ("Bidon de liquide de refroidissement", 20, 'https://picsum.photos/seed/picsum/200/300');
INSERT INTO boisson (name, price, image) VALUES ("Liquide non euclidien", 46, 'https://picsum.photos/seed/picsum/200/300');

INSERT INTO menu (name, plat_id, boisson_id) VALUES ("Le generator", 1, 2);
INSERT INTO menu (name, plat_id, boisson_id) VALUES ("L'espérance", 3, 2);
INSERT INTO menu (name, plat_id, boisson_id) VALUES ("Le rover positif", 1, 3);
INSERT INTO menu (name, plat_id, boisson_id) VALUES ("Nouvelle jeunesse", 3, 4);
INSERT INTO menu (name, plat_id, boisson_id) VALUES ("Burger boulon", 3, 2);
INSERT INTO menu (name, plat_id, boisson_id) VALUES ("Le casse brique", 2, 2);
INSERT INTO menu (name, plat_id, boisson_id) VALUES ("Le Wall-E-Bird", 3, 1);
INSERT INTO menu (name, plat_id, boisson_id) VALUES (".....", 4, 4);
