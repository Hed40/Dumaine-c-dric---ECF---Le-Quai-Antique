
-- Création de la base de donnée restaurant --

CREATE DATABASE IF NOT EXISTS w38z7qodtk9s70r1 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;


USE w38z7qodtk9s70r1; -- On utilise la base de donnée


-- Création des tables --

CREATE TABLE `categories` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `starter` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `categorie_id` int(11) DEFAULT NULL,
  `title` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  CONSTRAINT `FK_4042238BBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `dish` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `categorie_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(5,2) NOT NULL,
  CONSTRAINT `FK_957D8CB8BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `desserts` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `categorie_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allergene` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  CONSTRAINT `FK_21BD061BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `drinks` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `categorie_id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alcool_content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(5,2) NOT NULL,
  CONSTRAINT `FK_EAD79309BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `illustration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `restaurant_schedule` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `restaurant_id_id` int(11) DEFAULT NULL,
  `week_day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lunch_opening_time` time NOT NULL,
  `lunch_closure_time` time NOT NULL,
  `evening_opening_time` time NOT NULL,
  `evening_closure_time` time NOT NULL,
  CONSTRAINT `FK_7A9DDF1435592D86` FOREIGN KEY (`restaurant_id_id`) REFERENCES `restaurant` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `set_menu` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `starter_id` int(11) DEFAULT NULL,
  `dish_id` int(11) DEFAULT NULL,
  `dessert_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(5,2) NOT NULL,
  CONSTRAINT `FK_E8C2D81A148EB0CB` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_E8C2D81A745B52FD` FOREIGN KEY (`dessert_id`) REFERENCES `desserts` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_E8C2D81AAD5A66CC` FOREIGN KEY (`starter_id`) REFERENCES `starter` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `menus` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `lunch_set_menu_id` int(11) DEFAULT NULL,
  `diner_set_menu_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  CONSTRAINT `FK_727508CF3EB00C5C` FOREIGN KEY (`diner_set_menu_id`) REFERENCES `set_menu` (`id`),
  CONSTRAINT `FK_727508CFEF3F25DE` FOREIGN KEY (`lunch_set_menu_id`) REFERENCES `set_menu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `user` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guests_number` int(11) DEFAULT NULL,
  `allergie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `guests_number` int(11) DEFAULT NULL,
  `allergie` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heure` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservation_user_id` int(11) DEFAULT NULL,
  CONSTRAINT `FK_42C84955C0FB6810` FOREIGN KEY (`reservation_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user`(`id`, `firstname`, `lastname`, `email`, `roles`, `password`, `guests_number`, `allergie`) VALUES 
(6, "hote d/'accueil", 'admin', 'lequaiantique@restaurant.com','["ROLE_ADMIN"]','$2y$13$nwlcf6fw6KXiVM3cM2TKB.Nn1/xf.JA.8TRVf7enc.wiA3c6tND8G','0', 'aucune allergie');

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `roles`, `password`, `guests_number`, `allergie`) VALUES
(1, 'Cedric', 'DUMAINE', 'cedric.dumaine33@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$uOqWbEAg848MZQ5xTTKA1O8ljChGHhgo9FpKLsoFAhJsyzEap8QYS', 1, 'Lactose');

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Entrée'),
(2, 'Plat'),
(3, 'Dessert'),
(4, 'Boisson'),
(5, 'Boisson sans alcool'),
(6, 'Boissons alcoolisé'),
(7, 'Boissons chaudes');

INSERT INTO `starter` (`id`, `categorie_id`, `title`, `description`, `price`) VALUES
(1, 1, 'Salade verte vinegrette', 'Belle salade verte sous sa vinaigrette', '6.10'),
(2, 1, 'Oeuf mimosa', 'Fraîchement sortie du c**l de nos poules ! Un vrai régal !', '3.00');

INSERT INTO `desserts` (`id`, `categorie_id`, `name`, `description`, `allergene`, `price`) VALUES
(1, 3, 'Tarte au citron', 'Un tarte au citron d\'exeption', 'Lactose', '3.50'),
(2, 3, 'Tiramisu Maison', 'Fondant et crémeux...un délisse', 'Lactose', '4.50');

INSERT INTO `dish` (`id`, `categorie_id`, `title`, `description`, `price`) VALUES
(1, 2, 'Pizza 4 fromages', 'La pizza la plus célèbre du restaurant ! Un délice !', '10.99'),
(2, 2, 'Burger du Chef', 'Ceci est un burger à l\'américaine', '10.00');

INSERT INTO `drinks` (`id`, `categorie_id`, `brand`, `volume`, `description`, `alcool_content`, `price`) VALUES
(1, 4, 'Sprite', '25 cl', NULL, '0 %', '3.00'),
(2, 4, 'Fanta', '25 cl', NULL, '0 %', '3.00'),
(4, 6, 'Wiskey Coca', '25 cl', NULL, '6 %', '6.00'),
(5, 6, 'Pastis', '75 cl', NULL, '6 %', '6.00');

INSERT INTO `gallery` (`id`, `titre`, `illustration`) VALUES
(1, 'Nos pates végétarienne', '9668a0321b7378f36236042e1a0c24e55cfb81fb.jpg'),
(2, 'Notre burger \"De la mort\"', 'd9878c6bc2f4c3079109943176295e146e8e424a.jpg'),
(3, 'Pizza 4 fromages', 'fd05a6991a8db6600b0cbf8234b436cfe39f1875.jpg');
INSERT INTO `restaurant_schedule` (`id`, `restaurant_id_id`, `week_day`, `lunch_opening_time`, `lunch_closure_time`, `evening_opening_time`, `evening_closure_time`) VALUES
(1, NULL, 'Lundi', '12:00:00', '15:00:00', '18:00:00', '22:00:00'),
(2, NULL, 'Mardi', '12:00:00', '15:00:00', '18:00:00', '22:00:00'),
(3, NULL, 'Mercredi', '12:00:00', '15:00:00', '18:00:00', '22:00:00'),
(4, NULL, 'Jeudi', '12:00:00', '15:00:00', '18:00:00', '22:00:00'),
(5, NULL, 'Vendredi', '12:00:00', '15:00:00', '18:00:00', '22:00:00'),
(7, NULL, 'Samedi', '12:00:00', '15:00:00', '18:00:00', '22:00:00');

INSERT INTO `set_menu` (`id`, `starter_id`, `dish_id`, `dessert_id`, `name`, `description`, `price`) VALUES
(1, 2, 2, 1, 'Formule Antique', NULL, '15.00'),
(2, 1, 1, 2, 'Formule du chef', NULL, '20.00'),
(3, 2, 2, 2, 'Formule du jour', NULL, '18.00');

INSERT INTO `menus` (`id`, `lunch_set_menu_id`, `diner_set_menu_id`, `name`) VALUES
(1, 2, 1, 'Menu Antique'),
(2, 1, 3, 'Menu du marché');

INSERT INTO `restaurant` (`id`,`name`,`adresse`,`phone_number`,`email`,`max_seats`) VALUES
(1,'Le Quai Antique','7 rue de la dalle - Annecy','06 66 66 66 66','lequaiantique@restaurant.fr', 60)