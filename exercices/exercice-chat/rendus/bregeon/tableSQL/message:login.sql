-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 23 Mars 2014 à 21:41
-- Version du serveur: 5.5.33
-- Version de PHP: 5.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `tchat`
--

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `mdp` varchar(255) CHARACTER SET latin1 NOT NULL,
  `sexe` varchar(10) CHARACTER SET latin1 NOT NULL,
  `ip` text CHARACTER SET latin1 NOT NULL,
  `connecter` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `bani` int(11) NOT NULL,
  `mp` int(11) NOT NULL,
  `blockmp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `login`
--

INSERT INTO `login` (`id`, `pseudo`, `mdp`, `sexe`, `ip`, `connecter`, `admin`, `bani`, `mp`, `blockmp`) VALUES
(1, 'robot', 'admin', '', '::1', 1, 1, 0, 0, 0),
(2, 'admin', 'admin', '', '::1', 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` mediumtext NOT NULL,
  `message` text NOT NULL,
  `priver` int(11) NOT NULL,
  `recepteur` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
