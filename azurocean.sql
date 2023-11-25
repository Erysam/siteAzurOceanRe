-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour azurocean
CREATE DATABASE IF NOT EXISTS `azurocean` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `azurocean`;

-- Listage de la structure de table azurocean. bateau
CREATE TABLE IF NOT EXISTS `bateau` (
  `idBateau` int NOT NULL AUTO_INCREMENT,
  `idProp` int NOT NULL,
  `nomBateau` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cpSite` int NOT NULL,
  `adresseSite` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `villeSite` varchar(100) NOT NULL,
  `typeNav` enum('hauturier','cotier','fluvial') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'cotier' COMMENT 'type de navigation',
  `typeBat` enum('voile','moteur','autre') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'autre',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nbCouchage` int NOT NULL,
  `placesHorsCouchage` int NOT NULL,
  `photo` text NOT NULL,
  PRIMARY KEY (`idBateau`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table azurocean.bateau : ~3 rows (environ)
DELETE FROM `bateau`;
INSERT INTO `bateau` (`idBateau`, `idProp`, `nomBateau`, `cpSite`, `adresseSite`, `villeSite`, `typeNav`, `typeBat`, `description`, `nbCouchage`, `placesHorsCouchage`, `photo`) VALUES
	(1, 1, 'Zephyr', 83400, '', 'Hyeres', 'cotier', 'voile', 'Bateau à voile à coque blanche de marque Jeanneau, modèle Sun 2000, de 21 pieds, idéal pour une navigation cotière', 4, 6, ''),
	(47, 1, 'ZephyrBis', 92300, '', 'Levallois', 'fluvial', 'moteur', 'Jolie bateau à moteur, idéal pour naviger sur la Seine', 2, 4, ''),
	(48, 1, 'Mistral', 78360, '', 'Montesson', 'fluvial', 'voile', 'Un magnifique 39 pieds Sun Odyssey (11m) avec 3 cabines ', 6, 8, './imageBateauxProprietaire/20200731_140642.jpg');

-- Listage de la structure de table azurocean. membre
CREATE TABLE IF NOT EXISTS `membre` (
  `idMembre` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `cp` int NOT NULL,
  `ville` varchar(100) NOT NULL,
  `tel` int NOT NULL,
  `login` varchar(100) NOT NULL,
  `mdp` int NOT NULL,
  `typeProfil` int NOT NULL,
  PRIMARY KEY (`idMembre`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table azurocean.membre : ~3 rows (environ)
DELETE FROM `membre`;
INSERT INTO `membre` (`idMembre`, `email`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `tel`, `login`, `mdp`, `typeProfil`) VALUES
	(1, 'MarcosJ@gmail.com', 'Letest', 'Marcos Joaquin', '26 rue du Port  Miramar', 83250, 'La Londe', 147595963, 'MarJo32!', 11111111, 0),
	(3, 'popbull47@laposte.net', 'Alvarez', 'Maryse', '26 ter avenue Messager', 78360, 'Montesson', 607469538, 'marie', 11111111, 0),
	(4, 'leroijean@bretagne.fr', 'Le Cam', 'Jean', '1 Rue du FinistÃ¨re', 29940, 'Port La forÃªt', 604052425, 'LeRoiJean', 11111111, 0);

-- Listage de la structure de table azurocean. sejour
CREATE TABLE IF NOT EXISTS `sejour` (
  `idSejour` int NOT NULL AUTO_INCREMENT,
  `idBateau` int NOT NULL,
  `typeNav` varchar(100) NOT NULL,
  `descriptionSej` text NOT NULL,
  `dateDebut` date NOT NULL,
  `DateFin` date NOT NULL,
  `cpSite` int NOT NULL,
  `lieu` varchar(100) NOT NULL,
  PRIMARY KEY (`idSejour`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table azurocean.sejour : ~2 rows (environ)
DELETE FROM `sejour`;
INSERT INTO `sejour` (`idSejour`, `idBateau`, `typeNav`, `descriptionSej`, `dateDebut`, `DateFin`, `cpSite`, `lieu`) VALUES
	(1, 1, 'Côtière', 'Une excursion sur la côte provençale (departement du Var) , prêt de Fort bregançon, sur un voilier ', '2021-06-05', '2021-04-17', 83400, 'Hyères (Var)'),
	(2, 1, 'Côtier', 'Séjour 2 nuits sur un voilier Sun 2000, avec navigation côtière du port de Hyères jusqu\'au du Lavandou.\r\nNotre bateau le Zephyr2 est équiper de 4 couchettes.', '2021-04-22', '2021-04-24', 83400, 'Hyeres');

-- Listage de la structure de table azurocean. skipper
CREATE TABLE IF NOT EXISTS `skipper` (
  `idSkip` int NOT NULL AUTO_INCREMENT,
  `nomS` varchar(100) NOT NULL,
  `prenomS` varchar(100) NOT NULL,
  `adresseS` varchar(100) NOT NULL,
  `cp` int NOT NULL,
  `ville` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `telephone` int NOT NULL,
  PRIMARY KEY (`idSkip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table azurocean.skipper : ~0 rows (environ)
DELETE FROM `skipper`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
