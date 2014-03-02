-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 09 Février 2014 à 20:02
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `td-trimestre2`
--

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=236 ;

--
-- Contenu de la table `votes`
--

INSERT INTO `votes` (`id`, `name`) VALUES
(44, 'Tropfacile'),
(50, 'Tropdifficile'),
(78, 'Tropdifficile'),
(79, 'Tropdifficile'),
(166, 'Tropfacile'),
(167, 'Tropfacile'),
(172, 'Tropfacile'),
(173, 'Tropfacile'),
(182, 'Tropfacile'),
(183, 'Tropfacile'),
(188, 'Parfait'),
(189, 'Parfait'),
(190, 'tresinteressant'),
(191, 'tresinteressant'),
(192, 'Pasassezinteressant'),
(193, 'Pasassezinteressant'),
(194, 'Pasdutoutinteressant'),
(195, 'Pasdutoutinteressant'),
(196, 'Facile'),
(197, 'Facile'),
(198, 'Tropfacile'),
(199, 'Tropfacile'),
(200, 'Difficile'),
(201, 'Difficile'),
(202, 'Tropdifficile'),
(203, 'Tropdifficile'),
(204, 'Parfait'),
(205, 'Parfait'),
(206, 'Interessant'),
(207, 'Interessant'),
(208, 'Interessant'),
(209, 'Interessant'),
(210, 'Interessant'),
(211, 'Interessant'),
(212, 'tresinteressant'),
(213, 'tresinteressant'),
(214, 'Parfait'),
(215, 'Parfait'),
(216, 'Tropdifficile'),
(217, 'Tropdifficile'),
(218, 'Difficile'),
(219, 'Difficile'),
(220, 'Pasdutoutinteressant'),
(221, 'Pasdutoutinteressant'),
(222, 'Parfait'),
(223, 'Parfait'),
(224, 'Parfait'),
(225, 'Parfait'),
(226, 'Facile'),
(227, 'Facile'),
(228, 'tresinteressant'),
(229, 'tresinteressant'),
(230, 'Tropdifficile'),
(231, 'Tropdifficile'),
(232, 'Interessant'),
(233, 'Interessant'),
(234, 'tresinteressant'),
(235, 'tresinteressant');
