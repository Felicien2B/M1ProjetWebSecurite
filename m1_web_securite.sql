-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 08 oct. 2022 à 15:10
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `m1_web_securite`
--

-- --------------------------------------------------------

--
-- Structure de la table `ami`
--

DROP TABLE IF EXISTS `ami`;
CREATE TABLE IF NOT EXISTS `ami` (
  `id_user` int(18) NOT NULL,
  `id_ami` int(18) NOT NULL,
  PRIMARY KEY (`id_user`,`id_ami`),
  KEY `id_user` (`id_user`),
  KEY `id_ami` (`id_ami`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure de la table `galerie`
--

DROP TABLE IF EXISTS `galerie`;
CREATE TABLE IF NOT EXISTS `galerie` (
  `id_galerie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_galerie` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `id_user` int(18) NOT NULL,
  PRIMARY KEY (`id_galerie`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure de la table `galerie_image_liaison`
--

DROP TABLE IF EXISTS `galerie_image_liaison`;
CREATE TABLE IF NOT EXISTS `galerie_image_liaison` (
  `id_galerie` int(11) NOT NULL,
  `id_image` int(11) NOT NULL,
  PRIMARY KEY (`id_galerie`,`id_image`),
  KEY `id_galerie` (`id_galerie`),
  KEY `id_image` (`id_image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `lien_image` varchar(500) COLLATE utf8mb4_bin NOT NULL,
  `id_user` int(18) NOT NULL,
  `droit_image` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id_image`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(18) NOT NULL AUTO_INCREMENT,
  `mail_user` varchar(500) COLLATE utf8mb4_bin NOT NULL,
  `nom_user` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `prenom_user` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `adresse_user` varchar(500) COLLATE utf8mb4_bin NOT NULL,
  `code_postal_user` int(5) NOT NULL,
  `ville_user` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `description_user` varchar(500) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ami`
--
ALTER TABLE `ami`
  ADD CONSTRAINT `ami_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ami_ibfk_2` FOREIGN KEY (`id_ami`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `galerie`
--
ALTER TABLE `galerie`
  ADD CONSTRAINT `galerie_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `galerie_image_liaison`
--
ALTER TABLE `galerie_image_liaison`
  ADD CONSTRAINT `galerie_image_liaison_ibfk_1` FOREIGN KEY (`id_galerie`) REFERENCES `galerie` (`id_galerie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `galerie_image_liaison_ibfk_2` FOREIGN KEY (`id_image`) REFERENCES `image` (`id_image`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
