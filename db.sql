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

INSERT INTO plat (name, recipe, price, image) VALUES ('Cornet de carbonne', 'Grand cornet, remplis de poussière de carbonne', 15, 'https://picsum.photos/seed/picsum/200/300');
INSERT INTO plat (name, recipe, price, image) VALUES ('Rocher à la martienne', 'Roche tout droit venu de mars concasser', 25, 'https://picsum.photos/seed/picsum/200/300');
INSERT INTO plat (name, recipe, price, image) VALUES ('Boulons des ancien', 'Boulons plus ou moin rouillé ayant très certainement appartenue à un robot aillant foulé la terre martienne', 5, 'https://picsum.photos/seed/picsum/200/300');
INSERT INTO plat (name, recipe, price, image) VALUES ('Plat surprise', "Personne ne sait vraimment se qu'il y a dedans...", 55, 'https://picsum.photos/seed/picsum/200/300');

INSERT INTO boisson (name, price, image) VALUES ("Bidon d'huile", 15, 'https://picsum.photos/seed/picsum/200/300');
INSERT INTO boisson (name, price, image) VALUES ("Bidon d'essence", 12, 'https://picsum.photos/seed/picsum/200/300');
INSERT INTO boisson (name, price, image) VALUES ("Bidon de liquide de refroidissement", 20, 'https://picsum.photos/seed/picsum/200/300');
INSERT INTO boisson (name, price, image) VALUES ("Liquide non euclidien", 46, 'https://picsum.photos/seed/picsum/200/300');

INSERT INTO menu (name, plat_id, boisson_id, price) VALUES ("Le generator", 1, 2,12);
INSERT INTO menu (name, plat_id, boisson_id, price) VALUES ("L'espérance", 3, 2,35);
INSERT INTO menu (name, plat_id, boisson_id, price) VALUES ("Le rover positif", 1, 3,11);
INSERT INTO menu (name, plat_id, boisson_id, price) VALUES ("Nouvelle jeunesse", 3, 4,14);
INSERT INTO menu (name, plat_id, boisson_id, price) VALUES ("Burger boulon", 3, 2,09);
INSERT INTO menu (name, plat_id, boisson_id, price) VALUES ("Le casse brique", 2, 2,30);
INSERT INTO menu (name, plat_id, boisson_id, price) VALUES ("Le Wall-E-Bird", 3, 1,05);
INSERT INTO menu (name, plat_id, boisson_id, price) VALUES (".....", 4, 4,06);

INSERT INTO planete (name) VALUES
('mercury'),
('venus'),
('earth'),
('mars'),
('jupiter'),
('saturn'),
('uranus'),
('neptune')
;

INSERT INTO restaurant (name, localisation, description,	image
) VALUES
('Ingenuity', 'Cratère jezero', 'Arrivé 2020', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Ingenuity_Helicopter_Rotor_Blades_Unlocked_GifCam.gif/220px-Ingenuity_Helicopter_Rotor_Blades_Unlocked_GifCam.gif'),
('Curiosity', 'Cratère Gale', 'Arrivé en 2012', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Curiosity_Mars_Science_Laboratory_Rover.jpg/220px-Curiosity_Mars_Science_Laboratory_Rover.jpg')
;

INSERT INTO localisation (restaurant_id, planete_id) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8)
;

INSERT INTO liste (restaurant_id, menu_id) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8)
;
