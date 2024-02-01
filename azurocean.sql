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
  `adresseSite` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `cpSite` int NOT NULL,
  `villeSite` varchar(100) NOT NULL,
  `typeBat` enum('Voile','Moteur','Autre') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'Autre',
  `typeNav` enum('Hauturier','Côtier','Fluvial') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'Côtier' COMMENT 'type de navigation',
  `taille` int NOT NULL,
  `places` int NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `photo1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `photo2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `photo3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`idBateau`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table azurocean.bateau : ~3 rows (environ)
DELETE FROM `bateau`;
INSERT INTO `bateau` (`idBateau`, `idProp`, `nomBateau`, `adresseSite`, `cpSite`, `villeSite`, `typeBat`, `typeNav`, `taille`, `places`, `description`, `photo1`, `photo2`, `photo3`) VALUES
	(1, 1, 'Zephyr', '3quai des boucaniers', 83400, 'Hyeres', 'Voile', 'Côtier', 35, 6, 'Bateau à voile à coque blanche de marque Jeanneau, modèle Sun 2000, de 21 pieds, idéal pour une navigation cotière', '', '', NULL),
	(47, 1, 'ZephyrBis', '234 rue Corto', 92300, 'Levallois', 'Moteur', 'Fluvial', 21, 4, 'Jolie bateau à moteur, idéal pour naviger sur la Seine', '', '', NULL),
	(48, 1, 'Mistral', '2 avenue du capitaine Haddock', 78360, 'Montesson', 'Voile', 'Hauturier', 40, 8, 'Un magnifique 39 pieds Sun Odyssey (11m) avec 3 cabines ', './imageBateauxProprietaire/20200731_140642.jpg', '', NULL);

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
  `mdp` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`idMembre`) USING BTREE,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table azurocean.membre : ~6 rows (environ)
DELETE FROM `membre`;
INSERT INTO `membre` (`idMembre`, `email`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `tel`, `mdp`) VALUES
	(8, 'pop2@gmail.com', 'al', 'ma', '32 rue poule', 56344, 'plop', 607469538, 'Chou1Kale'),
	(9, 'pop3@gmail.com', 'Al', 'Maria-Elisa', '2 rue ploppy', 11234, 'Boule', 607469538, '$argon2id$v=19$m=65536,t=4,p=1$N1d4MGguWkxuS0VaSm9IWg$QhrzRR8pS5PvHiH5OPdpa1HumX/+3OXMPWR6j23BJCQ'),
	(14, 'pop2gty@gmail.com', 'ffefs', 'fesfsf', 'fesfesfesf', 43567, 'PLOOP', 909090909, '$argon2id$v=19$m=65536,t=4,p=1$c0VYWEhzMG5CY3B2aE1xUA$g8Zr3HniITYFeqpgELO/Muf3j5ljb+TtKvcDlNxJZ14'),
	(15, 'pop3gty@gmail.com', 'ffefs', 'fesfsf', 'fesfesfesf', 43567, 'PLOOP', 909090909, '$argon2id$v=19$m=65536,t=4,p=1$b1o1L1oyTE9qek0uNHMyVA$zp/M5M8Cnf+za/onb63HcXGLoNv/yogqeZpNv6tBq5Y'),
	(46, 'pal@po.fr', 'de', 'dez', 'dezdzed', 12340, 'DSZAFDZAFDA', 909090909, '$argon2id$v=19$m=65536,t=4,p=1$OXhUQ3d5MTVVNEZHTlhKbg$2b6coXNSezcsqtuGBI28Feiw4FFr3dY1xRzL850SYb0'),
	(47, 'testo@po.fr', 'zadz', 'zadza', 'dzada', 12345, 'frfefefefe', 909090909, '$argon2id$v=19$m=65536,t=4,p=1$MDVrb0VHZmU4eS80bktsaQ$ZazXGz3lcUUe1Ism/dLaDkbiQufSQ110fHzpZ6wKiLc');

-- Listage de la structure de table azurocean. sejour
CREATE TABLE IF NOT EXISTS `sejour` (
  `idSejour` int NOT NULL AUTO_INCREMENT,
  `idBateau` int NOT NULL,
  `typeNav` enum('hauturier','côtier','fluvial') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'type de navigation',
  `IntituleSej` varchar(50) NOT NULL DEFAULT '',
  `descriptionSej` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `adresse` varchar(200) NOT NULL DEFAULT '0',
  `cpSejour` int NOT NULL,
  `ville` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Prix` int NOT NULL DEFAULT '0',
  `photoSej1` longblob,
  `photoSej2` longblob,
  `photoSej3` longblob,
  PRIMARY KEY (`idSejour`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table azurocean.sejour : ~3 rows (environ)
DELETE FROM `sejour`;
INSERT INTO `sejour` (`idSejour`, `idBateau`, `typeNav`, `IntituleSej`, `descriptionSej`, `dateDebut`, `dateFin`, `adresse`, `cpSejour`, `ville`, `Prix`, `photoSej1`, `photoSej2`, `photoSej3`) VALUES
	(1, 48, 'côtier', 'Cabotage côte provençale', 'Une excursion sur la côte provençale (departement du Var) , aux environs de Fort Bregançon, sur un voilier de 39 pieds. ', '2021-06-05', '2021-04-17', '0', 83400, 'Hyères (Var)', 1600, _binary 0x2e2f696d6167655c766f696c652e6a7067, _binary 0x2e2f696d6167652f6c616c6f6e64652e6a7067, _binary 0x2e2f696d6167652f62617465617541766f696c652e6a7067),
	(2, 1, 'côtier', 'Week-end dans le Sud', 'Séjour 2 nuits sur un voilier Sun 2000, avec navigation côtière du port de Hyères jusqu\'au Lavandou.\r\nNotre bateau le Zephyr est équipé de 4 couchettes.', '2021-04-22', '2021-04-24', '0', 83400, 'Hyeres', 845, _binary 0x2e2f696d6167652f6c616c6f6e64652e6a7067, _binary 0x2e2f696d6167652f62617465617541766f696c652e6a7067, _binary 0x2e2f696d6167652f6c61706c6179612e6a7067),
	(3, 47, 'fluvial', 'Séjour Parisien', 'Un séjour sur la Seine dans les environs de Paris', '2023-12-12', '2023-12-24', '0', 75001, 'Paris', 650, _binary 0x2e2f696d6167652f62617465617541766f696c652e6a7067, _binary 0x2e2f696d6167652f6c616c6f6e64652e6a7067, _binary 0x2e2f696d6167652f6c61706c6179612e6a7067);

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
