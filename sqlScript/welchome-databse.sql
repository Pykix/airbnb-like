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
DROP DATABASE IF EXISTS `welchome`;
CREATE DATABASE IF NOT EXISTS `welchome` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `welchome`;

-- Listage de la structure de la table welchome. equipments
DROP TABLE IF EXISTS `equipments`;
CREATE TABLE IF NOT EXISTS `equipments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `equipments_type_uindex` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Listage des données de la table welchome.equipments : ~7 rows (environ)
DELETE FROM `equipments`;
/*!40000 ALTER TABLE `equipments` DISABLE KEYS */;
INSERT INTO `equipments` (`id`, `type`) VALUES
	(7, 'congelateur'),
	(6, 'frigo'),
	(4, 'lit double'),
	(5, 'lit simple'),
	(2, 'micro-onde'),
	(3, 'piscine'),
	(1, 'tv');
/*!40000 ALTER TABLE `equipments` ENABLE KEYS */;

-- Listage de la structure de la table welchome. offers
DROP TABLE IF EXISTS `offers`;
CREATE TABLE IF NOT EXISTS `offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `author_id` int(11) NOT NULL,
  `chapo` varchar(255) NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `date_creation` timestamp NOT NULL,
  `cp` varchar(50) NOT NULL,
  `standard_id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offers_users_id_fk` (`author_id`),
  KEY `offers_standard_id_fk` (`standard_id`),
  CONSTRAINT `offers_standard_id_fk` FOREIGN KEY (`standard_id`) REFERENCES `standard` (`id`),
  CONSTRAINT `offers_users_id_fk` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Listage des données de la table welchome.offers : ~2 rows (environ)
DELETE FROM `offers`;
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;
INSERT INTO `offers` (`id`, `title`, `author_id`, `chapo`, `price`, `date_creation`, `cp`, `standard_id`, `picture`) VALUES
	(2, 'Villa face mer', 1, 'Une belle villa face à la mer', 90, '2020-09-17 11:15:17', '66000', 1, 'house1.jpg'),
	(5, 'Cabane', 7, 'Une petite cabane au fond', 50, '2020-09-18 14:18:48', '31000', 2, 'house2.jpg');
/*!40000 ALTER TABLE `offers` ENABLE KEYS */;

-- Listage de la structure de la table welchome. offer_equipment
DROP TABLE IF EXISTS `offer_equipment`;
CREATE TABLE IF NOT EXISTS `offer_equipment` (
  `offer_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  KEY `offer_equipment_equipments_id_fk` (`equipment_id`),
  KEY `offer_equipment_offers_id_fk` (`offer_id`),
  CONSTRAINT `offer_equipment_equipments_id_fk` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`),
  CONSTRAINT `offer_equipment_offers_id_fk` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table welchome.offer_equipment : ~5 rows (environ)
DELETE FROM `offer_equipment`;
/*!40000 ALTER TABLE `offer_equipment` DISABLE KEYS */;
INSERT INTO `offer_equipment` (`offer_id`, `equipment_id`) VALUES
	(2, 1),
	(2, 4),
	(2, 3),
	(5, 4),
	(5, 5);
/*!40000 ALTER TABLE `offer_equipment` ENABLE KEYS */;

-- Listage de la structure de la table welchome. reservation
DROP TABLE IF EXISTS `reservation`;
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Listage des données de la table welchome.reservation : ~7 rows (environ)
DELETE FROM `reservation`;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` (`id`, `user_id`, `offer_id`, `start_date`, `end_date`) VALUES
	(8, 8, 5, '2020-09-21', '2020-09-25'),
	(9, 8, 2, '2020-09-22', '2020-09-27'),
	(10, 8, 5, '2020-09-30', '2020-09-21'),
	(11, 8, 5, '2020-09-30', '2020-09-21'),
	(12, 8, 5, '2020-09-21', '2020-09-28'),
	(13, 8, 5, '2020-09-21', '2020-09-25'),
	(14, 8, 5, '2020-10-08', '2020-11-18');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;

-- Listage de la structure de la table welchome. standard
DROP TABLE IF EXISTS `standard`;
CREATE TABLE IF NOT EXISTS `standard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `bed_nbrs` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `height` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table welchome.standard : ~2 rows (environ)
DELETE FROM `standard`;
/*!40000 ALTER TABLE `standard` DISABLE KEYS */;
INSERT INTO `standard` (`id`, `description`, `bed_nbrs`, `address`, `height`) VALUES
	(1, 'Belle villa face a la mer blabla bla blablablabla', 2, '1 rue de la courcelle', 15),
	(2, 'Dans cette petite cabane au fond des bois vous allez etre vraiment tranquille', 1, 'au fond des bois', 25);
/*!40000 ALTER TABLE `standard` ENABLE KEYS */;

-- Listage de la structure de la table welchome. users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_uindex` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Listage des données de la table welchome.users : ~3 rows (environ)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`) VALUES
	(1, 'admin', 'azertyuiop', 'azerty@azerty.com', 0),
	(7, 'lidem', 'lidem', 'l_gil@lidem.education', 1),
	(8, 'ludo', 'admin', 'lmkqjsdf@lkqsjdf.fr', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
