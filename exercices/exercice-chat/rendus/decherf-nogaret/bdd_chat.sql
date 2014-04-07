-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 23 Mars 2014 à 23:19
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `bdd_chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(60) NOT NULL,
  `message` varchar(140) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `pseudo`, `message`, `date`) VALUES
(1, 'Bardamu', 'Je viens de m''engager.', 78),
(2, 'Vendredi', 'T ou rob1son useh ?', 90),
(101, 'le chat', 'Salut!', 0),
(102, 'le chat', ' Chat va bien?', 0),
(103, 'Boris', 'ok', 0);
