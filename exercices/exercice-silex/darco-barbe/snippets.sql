-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 05 Juin 2014 à 17:22
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `snippets`
--
CREATE DATABASE IF NOT EXISTS `snippets` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `snippets`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(254) NOT NULL,
  `title` varchar(254) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`) VALUES
(1, 'black', 'Black and Grey Cats'),
(2, 'tabby', 'Tabby or Colourpoint Cats'),
(3, 'white', 'White Cats'),
(4, 'roux', 'Roux Cats'),
(5, 'other', 'The more, the merrier');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `snippets`
--

INSERT INTO `snippets` (`id`, `id_category`, `title`, `content`) VALUES
(14, 2, 'Timy', 'http://37.media.tumblr.com/tumblr_kp3jpdIHWK1qzbpaho1_500.jpg'),
(15, 3, 'Abby', 'http://www.lovethispic.com/uploaded_images/9097-White-Kitten.jpg'),
(16, 4, 'Baby', 'http://24.media.tumblr.com/tumblr_m2ntldDXuB1ru4tdpo1_500.jpg'),
(17, 2, 'Calico', 'http://31.media.tumblr.com/tumblr_kp3jp6vDK01qa1t0io1_500.jpg'),
(18, 2, 'Daisy', 'http://37.media.tumblr.com/tumblr_m9izcfyOfZ1r194ubo1_500.jpg'),
(19, 3, 'Fauna', 'http://cutearoo.com/wp-content/uploads/2012/02/Kitten7.jpg'),
(20, 2, 'Giant', 'http://24.media.tumblr.com/tumblr_l2youu1p681qzkuoxo1_500.jpg'),
(23, 4, 'Izzy', 'http://www.desktopict.com/wp-content/uploads/2014/02/kitten-wallpaper-9.jpg'),
(24, 2, 'Kactus', 'http://media.meltybuzz.fr/article-1143947-ajust_930/daisy-dans-toute-sa-splendeur.jpg'),
(25, 5, 'Judith & Kim', 'http://fr.ilikewallpaper.net/ipad-wallpapers/download/8568/Cute-Kittens-ipad-wallpaper-ilikewallpaper_com.jpg'),
(26, 5, 'Lana, Lin & Lucy', 'http://www.tehcute.com/pics/201110/kittens-in-underpants-big.jpg'),
(27, 5, 'Loki & Hulk', 'http://37.media.tumblr.com/tumblr_lunt1wdljD1qemjrpo1_1280.jpg'),
(28, 5, 'Pika & Mickey', 'http://37.media.tumblr.com/tumblr_manpx0aFrm1repmwwo1_1280.jpg'),
(29, 1, 'Macaroni', 'http://fc09.deviantart.net/fs70/i/2010/014/2/0/Black_kitten_by_Sebostian.jpg'),
(30, 1, 'Itchy', 'http://24.media.tumblr.com/tumblr_lt6dfutuw41r0cc6qo1_500.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
