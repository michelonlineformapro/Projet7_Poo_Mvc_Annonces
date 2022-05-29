-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 29 mai 2022 à 07:48
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `petite_annonces`
--

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id_regions` int(10) NOT NULL AUTO_INCREMENT,
  `nom_region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_regions`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id_regions`, `nom_region`, `slug`) VALUES
(6, 'Île-de-France', 'ile de france'),
(7, 'Centre-Val de Loire', 'centre val de loire'),
(8, 'Bourgogne-Franche-Comté', 'bourgogne franche comte'),
(9, 'Normandie', 'normandie'),
(10, 'Hauts-de-France', 'hauts de france'),
(11, 'Grand Est', 'grand est'),
(12, 'Pays de la Loire', 'pays de la loire'),
(13, 'Bretagne', 'bretagne'),
(14, 'Nouvelle-Aquitaine', 'nouvelle aquitaine'),
(15, 'Occitanie', 'occitanie'),
(16, 'Auvergne-Rhône-Alpes', 'auvergne rhone alpes'),
(17, 'Provence-Alpes-Côte d\'Azur', 'provence alpes cote dazur'),
(18, 'Corse', 'corse');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
