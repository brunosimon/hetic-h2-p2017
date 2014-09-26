-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 05 Juin 2014 à 10:46
-- Version du serveur: 5.5.33
-- Version de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `hetic_silex_snippets`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(254) NOT NULL,
  `title` varchar(254) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`) VALUES
(1, 'javascript', 'Javascript'),
(2, 'php', 'PHP'),
(3, 'html', 'HTML'),
(4, 'css', 'CSS');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`) VALUES
(5, '', 'clem.delaunay@gmail.com', '', ''),
(6, 'dsd', 'clem.delaunay@gmail.com', 'dsd', 'dsd'),
(7, 'dsd', 'clem.delaunay@gmail.com', 'dsd', 'dsd'),
(8, 'dsd', 'clem.delaunay@gmail.com', 'dsd', 'dsd'),
(9, 'dsd', 'clem.delaunay@gmail.com', 'dsd', 'cxcxc'),
(10, 'dsd', 'clem.delaunay@gmail.com', 'dsd', 'cxcxc'),
(11, 'dsd', 'clem.delaunay@gmail.com', 'dsd', 'dsd');

-- --------------------------------------------------------

--
-- Structure de la table `snippets`
--

CREATE TABLE `snippets` (
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
(3, 3, 'Template HTML5', 'Contenu snippet 3'),
(4, 4, 'Animation CSS3', 'Contenu snippet 4'),
(5, 4, 'Transition CSS3', 'Contenu snippet 5'),
(6, 1, 'Timeout / Interval', 'Contenu snippet 6'),
(7, 1, 'Geolocation', 'Contenu snippet 7'),
(8, 3, 'Audio / Video', 'Contenu snippet 8'),
(9, 2, 'PDO prepare', 'Contenu snippet 9');