-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 09 Février 2014 à 23:26
-- Version du serveur: 5.5.29
-- Version de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `hetic_P2017_G1`
--

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name1` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name2` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name3` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name4` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name5` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name6` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name7` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name8` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name9` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name10` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `votes`
--

INSERT INTO `votes` (`id`, `name1`, `name2`, `name3`, `name4`, `name5`, `name6`, `name7`, `name8`, `name9`, `name10`) VALUES
(29, '1', '3', '5', '7', '9', '11', '13', '15', '17', '19');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
