-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour welchome
CREATE DATABASE IF NOT EXISTS `welchome` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `welchome`;

-- Listage de la structure de la table welchome. equipments
CREATE TABLE IF NOT EXISTS `equipments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `equipments_type_uindex` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Listage des données de la table welchome.equipments : ~11 rows (environ)
DELETE FROM `equipments`;
/*!40000 ALTER TABLE `equipments` DISABLE KEYS */;
INSERT INTO `equipments` (`id`, `type`) VALUES
	(13, 'balcon'),
	(7, 'congelateur'),
	(10, 'cuisine'),
	(6, 'frigo'),
	(12, 'jardin'),
	(9, 'machine à laver'),
	(2, 'micro-onde'),
	(3, 'piscine'),
	(14, 'terrasse'),
	(1, 'tv'),
	(11, 'wifi');
/*!40000 ALTER TABLE `equipments` ENABLE KEYS */;

-- Listage de la structure de la table welchome. offers
CREATE TABLE IF NOT EXISTS `offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `author_id` int(11) NOT NULL,
  `chapo` varchar(255) NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `date_creation` datetime NOT NULL,
  `cp` varchar(50) NOT NULL,
  `standard_id` int(11) DEFAULT NULL,
  `picture` varchar(255) DEFAULT ' ',
  `type` varchar(50) NOT NULL DEFAULT 'Entier',
  PRIMARY KEY (`id`),
  KEY `offers_users_id_fk` (`author_id`),
  KEY `offers_standard_id_fk` (`standard_id`),
  CONSTRAINT `offers_users_id_fk` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Listage des données de la table welchome.offers : ~6 rows (environ)
DELETE FROM `offers`;
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;
INSERT INTO `offers` (`id`, `title`, `author_id`, `chapo`, `price`, `date_creation`, `cp`, `standard_id`, `picture`, `type`) VALUES
	(2, 'Villa face à la mer', 1, 'Une belle villa face à la mer', 90, '2020-09-17 11:15:17', '66000', 1, 'house1.jpg', 'entier'),
	(5, 'Cabane', 7, 'Une petite cabane au fond', 50, '2020-09-18 14:18:48', '31000', 2, 'house2.jpg', 'entier'),
	(6, 'Chambre centre ville', 1, 'Chambre centre urbain', 25, '2020-09-20 10:56:35', '34000', 3, 'house3.jpg', 'chambre'),
	(28, 'Ceci est un test', 1, 'Un test', 50, '2020-09-22 00:00:00', '66170', 31, 'pc-portable3.jpg', 'entier'),
	(29, 'Unique', 1, 'Une expérience extraordinaire !', 0, '2020-09-22 00:00:00', '91700', 32, 'prison.jpg', 'chambre partagée'),
	(30, 'Les banques le deteste', 1, 'dfq dsfq ', 50, '2020-09-22 00:00:00', '31200', 33, 'pc-portable.jpg', 'entier');
/*!40000 ALTER TABLE `offers` ENABLE KEYS */;

-- Listage de la structure de la table welchome. offer_equipment
CREATE TABLE IF NOT EXISTS `offer_equipment` (
  `offer_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  KEY `offer_equipment_equipments_id_fk` (`equipment_id`),
  KEY `offer_equipment_offers_id_fk` (`offer_id`),
  CONSTRAINT `offer_equipment_equipments_id_fk` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`),
  CONSTRAINT `offer_equipment_offers_id_fk` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table welchome.offer_equipment : ~9 rows (environ)
DELETE FROM `offer_equipment`;
/*!40000 ALTER TABLE `offer_equipment` DISABLE KEYS */;
INSERT INTO `offer_equipment` (`offer_id`, `equipment_id`) VALUES
	(2, 1),
	(2, 3),
	(6, 11),
	(6, 9),
	(28, 13),
	(28, 10),
	(29, 9),
	(30, 13),
	(30, 11);
/*!40000 ALTER TABLE `offer_equipment` ENABLE KEYS */;

-- Listage de la structure de la table welchome. reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reservation_offers_id_fk` (`offer_id`),
  KEY `reservation_users_id_fk` (`user_id`),
  CONSTRAINT `reservation_offers_id_fk` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`),
  CONSTRAINT `reservation_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Listage des données de la table welchome.reservation : ~15 rows (environ)
DELETE FROM `reservation`;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` (`id`, `user_id`, `offer_id`, `start_date`, `end_date`) VALUES
	(8, 8, 5, '2020-09-21', '2020-09-25'),
	(9, 8, 2, '2020-09-22', '2020-09-27'),
	(10, 8, 5, '2020-09-30', '2020-09-21'),
	(11, 8, 5, '2020-09-30', '2020-09-21'),
	(12, 8, 5, '2020-09-21', '2020-09-28'),
	(13, 8, 5, '2020-09-21', '2020-09-25'),
	(14, 8, 5, '2020-10-08', '2020-11-18'),
	(15, 8, 5, '2020-10-08', '2020-11-18'),
	(16, 8, 5, '2020-10-08', '2020-11-18'),
	(17, 8, 5, '2020-10-06', '2020-10-16'),
	(18, 7, 2, '2020-09-23', '2020-09-26'),
	(19, 9, 6, '2020-09-23', '2020-09-24'),
	(20, 9, 6, '2020-09-23', '2020-09-24'),
	(21, 7, 29, '2020-09-23', '2020-09-25'),
	(22, 7, 28, '2020-09-30', '2020-10-01');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;

-- Listage de la structure de la table welchome. standard
CREATE TABLE IF NOT EXISTS `standard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `bed_nbrs` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `height` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- Listage des données de la table welchome.standard : ~6 rows (environ)
DELETE FROM `standard`;
/*!40000 ALTER TABLE `standard` DISABLE KEYS */;
INSERT INTO `standard` (`id`, `description`, `bed_nbrs`, `address`, `height`) VALUES
	(1, 'Belle villa face a la mer blabla bla blablablabla', 2, '1 rue de la courcelle', 15),
	(2, 'Dans cette petite cabane au fond des bois vous allez etre vraiment tranquille', 1, 'au fond des bois', 25),
	(3, 'Chambre en plein centre ville, en pleine vie urbaine', 1, 'Montpellier dans le centre', 12),
	(31, 'Un test', 2, '6 place de villefranche', 20),
	(32, 'Dans la belle commune de Fleury Merogis, venez passer une nuit dans une formidable suite, un parloir de qualité, ainsi qu\'une grande cours, de multiple activités sont prevue chaque jours pour vous degourdir les jambes et l\'esprit. Une soirée inoubli', 1, '7 Avenue des Peupliers', 6),
	(33, '', 2, '101 Avenue des Minimes', 20);
/*!40000 ALTER TABLE `standard` ENABLE KEYS */;

-- Listage de la structure de la table welchome. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_uindex` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Listage des données de la table welchome.users : ~4 rows (environ)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`) VALUES
	(1, 'admin', 'azertyuiop', 'azerty@azerty.com', 0),
	(7, 'lidem', 'lidem', 'l_gil@lidem.education', 1),
	(8, 'ludo', 'admin', 'lmkqjsdf@lkqsjdf.fr', 1),
	(9, 'Pykix', '123456789', 'py.gil.ludovic@gmail.fr', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
