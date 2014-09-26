-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 05 Juin 2014 à 22:22
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `bdd-silex`
--
-- CREATE DATABASE IF NOT EXISTS `bdd-silex` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
-- USE `bdd-silex`;

-- --------------------------------------------------------

--
-- Structure de la table `circuits`
--

CREATE TABLE IF NOT EXISTS `circuits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_console` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `circuits`
--

INSERT INTO `circuits` (`id`, `id_console`, `nom`, `img`) VALUES
(2, 1, 'Circuit Mario 1', 'http://2.bp.blogspot.com/_c6J1M8eAig0/TUomheMATVI/AAAAAAAABWc/HlTwp2n1Ie4/s320/MKDS_Mario_Circuit_1.PNG'),
(3, 1, 'Plaine Donut 1', 'http://www.mariowiki.com/images/thumb/2/2a/MKDSmap6-1.png/240px-MKDSmap6-1.png'),
(4, 1, 'VallÃ©e FantÃ´me 1', 'http://www.quizz.biz/uploads/quizz/426552/11_c4seu.jpg'),
(5, 1, 'ChÃ¢teau de Bowser 1', 'http://cdn.gamekult.com/gamekult-com/video/flv/104282/10428243_360p.jpg'),
(6, 1, 'Circuit Mario 2', 'http://www.mariowiki.com/images/thumb/f/f1/MK7-SFC-MC.png/200px-MK7-SFC-MC.png'),
(7, 1, 'ÃŽle Choco 1', 'http://www.mariowiki.com/images/1/1f/Chocoisland1.PNG'),
(8, 1, 'VallÃ©e FantÃ´me 2', 'http://img3.wikia.nocookie.net/__cb20110930131624/mariokartrace/fr/images/4/4c/VF1.jpg'),
(9, 1, 'Plaine Donut 2', 'http://www.mariowiki.com/images/0/02/Donutplains2.png'),
(10, 1, 'ChÃ¢teau de Bowser 3', 'http://img3.wikia.nocookie.net/__cb20111001112358/mariokartrace/fr/images/e/ed/SNES_BC_3.jpg'),
(11, 2, 'Autodrome Luigi', 'http://www.quizz.biz/uploads/quizz/426552/12_y4fvq.jpg'),
(12, 2, 'Ferme Meuh Meuh', 'http://mariofusion.free.fr/jeux/mario_kart_wii/guide/ferme-meuh-meuh.jpg'),
(13, 2, 'Plage Koopa', 'http://www.mariowiki.com/images/0/0a/KoopaTroopaBeachMK7.png'),
(14, 2, 'DÃ©sert Kalimari', 'http://www.poisonmushroom.org/content/uploads/2012/09/KalimariDesertMK7.png'),
(15, 2, 'Autoroute Toad', 'http://i1.ytimg.com/vi/02CwViAJEJc/hqdefault.jpg'),
(16, 7, 'Circuit Peach', 'http://www.mariowiki.com/images/6/69/Mkscpeachcircuit.png'),
(17, 7, 'Route Arc-en-ciel', 'http://image.jeuxvideo.com/images/sn/m/a/makasn130.jpg'),
(18, 3, 'DÃ©sert Sec Sec', 'http://www.mariowiki.com/images/9/94/Dry_Dry_Ruins.PNG'),
(19, 3, 'Montagne DK', 'http://journalnintendo.wifeo.com/images/Mario-Kart-Wii-9.jpg'),
(20, 8, 'Cascades Yoshi', 'http://www.quizz.biz/uploads/quizz/229644/1_6ezc7.jpg'),
(21, 8, 'Flipper Waluigi', 'http://www.vanilladome.fr/lieu/waluigipinball.png'),
(22, 4, 'Gorge Champignon', 'http://s3.e-monsite.com/2010/09/12/06/gorge-champignon.jpg'),
(23, 4, 'Cap Koopa', 'http://www.vanilladome.fr/lieu/Cap_Koopa.png'),
(24, 9, 'Piste musicale', 'http://gematsu.com/wp-content/uploads/2013/08/Wii-U-Trailer_08-23.jpg'),
(25, 9, 'Pic Wuhu', 'http://img1.wikia.nocookie.net/__cb20120613144238/mario/images/f/f7/Mario_gliding_MK7.png'),
(26, 9, 'ForÃªt tropicale DK', 'http://www.vanilladome.fr/lieu/For%C3%AAt%20Tropicale%20DK_MK7.png'),
(27, 5, 'Descente givrÃ©e', 'http://img.clubic.com/0280000007402601-photo-03-coupe-etoile-04-descentegivree-03.jpg'),
(28, 5, 'Lagon Tourbillon', 'http://i56.servimg.com/u/f56/15/37/61/53/640px-19.jpg'),
(29, 9, 'Manoir trempÃ©', 'http://i.gyazo.com/8df0b1391ea5c9e8ada224107bc16bc7.png');

-- --------------------------------------------------------

--
-- Structure de la table `consoles`
--

CREATE TABLE IF NOT EXISTS `consoles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `consoles`
--

INSERT INTO `consoles` (`id`, `slug`, `nom`) VALUES
(1, 'snes', 'Super Nintendo'),
(2, 'n64', 'Nintendo 64'),
(3, 'ngc', 'Game Cube'),
(4, 'wii', 'Wii'),
(5, 'wiiu', 'Wii U'),
(7, 'gba', 'Game Boy Advance'),
(8, 'ds', 'Nintendo DS'),
(9, '3ds', 'Nintendo 3DS');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
