-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 09 juil. 2023 à 12:25
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
  `name` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` text NOT NULL,
  `password` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '$2y$10$fCfMZkR58STvPZ3u8Ynx8.kWGYKGDrhvW1c07cdtNoUSByV17Cg/6');

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
-- Structure de la table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `username` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `password` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `email` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`id`, `name`, `username`, `password`, `email`) VALUES
(2, 'Voyer', 'Avoyer75', '$2y$10$fCfMZkR58STvPZ3u8Ynx8.kWGYKGDrhvW1c07cdtNoUSByV17Cg/6', 'voyer@email.com'),
(3, 'Burban', 'Cburban92', '$2y$10$fCfMZkR58STvPZ3u8Ynx8.kWGYKGDrhvW1c07cdtNoUSByV17Cg/6', 'burban@email.com'),
(4, 'Agez', 'fAgez03', '$2y$10$fCfMZkR58STvPZ3u8Ynx8.kWGYKGDrhvW1c07cdtNoUSByV17Cg/6', 'agez@email.com'),
(5, 'Dupont ', 'dupont', '$2y$10$fCfMZkR58STvPZ3u8Ynx8.kWGYKGDrhvW1c07cdtNoUSByV17Cg/6', 'dupont@gmail.com'),
(6, 'Perrier ', 'perrier13', '$2y$10$fCfMZkR58STvPZ3u8Ynx8.kWGYKGDrhvW1c07cdtNoUSByV17Cg/6', 'perrier@email.com');

-- --------------------------------------------------------

--
-- Structure de la table `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `seller`
--

INSERT INTO `seller` (`id`, `name`, `username`, `email`, `password`) VALUES
(2, 'Singh', 'SINGH', 'bavandeep45@gmail.com', '$2y$10$fCfMZkR58STvPZ3u8Ynx8.kWGYKGDrhvW1c07cdtNoU'),
(3, 'Seller', 'seller', 'seller@gmail.com', '$2y$10$fCfMZkR58STvPZ3u8Ynx8.kWGYKGDrhvW1c07cdtNoU');

-- --------------------------------------------------------

--
-- Structure de la table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE IF NOT EXISTS `vehicle` (
  `ref` int NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `type` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `caract` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `details` text,
  `state` tinyint(1) DEFAULT '0',
  `img` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `prixM` double NOT NULL,
  `idL` int NOT NULL DEFAULT '1',
  `idC` int DEFAULT NULL,
  PRIMARY KEY (`ref`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vehicle`
--

INSERT INTO `vehicle` (`ref`, `name`, `type`, `caract`, `details`, `state`, `img`, `prixM`, `idL`, `idC`) VALUES
(1, 'BMW X5', 'Diesel', 'Number of seats: 5,\r\nGearbox: automatic,\r\nEngine: 3.0d381', 'The BMW W5 in our medium category is a family car with excellent comfort and reliability.', 1, 'BMW X5 (moyen).png', 449.99, 1, 5),
(2, 'Ferrari 488', 'Diesel', 'Number of seats: 2,\r\nGearbox: manual,\r\nEngine: V8', 'The Ferrari 488 in our luxury category is a very fast sports car with excellent handling.', 0, 'Ferrari-488 (luxe).png', 2499.99, 1, 2),
(3, 'Dacia Duster', 'Diesel', 'Number of seats: 5\r\nGearbox: automatic\r\nEngine: 3.0d381', 'The Dacia Duster in our medium category is a family car with excellent comfort and reliability.', 1, 'dacia duster (low coast).png', 399.99, 1, 13),
(4, 'Fiat Multipla', 'DIesel', 'Number of seats: 6\r\nGearbox: manual\r\nEngine: 1.6 16v', 'The Fiat Multipla belonging to our low coast category is a car adapted to small budgets allowing to make daily journeys.', 0, 'Fiat Multipla (low coast).png', 249.99, 1, 3),
(5, 'Lamborghini Gallardo', 'Diesel', 'Number of places: 2\r\nGearbox: manual\r\nEngine: V10', 'The Lamborghini Gallardo in our luxury category is a very fast sports car with excellent handling.', 1, 'lamborghini gallardo (luxe).png', 2699.99, 1, 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
