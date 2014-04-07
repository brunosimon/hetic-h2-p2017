-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 21 Mars 2014 à 22:14
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `tchat2`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `message`, `date`) VALUES
(1, 2, 'Bonjour', '2014-03-20 13:57:17'),
(2, 3, 'coucou', '2014-03-20 13:57:56'),
(3, 5, 'coucou', '2014-03-20 15:16:22'),
(4, 7, 'Bonsoir', '2014-03-20 15:26:54'),
(5, 11, 'coucou', '2014-03-20 15:44:09'),
(6, 5, ':)', '2014-03-20 16:11:07'),
(7, 11, 'coucou', '2014-03-20 16:24:06'),
(8, 11, 'kikoo', '2014-03-20 16:24:18'),
(9, 11, '<3 love', '2014-03-20 16:24:33'),
(10, 5, '', '2014-03-20 16:29:08'),
(11, 5, '', '2014-03-20 16:53:44'),
(12, 5, '', '2014-03-20 16:53:45'),
(13, 5, '', '2014-03-20 16:53:45'),
(14, 5, '', '2014-03-20 16:53:45'),
(15, 5, 'g', '2014-03-20 16:55:39'),
(16, 5, 'lol', '2014-03-21 15:42:18'),
(17, 5, 'test', '2014-03-21 18:11:38'),
(18, 15, 'lol', '2014-03-21 18:11:49'),
(19, 17, 'lol', '2014-03-21 18:17:05'),
(20, 17, 'looool', '2014-03-21 18:17:14'),
(21, 17, 'looool', '2014-03-21 18:17:16'),
(22, 17, 'looool', '2014-03-21 18:17:17'),
(23, 17, 'lol', '2014-03-21 18:17:18'),
(24, 17, 'lol', '2014-03-21 18:17:19'),
(25, 17, 'l', '2014-03-21 18:17:19'),
(26, 17, 'l', '2014-03-21 18:17:19'),
(27, 17, 'l', '2014-03-21 18:17:19'),
(28, 17, 'l', '2014-03-21 18:17:20'),
(29, 17, 'l', '2014-03-21 18:17:20'),
(30, 17, 'l', '2014-03-21 18:17:20');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `color` varchar(10) NOT NULL,
  `ban` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `sexe`, `color`, `ban`) VALUES
(1, 'ClÃ©ment', '', 'garcon', '5822b6', 0),
(2, 'ClÃ©ment', '', 'garcon', '2fedac', 0),
(3, 'Anna', '', 'fille', '6993e0', 0),
(4, 'Clément', '5ed25af7b1ed23fb00122e13d7f74c4d8262acd8', 'garcon', '28c944', 0),
(5, 'coucou', '5ed25af7b1ed23fb00122e13d7f74c4d8262acd8', 'fille', 'f717c0', 0),
(6, 'Solène', '5ed25af7b1ed23fb00122e13d7f74c4d8262acd8', 'fille', '978c2a', 0),
(7, 'SolÃ¨ne', '5ed25af7b1ed23fb00122e13d7f74c4d8262acd8', 'fille', 'ccbd2e', 0),
(8, 'ddsd', '5ed25af7b1ed23fb00122e13d7f74c4d8262acd8', 'garcon', 'c4a932', 0),
(9, 'coucou', '5ed25af7b1ed23fb00122e13d7f74c4d8262acd8', '', 'b49f4d', 0),
(10, 'coucou', '5ed25af7b1ed23fb00122e13d7f74c4d8262acd8', 'garcon', 'e72b50', 0),
(11, 'moi', '5ed25af7b1ed23fb00122e13d7f74c4d8262acd8', 'fille', '8e4efc', 0);
