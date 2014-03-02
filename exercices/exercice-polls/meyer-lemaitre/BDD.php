-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 10 Février 2014 à 00:16
-- Version du serveur: 5.5.33
-- Version de PHP: 5.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `tpsondage`
--

-- --------------------------------------------------------

--
-- Structure de la table `sondageseries`
--

CREATE TABLE `sondageseries` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `type_drama` varchar(100) NOT NULL,
  `type_action` varchar(100) NOT NULL,
  `type_sciencefiction` varchar(100) NOT NULL,
  `type_comedy` varchar(100) NOT NULL,
  `type_fantastic` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=114 ;

--
-- Contenu de la table `sondageseries`
--

INSERT INTO `sondageseries` (`ID`, `user`, `type_drama`, `type_action`, `type_sciencefiction`, `type_comedy`, `type_fantastic`) VALUES
(112, 'Lemaitre Pierre-Antoine ', 'breaking bad', 'spartacus', 'misfit', 'south park', 'game of thrones'),
(113, 'Meyer Remy', 'breaking bad', 'arrow', 'under the dome', 'how i met your mother', 'game of thrones');
