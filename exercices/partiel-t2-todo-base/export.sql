-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 30 Mars 2014 à 18:58
-- Version du serveur: 5.5.25
-- Version de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `hetic-p2017-partiel-t2-todo`
--

-- --------------------------------------------------------

--
-- Structure de la table `todos`
--

CREATE TABLE `todos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  `done` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `todos`
--

INSERT INTO `todos` (`id`, `text`, `done`) VALUES
(13, 'RÃ©pondre aux questions', 1),
(14, 'Terminer l''intÃ©gration', 1),
(15, 'Terminer le PHP', 0),
(17, 'Rendre le partiel', 0),
(21, 'FÃªter la fin des partiels', 0);
