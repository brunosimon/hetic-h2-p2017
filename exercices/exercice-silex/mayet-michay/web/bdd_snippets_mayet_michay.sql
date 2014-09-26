-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 05 Juin 2014 à 21:51
-- Version du serveur :  5.5.24-log
-- Version de PHP :  5.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `h2_silex`
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
(1, 'javascript', 'Javascript'),
(2, 'php', 'PHP'),
(3, 'html', 'HTML'),
(4, 'css', 'CSS');

-- --------------------------------------------------------

--
-- Structure de la table `mails`
--

CREATE TABLE IF NOT EXISTS `mails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `from_who` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `mails`
--

INSERT INTO `mails` (`id`, `subject`, `from_who`, `content`) VALUES
(1, 'zea', 'eza@eza.com', 'This is a test');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

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
(9, 2, 'PDO prepare', 'Contenu snippet 9'),
(10, 1, 'Alert', 'alert("Coucou");'),
(11, 3, 'Doctype', '<!DOCTYPE html>\r\n<html lang="fr">\r\n<head>\r\n	<meta charset="UTF-8">\r\n	<title>Document</title>\r\n	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->\r\n	<link rel="stylesheet" href="style.css" media="all" type="text/css" />\r\n</head>\r\n \r\n<body>\r\n	\r\n	<script type="text/javascript" src=""></script>\r\n</body>\r\n</html>'),
(12, 1, 'Test', 'Super code'),
(13, 1, 'Test encore une fois', 'Super code'),
(14, 1, 'One more time', 'Super code'),
(15, 1, 'Let it be', 'Super code'),
(16, 3, 'Hello, Goodbye', 'Super code');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `pseudo`, `password`) VALUES
(8, 'aina.mayet@laposte.net', 'Aina', '68effd4c17b70eb2db9a650285272efb3ccc9711cabfe9c3ba387d5d7e91a057');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
