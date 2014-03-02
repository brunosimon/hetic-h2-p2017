-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le : Lun 10 Février 2014 à 00:30
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `hetic_survey`
--

-- --------------------------------------------------------

--
-- Structure de la table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `sex` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `home` text NOT NULL,
  `postal_code` text NOT NULL,
  `study` int(11) NOT NULL,
  `work` int(11) NOT NULL,
  `stud_wh` int(11) NOT NULL,
  `place` int(11) NOT NULL,
  `stud_place` int(11) NOT NULL,
  `stud_work` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Contenu de la table `results`
--

INSERT INTO `results` (`id`, `first_name`, `last_name`, `sex`, `age`, `home`, `postal_code`, `study`, `work`, `stud_wh`, `place`, `stud_place`, `stud_work`) VALUES
(26, 'Elena', 'dmcq', 0, 19, '1', 'dtc', 0, 0, 0, 0, 0, 0),
(27, 'Elena', 'dmcq', 0, 19, '1', 'dtc', 0, 0, 0, 0, 0, 0),
(28, 'jacob', 'dod', 1, 18, '1', '30600', 1, 0, 1, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
