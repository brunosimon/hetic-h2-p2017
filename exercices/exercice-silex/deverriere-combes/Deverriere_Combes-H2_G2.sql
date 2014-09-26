-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 05 Juin 2014 à 21:29
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `hetic-p2017-g2-silex-snippets`
--
CREATE DATABASE IF NOT EXISTS `hetic-p2017-g2-silex-snippets` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `hetic-p2017-g2-silex-snippets`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(254) NOT NULL,
  `title` varchar(254) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`) VALUES
(1, 'javascript', 'Javascript'),
(2, 'php', 'PHP'),
(4, 'html', 'HTML'),
(5, 'css', 'CSS');

-- --------------------------------------------------------

--
-- Structure de la table `snippets`
--

CREATE TABLE IF NOT EXISTS `snippets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `snippets`
--

INSERT INTO `snippets` (`id`, `id_category`, `title`, `content`) VALUES
(1, 2, 'Class PHP', 'Contenu snippet 1'),
(2, 2, 'Config', 'Contenu snippet 2'),
(3, 5, 'Template HTML5', 'Contenu snippet 3'),
(4, 4, 'Animation CSS3', 'Contenu snippet 4'),
(5, 4, 'Transition CSS3', 'Contenu snippet 5'),
(6, 1, 'Timeout / Interval', 'Contenu snippet 6'),
(7, 1, 'Geolocation', 'Contenu snippet 7'),
(8, 5, 'Audio / Video', 'Contenu snippet 8'),
(9, 2, 'PDO prepare', 'Contenu snippet 9');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
