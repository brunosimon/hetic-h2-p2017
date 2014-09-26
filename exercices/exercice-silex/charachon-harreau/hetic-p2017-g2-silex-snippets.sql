-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 05 Juin 2014 à 22:06
-- Version du serveur: 5.5.20
-- Version de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `hetic-p2017-g2-silex-snippets`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(254) NOT NULL,
  `title` varchar(254) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`) VALUES
(1, 'rf', 'Reaction Faces'),
(2, 'fail', 'Fail'),
(3, 'weird', 'Weird'),
(4, 'film', 'Film');

-- --------------------------------------------------------

--
-- Structure de la table `snippets`
--

CREATE TABLE IF NOT EXISTS `snippets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `content` text NOT NULL,
  `state` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Contenu de la table `snippets`
--

INSERT INTO `snippets` (`id`, `id_category`, `title`, `content`, `state`) VALUES
(10, 1, 'Amazing Cat', 'http://media.giphy.com/media/wu29mJA7MXBzG/giphy.gif', 1),
(19, 2, 'Akward', 'http://media.giphy.com/media/JtYwwXLRSWvdK/giphy.gif', 1),
(25, 1, 'Cool Stuff', 'http://media.giphy.com/media/L8xqMkrsZdCUM/giphy.gif', 1),
(26, 3, 'Weird kitty', 'http://media3.giphy.com/media/Md4xQfuJeTtx6/giphy.gif', 1),
(27, 4, 'OP GoT', 'http://media3.giphy.com/media/4ylyJ7VFq39Mk/giphy.gif', 1),
(28, 1, 'Girly', 'http://media3.giphy.com/media/mcMNAiDvn9tTO/giphy.gif', 1),
(29, 3, 'I''m BATMAN', 'http://media.giphy.com/media/ITnn2IenMv7SE/giphy.gif', 1),
(30, 2, 'POPOPOWERRANGER', 'http://media.giphy.com/media/HG0afadIZ6cH6/giphy.gif', 1),
(31, 2, 'powerfail', 'http://media.giphy.com/media/YpmVBNubONoqs/giphy.gif', 1),
(32, 1, 'Me when I understand silex', 'http://media.giphy.com/media/QLvRBqfLXCphu/giphy.gif', 1),
(33, 1, 'Me when I have 10 project in a week', 'http://media.giphy.com/media/yTAugkkABvlfO/giphy.gif', 1),
(34, 2, 'After Intencive Week', 'http://media0.giphy.com/media/Ke21zZltvEbFm/giphy.gif', 1),
(35, 4, 'GoT again', 'http://media.giphy.com/media/aN5kVBEd1YH5e/giphy.gif', 1),
(36, 1, 'When I didn''t get my coffee', 'http://media.giphy.com/media/TUtr2Ky56D4Zy/giphy.gif', 1),
(37, 3, 'Hey', 'http://media2.giphy.com/media/c65HDqFZd4m9G/giphy.gif', 0),
(38, 2, 'oups', 'http://media.giphy.com/media/kDmsG1ei4P1Yc/giphy.gif', 0),
(39, 2, 'Carreful !', 'http://media3.giphy.com/media/B1FAKSmfWqRA4/giphy.gif', 0),
(40, 2, 'Cat attack', 'http://media.giphy.com/media/unPIeRU1HZM8E/giphy.gif', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
