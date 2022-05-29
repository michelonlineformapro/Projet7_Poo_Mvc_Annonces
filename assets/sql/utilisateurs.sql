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
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `email_utilisateur` varchar(255) NOT NULL,
  `password_utilisateur` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `email_utilisateur`, `password_utilisateur`, `role`) VALUES
(7, 'test@test.fr', 'test', 'administrateur'),
(10, 'micpiwo@hotmail.fr', '$2y$10$vU61Qv6Qn4XtE8oygNEaDuNGjiOO9/kX7oaJ.L6VUoq9dEchb8tWm', 'administrateur'),
(11, 'job@laposte.net', '$2y$10$vDjdMHHllyUNlvIVA5hNn.3bNtc.nIpnlVjaAmOAW/qSPwbN0llk.', 'utilisateur'),
(12, 'tony@laposte.net', '$2y$10$mdvUrbz/OeGtl.B3qJ6GG.JFVmndu.ToEeNTaz3tMFHjXJtOQyyiS', 'utilisateur'),
(13, 'alice@gmail.com', '$2y$10$/aQzJaeZVqgLiKxayb0AKuxMjgdvVb6bGNqhygbZWf1emhPpmF60C', 'utilisateur'),
(14, 'joe@hotmail.fr', '$2y$10$5nULR7NuZB3HUs3WnHRA2.bziZxINUqTtr.qbLDoIrB9Q4OfcyAcK', 'utilisateur'),
(15, 'laura@laposte.net', '$2y$10$5HNhQiOJe7SFuIVmAU/Wk.lzZ0yWPVP0r/m8ph2zNp9TBRy.doowm', 'utilisateur'),
(16, 'giles@cool.fr', '$2y$10$csFqy7ysP2dFeu7xD5yhyeKJlMwUiIZPdHpmTHEWRVlF/IpNZYPxK', 'utilisateur'),
(17, 'emilie@hotmail.fr', '$2y$10$UJeWQoJY3lgV1/HC9rgWx.yI5umn4eQUwu.5KHjA0HfCEjYnWW3V.', 'utilisateur'),
(18, 'stephane@outlook.fr', '$2y$10$ThZ2OQwsbTgOElLIfc7jGuhLoRPBMV3L9opKf2ATMwHibI.I1GdbK', 'utilisateur'),
(19, 'alice@laposte.fr', '$2y$10$GN1BDYEAspAJW5ofueWmnOEFEbTw4q7ZA3dwsJPWYvj8BGNrpNrqu', 'utilisateur'),
(20, 'corrine@hotmail.fr', '$2y$10$YLW7ZsyR3vmuhXvQ0cGGceWwvBqVEyZiP.JSU1FPwzM31bm7WjLs.', 'utilisateur'),
(21, 'alex@laposte.net', '$2y$10$DWSbcKPMFcdbUHmXevtAxeYxh3IMI3CjclytVknb/NY0ywJhWgByi', 'utilisateur'),
(22, 'jojo@outlook.fr', '$2y$10$tw4.qMDil99qg3krV93ojOHC.VD1ELtBfkWHHrF1JfAbisW2/uBAi', 'utilisateur'),
(23, 'sonia@hotmail.fr', '$2y$10$tF8NBbUzcztP68r9yexJcuMN.si/7gdd55EkcHqWk0EOzD8.bIkU2', 'utilisateur');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
