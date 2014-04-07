-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 23 Mars 2014 à 16:06
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
  `room_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `message`, `date`, `room_id`) VALUES
(56, 18, 'hetic, l''Ã©cole du web', '2014-03-23 14:50:00', 13),
(57, 18, 'Qui aime la peinture ?', '2014-03-23 14:50:11', 12),
(58, 18, 'Ce chat est vraiment super !', '2014-03-23 15:03:22', 1),
(59, 18, 'Qui a un son sympa Ã  Ã©couter ?', '2014-03-23 15:03:47', 2),
(60, 18, 'Vous jouez Ã  quoi en ce moment ?', '2014-03-23 15:04:00', 3),
(61, 18, 'Qui voudrait voir le film "HER" ?', '2014-03-23 15:04:19', 14),
(62, 22, 'Je suis d''accord !', '2014-03-23 15:04:32', 1),
(63, 23, 'Au top', '2014-03-23 15:05:25', 1);

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`) VALUES
(1, 'Salon principal'),
(2, 'Salon Musique'),
(3, 'Salon Jeux videos'),
(12, 'Salon Arts'),
(13, 'Salon Hetic'),
(14, 'Salon Cinema');

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
  `role` varchar(255) NOT NULL,
  `ban` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `sexe`, `color`, `role`, `ban`) VALUES
(18, 'coucou', '5ed25af7b1ed23fb00122e13d7f74c4d8262acd8', 'garcon', '9b59b6', 'admin', 0),
(19, 'blabla', 'bb21158c733229347bd4e681891e213d94c685be', 'fille', '3498db', 'user', 1),
(20, 'heloise', '5e2b2984716ecf384b0bf6d26cf6053ff10740f3', 'fille', '9b59b6', 'user', 0),
(21, 'coucou', '5ed25af7b1ed23fb00122e13d7f74c4d8262acd8', 'fille', '9b59b6', 'user', 0),
(22, 'helo', 'c6efaf27673db4f7d2de52c0ab20a0655112cbad', 'fille', 'f39c12', 'user', 0),
(23, 'hey', '7f550a9f4c44173a37664d938f1355f0f92a47a7', 'fille', 'e74c3c', 'user', 0);
