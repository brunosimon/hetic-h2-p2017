-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Dim 23 Mars 2014 à 17:51
-- Version du serveur :  5.5.34
-- Version de PHP :  5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `tchat_1`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(60) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `pseudo`, `message`, `date`) VALUES
(82, 'Sylvain Houcke', 'Bonjour Valentin', 1395593038),
(83, 'Valentin David', 'Bonjour Sylvain, tu vas bien ?', 1395593055),
(84, 'Sylvain Houcke', 'TrÃ¨s bien merci !', 1395593078);
