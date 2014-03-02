-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 28 Février 2014 à 21:19
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `poll`
--

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `cathegorie` varchar(50) NOT NULL,
  `fruit` varchar(50) NOT NULL,
  `texture` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- Contenu de la table `votes`
--

INSERT INTO `votes` (`id`, `cathegorie`, `fruit`, `texture`) VALUES
(39, 'sucre', 'abricot', 'craquant'),
(40, 'acidule', 'abricot', 'fondant'),
(41, 'sucre', 'cerise', 'craquant'),
(42, 'sucre', 'cerise', 'craquant'),
(43, 'sucre', 'cerise', 'craquant'),
(44, 'acidule', 'pistache', 'craquant'),
(45, 'acidule', 'pistache', 'fondant'),
(46, 'acidule', 'pistache', 'fondant'),
(47, 'acidule', 'pistache', 'fondant'),
(48, 'acidule', 'pistache', 'fondant'),
(49, 'acidule', 'pistache', 'fondant'),
(50, 'acidule', 'pistache', 'fondant'),
(51, 'acidule', 'pistache', 'fondant'),
(52, 'acidule', 'pistache', 'fondant'),
(53, 'acidule', 'pistache', 'fondant'),
(54, 'acidule', 'pistache', 'fondant'),
(55, 'acidule', 'pistache', 'fondant'),
(56, 'acidule', 'pistache', 'fondant'),
(57, 'acidule', 'pistache', 'fondant'),
(58, 'acidule', 'pistache', 'fondant'),
(59, 'acidule', 'pistache', 'fondant'),
(60, 'acidule', 'pistache', 'fondant'),
(61, 'acidule', 'pistache', 'fondant'),
(62, 'acidule', 'pistache', 'fondant'),
(63, 'acidule', 'pistache', 'fondant'),
(64, 'acidule', 'pistache', 'fondant'),
(65, 'acidule', 'pistache', 'fondant'),
(66, 'acidule', 'pistache', 'fondant'),
(67, 'acidule', 'abricot', 'granuleux'),
(68, 'sucre', 'fraise', 'fondant'),
(69, 'sucre', 'fraise', 'fondant'),
(70, 'sucre', 'banane', 'fondant'),
(71, 'sucre', 'banane', 'petillant');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
