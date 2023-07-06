-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 06 juil. 2023 à 13:58
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `project`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `pseudo` text NOT NULL,
  `email` text NOT NULL,
  `mdp` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `pseudo`, `email`, `mdp`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '$6$rounds=5000$anexamplestringf$cganXrEeVcQ.SuZ6zs.ptb5ulJ9chgHT69ENOJ7A9RPikHEFDgs2Yeq1PdeWciEvhGev2fbnL9bxv7H.546rS/');

-- --------------------------------------------------------

--
-- Structure de la table `bill`
--

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ide` int NOT NULL,
  `idv` int NOT NULL,
  `dateD` date NOT NULL,
  `dateF` date NOT NULL,
  `valeur` int NOT NULL,
  `etatR` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bill`
--

INSERT INTO `bill` (`id`, `ide`, `idv`, `dateD`, `dateF`, `valeur`, `etatR`) VALUES
(1, 1, 1, '2021-10-15', '2021-10-15', 1000, 0),
(2, 2, 1, '2021-10-14', '2021-10-14', 1000, 0);

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `adresse` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `company`
--

INSERT INTO `company` (`id`, `nom`, `adresse`) VALUES
(1, 'Etransport', '1 adresse Etransport'),
(2, 'VIPtravel', '2 adresse VIPtravel'),
(3, 'RedDrive', '3 adresse RedDrive'),
(4, 'SunMusic', '4 adresse SunMusic'),
(5, 'Toyota', '5 adresse Toyota');

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `pseudo` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `mdp` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `email` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `idE` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`id`, `nom`, `pseudo`, `mdp`, `email`, `idE`) VALUES
(2, 'Voyer', 'Avoyer75', '$6$rounds=5000$anexamplestringf$cganXrEeVcQ.SuZ6zs.ptb5ulJ9chgHT69ENOJ7A9RPikHEFDgs2Yeq1PdeWciEvhGev2fbnL9bxv7H.546rS/', 'voyer@email.com', 2),
(3, 'Burban', 'Cburban92', '$6$rounds=5000$anexamplestringf$cganXrEeVcQ.SuZ6zs.ptb5ulJ9chgHT69ENOJ7A9RPikHEFDgs2Yeq1PdeWciEvhGev2fbnL9bxv7H.546rS/', 'burban@email.com', 3),
(4, 'Agez', 'fAgez03', '$6$rounds=5000$anexamplestringf$cganXrEeVcQ.SuZ6zs.ptb5ulJ9chgHT69ENOJ7A9RPikHEFDgs2Yeq1PdeWciEvhGev2fbnL9bxv7H.546rS/', 'agez@email.com', 1),
(5, 'Dupont ', 'dupont', '$6$rounds=5000$anexamplestringf$cganXrEeVcQ.SuZ6zs.ptb5ulJ9chgHT69ENOJ7A9RPikHEFDgs2Yeq1PdeWciEvhGev2fbnL9bxv7H.546rS/', 'dupont@gmail.com', 1),
(6, 'Perrier ', 'perrier13', '$6$rounds=5000$anexamplestringf$cganXrEeVcQ.SuZ6zs.ptb5ulJ9chgHT69ENOJ7A9RPikHEFDgs2Yeq1PdeWciEvhGev2fbnL9bxv7H.546rS/', 'perrier@email.com', 4),
(13, 'Durant', 'durant', '$6$rounds=5000$anexamplestringf$cganXrEeVcQ.SuZ6zs.ptb5ulJ9chgHT69ENOJ7A9RPikHEFDgs2Yeq1PdeWciEvhGev2fbnL9bxv7H.546rS/', 'durant@gmail.com', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE IF NOT EXISTS `vehicle` (
  `ref` int NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `type` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `caract` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `details` text,
  `state` tinyint(1) DEFAULT '0',
  `img` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `prixJ` double NOT NULL,
  `prixM` double NOT NULL,
  `debutL` date DEFAULT NULL,
  `finL` date DEFAULT NULL,
  `idL` int NOT NULL DEFAULT '1',
  `idC` int DEFAULT NULL,
  PRIMARY KEY (`ref`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vehicle`
--

INSERT INTO `vehicle` (`ref`, `nom`, `type`, `caract`, `details`, `state`, `img`, `prixJ`, `prixM`, `debutL`, `finL`, `idL`, `idC`) VALUES
(3, 'Dacia Duster', 'Diesel', 'Nombre de places : 5\nBoîte de vitesse : automatique\nMoteur : 3.0d381', 'La Dacia Duster faisant partie de notre catégorie moyenne est une voiture familiale avec un confort et une fiabilité excellente.', 1, 'dacia duster (low coast).png', 14.99, 399.99, NULL, NULL, 1, 13),
(4, 'Fiat Multipla', 'DIesel', 'Nombre de places : 6\nBoîte de vitesse : manuelle\nMoteur : 1.6 16v', 'La Fiat Multipla faisant partie de notre catégorie low coast est une voiture adaptée aux petits budgets permettant de faire des trajets quotidiens.', 0, 'Fiat Multipla (low coast).png', 9.99, 249.99, NULL, NULL, 1, 3),
(5, 'Lamborghini Gallardo', 'Diesel', 'Nombre de place : 2\nBoîte de vitesse : manuelle\nMoteur : V10', 'La Lamborghini Gallardo faisant partie de notre catégorie luxe est une voiture de sport très rapide avec une excellente tenue de route.', 1, 'lamborghini gallardo (luxe).png', 99.99, 2699.99, NULL, NULL, 1, 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
