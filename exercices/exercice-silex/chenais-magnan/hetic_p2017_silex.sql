-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 06 Juin 2014 à 10:49
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `hetic_p2017_silex`
--

-- --------------------------------------------------------

--
-- Structure de la table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `url` varchar(254) NOT NULL,
  `description` varchar(254) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `id_category`, `url`, `description`) VALUES
(1, 2, 'https://gist.github.com/michaelcullum/6321332', 'Site inspirant'),
(2, 2, 'https://gist.github.com/michaelcullum/6321332', 'Contenu bookmark 2'),
(3, 3, 'https://gist.github.com/michaelcullum/6321332', 'Contenu bookmark 3'),
(4, 4, 'https://gist.github.com/michaelcullum/6321332', 'Contenu bookmark 4'),
(5, 4, 'https://gist.github.com/michaelcullum/6321332', 'Contenu bookmark 5'),
(6, 1, 'https://gist.github.com/michaelcullum/6321332', 'Contenu bookmark 6'),
(7, 1, 'https://gist.github.com/michaelcullum/6321332', 'Contenu bookmark 7'),
(8, 3, 'https://gist.github.com/michaelcullum/6321332', 'Contenu bookmark 8'),
(9, 2, 'https://gist.github.com/michaelcullum/6321332', 'Contenu bookmark 9');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(254) NOT NULL,
  `title` varchar(254) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`) VALUES
(1, 'web', 'Web'),
(2, 'inspiration', 'Inspiration'),
(3, 'icons', 'Icons'),
(4, 'typography', 'Typography'),
(5, 'parallax', 'Parallax'),
(6, 'css', 'CSS'),
(7, 'dev', 'Dev'),
(8, 'config', 'Config'),
(9, 'template', 'Template'),
(10, 'animationcss3', 'Animation CSS3'),
(11, 'motion', 'Motion'),
(12, 'ted', 'TED'),
(13, 'geolocation', 'Geolocation'),
(14, 'api', 'API'),
(15, 'streetart', 'Street Art'),
(16, 'medium', 'Medium'),
(17, 'music', 'Music'),
(18, 'documents', 'Documents');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
