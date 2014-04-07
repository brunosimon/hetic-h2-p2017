-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 23 Mars 2014 à 14:12
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

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `id_user` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `message`, `id_user`) VALUES
(354, 'salut', 'Array'),
(355, 'Bonjour Ã   tous !', 'Array'),
(357, 'salut !', 'Array');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(4, 'alex2', 'bannedForLife!@!'),
(8, 'bla', 'd909785fa88f53725253a830029e196fcd918b41e9e5517e524bbcf2030f1e94'),
(11, 'aze', 'a06abf720eeebc5430447f99bbb8f0819b1ef9d3ded1f2006af0298c9d9a157f'),
(12, 'alllllllaaiiinnn', '46ac741d14be57464e77bfe563008a87c30b65129c8df3c6dfaa9f26be121b1e'),
(16, 'jy', '5edb24884d052fa728877a574e4bf75526dc877e1d9f103059f5f702ba7e2e43'),
(17, 'zri', 'b2512477ef3650df6ba065bcfbd9687e40a643e1c60e7ed8e67af6031372b143'),
(18, 'alex', '1bcf481156df8819daa7a75ff04dc4a858f25e1c85a369603abe3e30626ae711'),
(19, 'a', 'a334d36120e3bc13b2e689989adfcfbcabb2ccfd41722c4f77f30af73601cc40'),
(20, 'alain', 'bb631a2a9d79c012cb6955599614e37d2819dccbc43f4ed71c21d9a15f99c903');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
