-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 09 Février 2014 à 16:48
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `hetic-p2017-g2-devoir-sondage`
--

-- --------------------------------------------------------

--
-- Structure de la table `cinq`
--

CREATE TABLE `cinq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `livre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Contenu de la table `cinq`
--

INSERT INTO `cinq` (`id`, `livre`) VALUES
(1, 'bd'),
(30, 'magasine'),
(31, 'magasine'),
(32, 'magasine'),
(33, 'magasine'),
(34, 'magasine'),
(35, 'magasine'),
(36, 'magasine'),
(37, 'magasine'),
(38, 'magasine'),
(39, 'roman'),
(40, 'roman'),
(41, 'roman'),
(42, 'roman'),
(43, 'bd'),
(44, 'bd'),
(45, 'bd'),
(46, 'bd'),
(47, 'bd'),
(48, 'bd'),
(49, 'bd'),
(50, 'bd');

-- --------------------------------------------------------

--
-- Structure de la table `deux`
--

CREATE TABLE `deux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 ;

--
-- Contenu de la table `deux`
--

INSERT INTO `deux` (`id`, `nombre`) VALUES
(51, '5'),
(52, '5'),
(53, '4'),
(54, '4'),
(55, '4'),
(56, '4'),
(57, '4'),
(80, '2'),
(81, '5');

-- --------------------------------------------------------

--
-- Structure de la table `quatre`
--

CREATE TABLE `quatre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `occupation` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Contenu de la table `quatre`
--

INSERT INTO `quatre` (`id`, `occupation`) VALUES
(1, 'lecture'),
(2, 'lecture'),
(3, 'lecture'),
(4, 'lecture'),
(5, 'lecture'),
(6, 'dodo'),
(7, 'dodo'),
(8, 'dodo'),
(9, 'dodo'),
(10, 'nothing'),
(86, 'musique'),
(87, 'lecture'),
(88, 'musique'),
(89, 'jeux'),
(90, 'nothing'),
(91, 'lecture'),
(92, 'lecture'),
(93, 'musique'),
(94, 'jeux'),
(95, 'nothing'),
(96, 'lecture'),
(97, 'musique'),
(98, 'jeux'),
(99, 'nothing'),
(100, 'lecture');

-- --------------------------------------------------------

--
-- Structure de la table `sept`
--

CREATE TABLE `sept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `sept`
--

INSERT INTO `sept` (`id`, `game`) VALUES
(1, 'imgmots'),
(2, 'imgmots'),
(3, 'imgmots'),
(4, 'imgmots'),
(5, 'imgmots'),
(6, 'imgmots'),
(7, 'imgmots'),
(8, 'autre'),
(9, 'candy'),
(10, 'autre'),
(11, 'temple'),
(12, 'autre');

-- --------------------------------------------------------

--
-- Structure de la table `six`
--

CREATE TABLE `six` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `musique` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `six`
--

INSERT INTO `six` (`id`, `musique`) VALUES
(1, 'rap'),
(2, 'rock'),
(3, 'electro'),
(4, 'variete'),
(5, 'variete'),
(6, 'latine'),
(7, 'latine'),
(8, 'latine'),
(9, 'variete'),
(10, 'variete');

-- --------------------------------------------------------

--
-- Structure de la table `trois`
--

CREATE TABLE `trois` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heure` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Contenu de la table `trois`
--

INSERT INTO `trois` (`id`, `heure`) VALUES
(40, '2h30'),
(68, '2h30'),
(69, '2h'),
(70, '2h'),
(71, '1h30'),
(72, '2h'),
(73, '2h30'),
(74, '2h30'),
(75, 'plus2h30'),
(76, '2h30'),
(77, '2h30'),
(78, '2h30'),
(79, '1h30'),
(80, '2h30'),
(81, '2h'),
(82, '2h'),
(83, '1h30'),
(84, '1h30'),
(85, '1h30'),
(86, '-1h'),
(87, '1h30'),
(88, '1h30'),
(89, '1h30'),
(90, '1h'),
(91, '2h'),
(92, '1h30'),
(93, 'plus2h30'),
(94, '-1h'),
(95, '1h30'),
(96, '-1h'),
(97, '1h'),
(98, '1h'),
(99, '1h'),
(100, '1h');

-- --------------------------------------------------------

--
-- Structure de la table `un`
--

CREATE TABLE `un` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bool` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=111 ;

--
-- Contenu de la table `un`
--

INSERT INTO `un` (`id`, `bool`) VALUES
(26, 'non'),
(27, 'oui'),
(28, 'oui'),
(29, 'oui'),
(30, 'oui'),
(31, 'oui'),
(32, 'oui'),
(80, 'oui'),
(103, 'oui'),
(104, 'oui'),
(105, 'oui'),
(106, 'non'),
(107, 'oui'),
(108, 'oui'),
(109, 'non'),
(110, 'oui');
