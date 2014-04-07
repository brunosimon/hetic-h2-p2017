-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 23 Mars 2014 à 23:11
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `tchat`
--

-- --------------------------------------------------------

--
-- Structure de la table `connected`
--

CREATE TABLE `connected` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(60) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `connected`
--

INSERT INTO `connected` (`id`, `pseudo`, `ip`, `date`) VALUES
(1, 'vq', '::1', 1395594131),
(2, 'vd', '::1', 1395594134),
(3, 'Salut', '::1', 1395594138),
(4, 'Vince', '::1', 1395594141),
(5, 'Vince', '::1', 1395594143),
(6, 'Vince', '::1', 1395594206),
(7, 'PTQ', '::1', 1395594213),
(8, 'Vincent', '', 0),
(9, 'PTQ', '::1', 1395594347),
(10, 'Vincent', '::1', 1395594351),
(11, 'gre', '::1', 1395594629),
(12, 'ha', '::1', 1395594633),
(13, 'zbreh', '::1', 1395594636),
(14, 'zbreh', '::1', 1395594639),
(15, 'arf', '::1', 1395596033),
(16, 'arf', '::1', 1395596038),
(17, 'arf', '::1', 1395596337),
(18, 'arf', '::1', 1395596339),
(19, 'v', '::1', 1395596341),
(20, 'v', '::1', 1395612517),
(21, 'aaaaa', '::1', 1395612520);

-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 23 Mars 2014 à 23:23
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `tchat`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(60) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
