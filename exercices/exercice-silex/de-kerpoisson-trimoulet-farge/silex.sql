-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 05 Juin 2014 à 22:49
-- Version du serveur: 5.5.33
-- Version de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `silex`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(254) NOT NULL,
  `title` varchar(254) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`) VALUES
(1, 'javascript', 'Javascript'),
(2, 'php', 'PHP'),
(3, 'html', 'HTML'),
(4, 'css', 'CSS');

-- --------------------------------------------------------

--
-- Structure de la table `snippets`
--

CREATE TABLE `snippets` (
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
(1, 2, 'Class PHP', 'Contenu snippet 1'),
(2, 2, 'Config', 'Contenu snippet 2'),
(3, 3, 'Template HTML5', 'Contenu snippet 3'),
(4, 4, 'Animation CSS3', 'Contenu snippet 4'),
(5, 4, 'Transition CSS3', 'Contenu snippet 5'),
(6, 1, 'Timeout / Interval', 'Contenu snippet 6'),
(7, 1, 'Geolocation', 'Contenu snippet 7'),
(8, 3, 'Audio / Video', 'Contenu snippet 8'),
(9, 2, 'PDO prepare', 'Contenu snippet 9');

-- --------------------------------------------------------

--
-- Structure de la table `suggest`
--

CREATE TABLE `suggest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=35 ;

--
-- Contenu de la table `suggest`
--

INSERT INTO `suggest` (`id`, `name`, `email`, `message`) VALUES
(1, 'fdsfsd', 'dfsfdsfs', 'fsdfsdfs'),
(2, 'Maxence', 'maxence.dekerpoisson@hetic.net', 'coucou !!!!'),
(3, 'Moi', 'maxence.dekerpoisson@hetic.net', 'ca va ?'),
(4, 'blablabla', 'dsqmlkdsmld', 'sdkldmqslkdsmq'),
(5, 'smdlqkslmd', 'qsldqmslkd', 'smdlksqmld'),
(6, 'dfdsklmfsdl', 'dlmfskfmlsd', 'dflsmkfmsd'),
(7, 'dfdsklmfsdl', 'dlmfskfmlsd', 'dflsmkfmsd'),
(8, 'dfdsklmfsdl', 'dlmfskfmlsd', 'dflsmkfmsd'),
(9, 'dfdsklmfsdl', 'dlmfskfmlsd', 'dflsmkfmsd'),
(10, 'dfdsklmfsdl', 'dlmfskfmlsd', 'dflsmkfmsd'),
(11, 'dfdsklmfsdl', 'dlmfskfmlsd', 'dflsmkfmsd'),
(12, 'dfdsklmfsdl', 'dlmfskfmlsd', 'dflsmkfmsd'),
(13, 'dfdsklmfsdl', 'dlmfskfmlsd', 'dflsmkfmsd'),
(14, 'Moi', 'dlmfskfmlsd', 'dflsmkfmsd'),
(15, 'Moi', 'Moi', 'Moi'),
(16, 'Moi', 'Moi', 'Moi'),
(17, 'blablabla', 'blablabla', 'blablabla'),
(18, 'bliblibli', 'bliblibli', 'bliblibli'),
(19, 'bliblibli', 'bliblibli', 'bliblibli'),
(20, 'bliblibli', 'bliblibli', 'bliblibli'),
(21, 'bliblibli', 'bliblibli', 'bliblibli'),
(22, 'bliblibli', 'bliblibli', 'bliblibli'),
(23, 'bliblibli', 'bliblibli', 'bliblibli'),
(24, 'bliblibli', 'bliblibli', 'bliblibli'),
(25, 'bliblibli', 'bliblibli', 'bliblibli'),
(26, 'bliblibli', 'bliblibli', 'bliblibli'),
(27, 'bliblibli', 'bliblibli', 'bliblibli'),
(28, 'dfsdfusof', 'sdlsjlqudoisq', 'sdkjlsqjdkq'),
(29, 'dlkfjslfdks', 'dfmlfsdmlfks', 'dojflkfs'),
(30, 'fdlkfskd', 'df:dslkfms', 'fjdklfjslfjdlsk'),
(31, 'fdlkfskd', 'df:dslkfms', 'fjdklfjslfjdlsk'),
(32, 'fdlfd:slsk', 'df:dslkfms', 'dmlfkdslkfslmkfmdlskfmlksdmls'),
(33, 'fdlfd:slsk', 'df:dslkfms', 'dmlfkdslkfslmkfmdlskfmlksdmls'),
(34, 'fdlfd:slsk', 'df:dslkfms', 'dmlfkdslkfslmkfmdlskfmlksdmls');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
