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
  `photo1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT '',
  `photo2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT '',
  `photo3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`idBateau`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table azurocean.bateau : ~12 rows (environ)
DELETE FROM `bateau`;
INSERT INTO `bateau` (`idBateau`, `idProp`, `nomBateau`, `adresseSite`, `cpSite`, `villeSite`, `typeBat`, `typeNav`, `taille`, `places`, `description`, `photo1`, `photo2`, `photo3`) VALUES
	(1, 1, 'Zephyr', '3quai des boucaniers', 83400, 'Hyeres', 'Voile', 'Côtier', 35, 6, 'Bateau à voile à coque blanche de marque Jeanneau, modèle Sun 2000, de 21 pieds, idéal pour une navigation cotière', '', '', NULL),
	(47, 1, 'ZephyrBis', '234 rue Corto', 92300, 'Levallois', 'Moteur', 'Fluvial', 21, 4, 'Jolie bateau à moteur, idéal pour naviger sur la Seine', '', '', NULL),
	(48, 1, 'Mistral', '2 avenue du capitaine Haddock', 78360, 'Montesson', 'Voile', 'Hauturier', 40, 8, 'Un magnifique 39 pieds Sun Odyssey (11m) avec 3 cabines ', './imageBateauxProprietaire/20200731_140642.jpg', '', NULL),
	(61, 52, 'totou', 'dgeygdye', 23145, 'GRE', 'Voile', 'Hauturier', 23, 3, 'fezfezfezfezfezfezfezf', 'C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/photo14c0b4af8300ed094.jpg', 'C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/photo27b9d6135aa682dd8.png', 'C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/photo3d2e750c540615233.jpg'),
	(62, 52, 'totou', 'dgeygdye', 23145, 'GRE', 'Voile', 'Hauturier', 23, 3, 'fezfezfezfezfezfezfezf', 'C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/photo1dfe14aaa5fd9635f.jpg', 'C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/photo21ea92d338cd644a5.png', 'C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/photo3c05b72c6c95ceb6d.jpg'),
	(63, 52, 'zeze', 'dsdq', 12333, 'sdd', 'Voile', 'Hauturier', 23, 2, 'frfrfrfrfrfrfrfrfrfr', 'C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/photo1cbb5ea991e686c98.jpg', 'C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/photo246fa03050a432553.jpg', NULL),
	(64, 52, 'zeze', 'dsdq', 12333, 'sdd', 'Voile', 'Hauturier', 23, 2, 'frfrfrfrfrfrfrfrfrfr', 'C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/photo1a87e5e09aec3d470.jpg', 'C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/photo22607640719e80f29.jpg', NULL),
	(65, 52, 'zeze', 'dsdq', 12333, 'sdd', 'Voile', 'Hauturier', 23, 2, 'frfrfrfrfrfrfrfrfrfr', NULL, NULL, NULL),
	(66, 52, 'zeze', 'dsdq', 12333, 'sdd', 'Voile', 'Hauturier', 23, 2, 'frfrfrfrfrfrfrfrfrfr', NULL, NULL, NULL),
	(67, 52, 'Prout', 'dzadada', 11111, 'dede', 'Voile', 'Hauturier', 12, 1, 'szszszszszsz', NULL, NULL, NULL),
	(68, 52, 'bulle', 'fhiezhfeihflz', 34456, 'gdyugezd', 'Voile', 'Hauturier', 43, 6, 'dezadzadzdzadzadzadzad', 'C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/photo17039c99d52de896c.jpg', 'C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/photo27cbd9b466e54ae4e.png', NULL),
	(69, 52, 'bulle', 'fhiezhfeihflz', 34456, 'gdyugezd', 'Voile', 'Hauturier', 43, 6, 'dezadzadzdzadzadzadzad', 'C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/photo1a70b663c3c88c848.jpg', 'C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/photo2044c1433d136e3f6.png', NULL);

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
  `mdp` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cle` varchar(200) NOT NULL,
  `actif` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`idMembre`) USING BTREE,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table azurocean.membre : ~4 rows (environ)
DELETE FROM `membre`;
INSERT INTO `membre` (`idMembre`, `email`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `tel`, `mdp`, `cle`, `actif`) VALUES
	(54, 'poppy@mail.fr', 'pop', 'test', '43Rue poulet', 44444, 'Paris', 607469538, '$argon2id$v=19$m=65536,t=4,p=1$OWF1dXZNNWxwRGZvM1N1bQ$MCL9ubk7vH9LGyF8LoRu1S7IoZuC/9HhQ2T/vvnA960', 'f8bde35ec71e7aab11a462b4094ad4c6', 1),
	(64, 'azurOcean@protonmail.com', 'fr', 'tr', 'ezaea', 12223, 'der', 909090900, '$argon2id$v=19$m=65536,t=4,p=1$UERGWmk2ckQyZjRpWDFGSQ$ecN/91mfu+Qbwr0fto2y6y5CtJJfPuUWepgsJiY8E1Q', 'd2a41b52ef69480bde84f9311db0352a', 1),
	(65, 'client2@cl.fr', 'cli', 'Mina', 'plop', 65432, 'Mont', 987654390, '$argon2id$v=19$m=65536,t=4,p=1$Yll0Nkx0aUNpY2x1ejF4Qg$E9TwbKgvpJW4mgQD+6flDKV3siiZXI9bUsX6DIFYwCY', '49096385e98eb40bac99ac425b4449c1', 1),
	(67, 'bhml0e2xi@mozmail.com', 'ma', 'al', 'rue lili', 9000, 'Mont', 909090900, '$argon2id$v=19$m=65536,t=4,p=1$Ri9iY2JhdldhaVFyWmFwSQ$7N4vNK6efLfMmg+fidFLhZ4sLpiryETvc09vOn529ks', '954612de072ad4d5a7c813c801c1d2eb', 1);

-- Listage de la structure de table azurocean. reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `idReservation` int NOT NULL AUTO_INCREMENT,
  `idSej` int NOT NULL,
  `idMembre` int NOT NULL,
  `passagers` int NOT NULL,
  `permisBat` enum('Pas de permis','Côtier','Hauturier') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Attention data considérée comme une string',
  PRIMARY KEY (`idReservation`),
  KEY `idSej` (`idSej`),
  KEY `FK_reservation_membre` (`idMembre`),
  CONSTRAINT `FK_reservation_membre` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`idMembre`),
  CONSTRAINT `FK_reservation_sejour` FOREIGN KEY (`idSej`) REFERENCES `sejour` (`idSejour`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table azurocean.reservation : ~3 rows (environ)
DELETE FROM `reservation`;
INSERT INTO `reservation` (`idReservation`, `idSej`, `idMembre`, `passagers`, `permisBat`) VALUES
	(21, 1, 65, 3, 'Pas de permis'),
	(22, 2, 65, 3, ''),
	(23, 3, 65, 4, 'Pas de permis');

-- Listage de la structure de table azurocean. reservation_par_jour_test
CREATE TABLE IF NOT EXISTS `reservation_par_jour_test` (
  `idReservation` int NOT NULL AUTO_INCREMENT,
  `idSejour` int NOT NULL,
  `idMembre` int NOT NULL,
  `jourResa` int NOT NULL,
  PRIMARY KEY (`idReservation`,`jourResa`) USING BTREE,
  KEY `idSejour` (`idSejour`) USING BTREE,
  KEY `idMembre` (`idMembre`) USING BTREE,
  CONSTRAINT `reservation_par_jour_test_ibfk_1` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`idMembre`),
  CONSTRAINT `reservation_par_jour_test_ibfk_2` FOREIGN KEY (`idSejour`) REFERENCES `sejour` (`idSejour`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Listage des données de la table azurocean.reservation_par_jour_test : ~0 rows (environ)
DELETE FROM `reservation_par_jour_test`;

-- Listage de la structure de table azurocean. sejour
CREATE TABLE IF NOT EXISTS `sejour` (
  `idSejour` int NOT NULL AUTO_INCREMENT,
  `idBateau` int NOT NULL,
  `typeNavSej` enum('hauturier','côtier','fluvial') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'type de navigation',
  `intituleSej` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `descriptionSej` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `dateDebutSej` date NOT NULL,
  `dateFinSej` date NOT NULL,
  `adresseSej` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cpSej` int DEFAULT '0',
  `villeSej` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT '',
  `prixSej` int NOT NULL DEFAULT '0',
  `photoSej1` text,
  `photoSej2` text,
  `photoSej3` text,
  `reservation` enum('0','1') DEFAULT '0' COMMENT '0 séjour dispo, 1 séjour réservé',
  PRIMARY KEY (`idSejour`),
  KEY `FK_sejour_bateau` (`idBateau`),
  CONSTRAINT `FK_sejour_bateau` FOREIGN KEY (`idBateau`) REFERENCES `bateau` (`idBateau`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table azurocean.sejour : ~7 rows (environ)
DELETE FROM `sejour`;
INSERT INTO `sejour` (`idSejour`, `idBateau`, `typeNavSej`, `intituleSej`, `descriptionSej`, `dateDebutSej`, `dateFinSej`, `adresseSej`, `cpSej`, `villeSej`, `prixSej`, `photoSej1`, `photoSej2`, `photoSej3`, `reservation`) VALUES
	(1, 48, 'côtier', 'Cabotage côte provençale', 'Une excursion sur la côte provençale (departement du Var) , aux environs de Fort Bregançon, sur un voilier de 39 pieds. ', '2021-06-05', '2021-04-17', NULL, 83000, 'Hyeres', 1600, './image\\voile.jpg', './image/lalonde.jpg', './image/bateauAvoile.jpg', '0'),
	(2, 1, 'côtier', 'Week-end dans le Sud', 'Séjour 2 nuits sur un voilier Sun 2000, avec navigation côtière du port de Hyères jusqu\'au Lavandou.\r\nNotre bateau le Zephyr est équipé de 4 couchettes.', '2021-04-22', '2021-04-24', NULL, 13000, 'Marseille\r\n', 845, './image/lalonde.jpg', './image/bateauAvoile.jpg', './image/laplaya.jpg', '0'),
	(3, 47, 'fluvial', 'Séjour Parisien', 'Un séjour sur la Seine dans les environs de Paris', '2023-12-12', '2023-12-24', NULL, 83000, 'Hyeres', 650, './image/bateauAvoile.jpg', './image/lalonde.jpg', './image/laplaya.jpg', '0'),
	(9, 61, 'hauturier', 'plop', 'Balade verte dans les canaux de la ville', '2024-03-22', '2024-03-08', 'Crypte 34', 39000, 'Undercity', 56676, NULL, NULL, NULL, '0'),
	(10, 61, 'hauturier', 'plip', 'au bord du lac de la corne', '2024-03-15', '2024-03-09', 'Quai 21', 78654, 'Thunderbluff', 654, NULL, NULL, NULL, '0'),
	(11, 61, 'hauturier', 'Test 13', 'xqxQxqXQx', '2024-03-15', '2024-03-20', 'Canal de Loucq', 56432, 'Pauville', 987, NULL, NULL, NULL, '0'),
	(12, 61, 'hauturier', 'Test 13.2', 'au bord du lac LocLac', '2024-03-15', '2024-03-21', 'Port de Lerville', 80000, 'Lerville', 90, 'C:/laragon/www/siteAzurOceanRe/azurOceanRe_imagesUsersBateaux/photo2044c1433d136e3f6.png', NULL, NULL, '0');

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
