-- phpMyAdmin SQL Dump
-- version OVH
-- http://www.phpmyadmin.net
--
-- Client: mysql51-110.perso
-- Généré le : Sun 09 Février 2014 à 23:50
-- Version du serveur: 5.1.66
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `guillaumzvwps`
--

-- --------------------------------------------------------

--
-- Structure de la table `battles`
--

CREATE TABLE IF NOT EXISTS `battles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` datetime NOT NULL,
  `item1` varchar(72) CHARACTER SET utf8 NOT NULL,
  `img1` varchar(1024) NOT NULL,
  `vote1` int(11) NOT NULL DEFAULT '0',
  `item2` varchar(72) CHARACTER SET utf8 NOT NULL,
  `img2` varchar(1024) NOT NULL,
  `vote2` int(11) NOT NULL DEFAULT '0',
  `tags` text CHARACTER SET utf8 NOT NULL,
  `validate` enum('0','1') CHARACTER SET utf8 NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `battles`
--

INSERT INTO `battles` (`id`, `category`, `date`, `item1`, `img1`, `vote1`, `item2`, `img2`, `vote2`, `tags`, `validate`) VALUES
(11, 'Profils', '0000-00-00 00:00:00', 'Viande', 'http://lorempixel.com/400/400/food/1', 1, 'Viande', 'http://lorempixel.com/400/400/food/2', 3, '', '1'),
(13, 'Sites web', '2014-02-09 00:00:00', 'Vélo', 'http://lorempixel.com/400/400/sports/3/', 5, 'Moto', 'http://lorempixel.com/400/400/sports/5/', 1, '', '1'),
(15, 'Tweets', '2014-02-09 00:00:00', 'Plages', 'http://s.tf1.fr/mmdia/i/77/6/une-plage-image-d-illustration-10737776ojmko_1713.jpg?v=1', 0, 'Fleurs', 'http://blogvieactive.com/wp-content/uploads/2013/05/image-jaune1.jpg', 1, '', '1'),
(16, 'Images', '2014-02-09 00:00:00', 'Puppy', 'http://media1.giphy.com/media/LPQ943m8yMcpy/giphy.gif', 1, 'Kitten', 'http://media.giphy.com/media/TKWFIsfAqvfoc/giphy.gif', 1, '', '1'),
(17, 'Sites web', '2014-02-09 22:58:24', 'Pirate', 'http://tctechcrunch2011.files.wordpress.com/2010/10/pirate.jpg', 0, 'Ninja', 'http://media.giphy.com/media/hlwTrKysE6aHu/giphy.gif', 1, '', '1'),
(18, 'Profils', '2014-02-09 22:59:24', 'Batman', 'http://upload.wikimedia.org/wikipedia/en/7/75/Comic_Art_-_Batman_by_Jim_Lee_(2002).png', 0, 'Superman', 'http://upload.wikimedia.org/wikipedia/pt/b/be/Super-Homem.jpg', 0, '', '1'),
(21, 'Profils', '2014-02-09 23:39:43', 'Trend', 'http://lorempixel.com/400/400/fashion/3/', 0, 'Rock', 'http://lorempixel.com/400/400/fashion/2/', 0, '', '1'),
(22, 'Images', '2014-02-09 23:40:50', 'Apple', 'http://lorempixel.com/400/400/technics/1/', 0, 'Linux', 'http://lorempixel.com/400/400/technics/3/', 0, '', '1'),
(23, 'Tweets', '2014-02-09 23:41:41', 'Fourmis', 'http://lorempixel.com/400/400/nature/1/', 0, 'Pas fourmis', 'http://lorempixel.com/400/400/nature/2/', 0, '', '1'),
(24, 'Sites web', '2014-02-09 23:42:37', 'Avion', 'http://lorempixel.com/400/400/transport/1/', 0, 'Bus', 'http://lorempixel.com/400/400/transport/4/', 0, '', '1'),
(25, 'Images', '2014-02-09 23:43:51', 'Printemps', 'http://lorempixel.com/400/400/nature/8/', 0, 'Automne', 'http://lorempixel.com/400/400/nature/4/', 0, '', '1');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(96) NOT NULL,
  `color` varchar(32) NOT NULL,
  `picto` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `color`, `picto`) VALUES
(1, 'Images', 'red', 'image'),
(2, 'Tweets', 'blue', 'twitter'),
(3, 'Sites web', 'orange', 'screen'),
(4, 'Profils', 'green', 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
