-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 09 Février 2014 à 14:38
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `dev-projet-sondage-charachon-doh`
--

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(200) NOT NULL,
  `choice1` varchar(200) NOT NULL,
  `choice2` varchar(200) NOT NULL,
  `choice3` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`id`, `question`, `choice1`, `choice2`, `choice3`) VALUES
(1, 'Quel film vous correspond le plus ?', 'The Social Network (Internet !)', 'Le loup de Wall Street (Money !)', 'Un disney (LOL !)'),
(2, 'Quel animal seriez-vous ?', 'Une tortue ', 'Un requin', 'Un cerf'),
(3, 'Si vous deviez ne conserver qu’un seul de ces objets lequel choisiriez-vous  ?', 'Un ordinateur', 'Un téléphone', 'Un crayon'),
(4, 'Votre ordinateur a planté, que choisiriez-vous d’installer en priorité ?', 'Sublime text', 'Skype', 'Photoshop'),
(5, 'Lors des projets de semaines intensives, quel rôle avez-vous eu le plus souvent occuper ?', 'Le développeur, (parce que t’en impose)', 'Le “manager”, (parce qu’il restait que ça)', 'Le designer, (le code, c’est pas ta tasse de thé)'),
(6, 'Quel est, parmi ces cours (contenu), votre préféré ?', 'Développement web (il explique trop bien ;) )', 'Le marketing, (la paperasse c’est ton dada)', 'Design initiatique (c’est poseyy et styleyyy)'),
(7, 'Qu’aimes-tu faire pendant le week-end ?', 'Coder tranquille sur un projet perso', 'Assister à des conférences', 'Faire des expositions, musées'),
(8, 'Quel super-héros vous ressemble le plus ?', 'Spiderman', 'Batman', 'Green Lantern'),
(9, 'Quel site préfères-tu ?', 'Codecademy', 'Journal Du Net', 'Awwwards'),
(10, 'À la bibliothèque, vers quel rayon vous dirigez-vous ?', 'Bandes dessinées, mangas...', 'Entreprise, bourse, actu, politique...', 'Beaux arts, photographie, architecture... ');

-- --------------------------------------------------------

--
-- Structure de la table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `result` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Contenu de la table `results`
--

INSERT INTO `results` (`id`, `result`) VALUES
(1, 'designer'),
(2, 'developer'),
(3, 'designer'),
(4, 'designer'),
(5, 'designer'),
(6, 'designer'),
(7, 'designer'),
(8, 'designer'),
(9, 'designer'),
(10, 'designer'),
(11, 'designer'),
(12, 'designer'),
(13, 'designer'),
(14, 'designer'),
(15, 'designer'),
(16, 'designer'),
(17, 'designer'),
(18, 'designer'),
(19, 'designer'),
(20, 'designer'),
(21, 'marketer'),
(22, 'marketer'),
(23, 'developer'),
(24, 'developer'),
(25, 'marketer'),
(26, 'marketer'),
(27, 'marketer'),
(28, 'marketer'),
(29, 'marketer'),
(44, 'designer'),
(45, 'developer');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=461 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
