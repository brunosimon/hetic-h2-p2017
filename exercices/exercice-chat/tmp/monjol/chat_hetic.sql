-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 19 Mars 2014 à 19:40
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `chat_hetic`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `message`, `id_user`) VALUES
(45, 'aleeeeeeeeeeeeeeex', 0),
(46, 'eza', 0),
(47, 'za', 0),
(48, 'za', 0),
(49, 'eza', 0),
(50, 'eaz', 0),
(51, 'ezaea', 0),
(52, 'eza', 0),
(53, 'allain', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(4, 'alex2', '9adfb0a6d03beb7141d8ec2708d6d9fef9259d12cd230d50f70fb221ae6cabd5'),
(5, 'alexx', '6a43a418ad0ab1a9010936cb1d7f2d0b4e34542b9e7b82218cd0008ffa7851b2'),
(6, 'aleex', '21493b65d9e3724226507498358610869bd614f660f58478928f57437b8d76cb'),
(7, 'aleex', '351dd7dd0d1f3166b527b0cc524560b10eb1fdb6a444baa1c37e393eea9ea669'),
(8, 'bla', 'd909785fa88f53725253a830029e196fcd918b41e9e5517e524bbcf2030f1e94'),
(9, 'aze', 'a06abf720eeebc5430447f99bbb8f0819b1ef9d3ded1f2006af0298c9d9a157f'),
(10, 'aze', 'a06abf720eeebc5430447f99bbb8f0819b1ef9d3ded1f2006af0298c9d9a157f'),
(11, 'aze', 'a06abf720eeebc5430447f99bbb8f0819b1ef9d3ded1f2006af0298c9d9a157f'),
(12, 'alllllllaaiiinnn', '46ac741d14be57464e77bfe563008a87c30b65129c8df3c6dfaa9f26be121b1e'),
(13, 'alex', '1bcf481156df8819daa7a75ff04dc4a858f25e1c85a369603abe3e30626ae711');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
