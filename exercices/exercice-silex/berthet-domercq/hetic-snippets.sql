-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 05 Juin 2014 à 21:26
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `hetic-snippets`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(254) NOT NULL,
  `title` varchar(254) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`) VALUES
(1, 'entree', 'entree'),
(2, 'plat', 'plat'),
(3, 'desserts', 'desserts'),
(4, 'boissons', 'boissons');

-- --------------------------------------------------------

--
-- Structure de la table `snippets`
--

CREATE TABLE IF NOT EXISTS `snippets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `snippets`
--

INSERT INTO `snippets` (`id`, `id_category`, `title`, `content`) VALUES
(1, 2, 'Burger vegetarien', 'http://media.meltyfood.fr/article-1810195-ajust_930/burger-vegetarien.jpg'),
(2, 2, 'cheeseburger', 'http://www.dairyqueen.com/PageFiles/316/dq-menu-food_double_cheeseburger_02.png?width=&height=810'),
(3, 3, 'gateaux chocolat', 'http://222.michael-patissier.com/wp-content/uploads/2013/05/gateau-au-chocolat.jpg'),
(4, 4, 'Chocolat chaud', 'http://www.minceurmoinscher.com/ori-boisson-cacao-hyperproteinee-42.jpg'),
(5, 4, 'Thé à la menthe', 'http://fr.questmachine.org/encyclopedie/illustrations/illustrations_articles/2781288438246.jpg'),
(6, 1, 'salade césar', 'http://cdn.im6.fr/0290017105915278-c2-photo-oYToyOntzOjE6InciO2k6NjU2O3M6NToiY29sb3IiO3M6NzoiI0ZGRkZGRiI7fQ%3D%3D-recette-pas-a-pas-de-la-salade-cesar.jpg'),
(7, 1, 'Salade avocat crevette', 'http://img59.imageshack.us/img59/1867/dsc0018oo.jpg'),
(8, 3, 'Crêpe nutella fraises', 'http://1.bp.blogspot.com/_UIXOn06Pz70/SIZWbSVTvWI/AAAAAAAAD4w/dkyBlDZS3I8/s800/Strawberry+and+Nutella+Crepes+2.0+500.jpg'),
(9, 2, 'Burger avocat ', 'http://www.lecoindejoelle.com/wp-content/uploads/2012/11/hamburger-avocat-gorgonzola-2.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
