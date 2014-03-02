-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 09 Février 2014 à 11:27
-- Version du serveur: 5.5.33
-- Version de PHP: 5.4.4-14+deb7u7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `survey`
--

-- --------------------------------------------------------

--
-- Structure de la table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `question_1` varchar(255) NOT NULL,
  `question_2` varchar(255) NOT NULL,
  `question_3` varchar(255) NOT NULL,
  `question_4` varchar(255) NOT NULL,
  `question_5` varchar(255) NOT NULL,
  `question_6` varchar(255) NOT NULL,
  `question_7` varchar(255) NOT NULL,
  `question_8` varchar(255) NOT NULL,
  `question_9` varchar(255) NOT NULL,
  `question_10_1` varchar(255) NOT NULL,
  `question_10_2` varchar(255) NOT NULL,
  `question_10_3` varchar(255) NOT NULL,
  `question_11` varchar(255) NOT NULL,
  `question_12` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `surveys`
--

CREATE TABLE IF NOT EXISTS `surveys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `choice_1` varchar(255) NOT NULL,
  `choice_2` varchar(255) NOT NULL,
  `choice_3` varchar(255) NOT NULL,
  `choice_4` varchar(255) NOT NULL,
  `choice_5` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `surveys`
--

INSERT INTO `surveys` (`id`, `id_user`, `name`, `description`, `choice_1`, `choice_2`, `choice_3`, `choice_4`, `choice_5`) VALUES
(10, 1, 'Les OS Mobiles', 'Il en existe beaucoup, alors pour vous lequel est le meilleur ?!', 'Android', 'iOS', 'Blackberry OS', 'Tizen', 'Firefox OS'),
(11, 4, 'Irlande VS Pays de galles', 'Qui va gagner ?!', 'Irlande', 'Pays de galles', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `nb_survey` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `mail`, `nb_survey`) VALUES
(1, 'Mathew', '0DlI8wya8GsngzFPKSBJqCctQUo=', 'mathieu.letyrant@hetic.net', 0),
(4, 'Isabelle', 'PMNoB4UPsxfakifjOI9zuLJTjeY=', 'IsabelleDu93@gmail.com', 0);

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_survey` int(11) NOT NULL,
  `choice` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `votes`
--

INSERT INTO `votes` (`id`, `id_user`, `id_survey`, `choice`) VALUES
(14, 1, 10, 'Firefox OS'),
(15, 4, 10, 'Android'),
(16, 4, 11, 'Irlande');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
