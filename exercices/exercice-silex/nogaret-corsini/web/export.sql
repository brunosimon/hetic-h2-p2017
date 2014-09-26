-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 05 Juin 2014 à 23:27
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `silex`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`) VALUES
(1, 'javascript', 'javascript'),
(2, 'php', 'php'),
(3, 'html', 'html'),
(4, 'css', 'css');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`) VALUES
(1, 'jeanl', 'jean', 'jeanluc'),
(2, 'jeancharles', 'jeancharles@jeancharles.com', 'jeancharles'),
(3, 'dede', 'dede@gmail.com', 'de'),
(4, 'je', 'jeje@oijdile.ocm', 'keiosd');

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
