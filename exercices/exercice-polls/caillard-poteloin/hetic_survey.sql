-- phpMyAdmin SQL Dump
-- version 4.1.2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 09 Février 2014 à 19:53
-- Version du serveur :  5.5.33
-- Version de PHP :  5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `hetic_survey`
--

-- --------------------------------------------------------

--
-- Structure de la table `surveys`
--

CREATE TABLE `surveys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `description` varchar(250) CHARACTER SET utf8 NOT NULL,
  `choice1` varchar(50) CHARACTER SET utf8 NOT NULL,
  `choice2` varchar(50) CHARACTER SET utf8 NOT NULL,
  `choice3` varchar(50) CHARACTER SET utf8 NOT NULL,
  `choice4` varchar(50) CHARACTER SET utf8 NOT NULL,
  `choice5` varchar(50) CHARACTER SET utf8 NOT NULL,
  `validated` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=62 ;

--
-- Contenu de la table `surveys`
--

INSERT INTO `surveys` (`id`, `name`, `description`, `choice1`, `choice2`, `choice3`, `choice4`, `choice5`, `validated`) VALUES
(1, 'Smartphones', 'What is the best smartphone?', 'iPhone 5s', 'Samsung Galaxy S4', 'Nokia Lumia 1020', 'Nexus 5', 'HTC One', 1),
(2, 'Mobile OS', 'What is the best mobile operating system ?', 'iOS', 'Android', 'Windows Phone', '', '', 1),
(3, 'Back-end language', 'What is your favorite server-side language ?', 'PHP', 'ASP.NET', 'Ruby', 'Python', 'NodeJS', 1),
(4, 'OS X vs Windows', 'Quick choice!', 'OS X', 'Windows', 'Linux', '', '', 1),
(14, 'Web browsers', 'What is your favorite web browser?', 'Google Chrome', 'Internet Explorer', 'Safari', 'Mozilla Firefox', 'Opera', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(40) CHARACTER SET utf8 NOT NULL,
  `active` int(11) NOT NULL,
  `last_survey_date` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `token`, `active`, `last_survey_date`, `name`) VALUES
(1, '1414ea3eafe16796eea6013b1ca35102', 0, 0, 'Hugo');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_id` int(11) NOT NULL,
  `value` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_token` varchar(40) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `votes`
--

INSERT INTO `votes` (`id`, `survey_id`, `value`, `user_token`) VALUES
(1, 14, 'Google Chrome', '1414ea3eafe16796eea6013b1ca35102'),
(2, 57, 'Un clodo', '1414ea3eafe16796eea6013b1ca35102');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
