-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 24 Mars 2014 à 15:11
-- Version du serveur: 5.5.33
-- Version de PHP: 5.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `tp-chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(60) NOT NULL,
  `message` varchar(255) NOT NULL,
  `room` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `pseudo`, `message`, `room`, `date`) VALUES
(4, 'Benjamin', 'Hi ! Can someone help me with PHP ? :)', 4, '2014-03-24 15:09:58'),
(5, 'Remy', 'Sure ! What is your problem ? 8)', 4, '2014-03-24 15:10:26');

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `rooms`
--

INSERT INTO `rooms` (`id`, `creator`, `name`, `date`) VALUES
(1, 'Remy', 'Gaming', '2014-03-24 15:06:38'),
(2, 'Remy', 'Movies', '2014-03-24 15:06:47'),
(3, 'Remy', 'TV SHOWS', '2014-03-24 15:06:53'),
(4, 'Benjamin', 'coding', '2014-03-24 15:07:24');
