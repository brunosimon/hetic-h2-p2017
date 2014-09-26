-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 05 Juin 2014 à 23:33
-- Version du serveur :  5.5.34
-- Version de PHP :  5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `hetic_cours_silex`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `slug` varchar(254) NOT NULL,
  `title` varchar(254) NOT NULL,
  `css_class` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`, `css_class`) VALUES
(1, 'javascript', 'Javascript', 'label-success'),
(2, 'php', 'PHP', 'label-primary'),
(3, 'html', 'HTML', 'label-danger'),
(4, 'css', 'CSS', 'label-warning');

-- --------------------------------------------------------

--
-- Structure de la table `mails`
--

CREATE TABLE IF NOT EXISTS `mails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `from_adress` varchar(255) NOT NULL,
  `from_name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `mails`
--

INSERT INTO `mails` (`id`, `date`, `from_adress`, `from_name`, `subject`, `message`) VALUES
(27, '2014-06-05 10:59:03', 'clem.delaunay@gmail.com', 'Clément', 'Coucou', 'Message.'),
(28, '2014-06-05 10:59:38', 'clem.delaunay@gmail.com', 'Clément', 'Coucou', 'Message.');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `snippets`
--

INSERT INTO `snippets` (`id`, `id_category`, `title`, `content`) VALUES
(1, 2, 'Class PHP', '$email = $_POST[''email''];\r\nif(preg_match("~([a-zA-Z0-9!#$%&''*+-/=?^_`{|}~])@([a-zA-Z0-9-]).([a-zA-Z0-9]{2,4})~",$email)) {\r\n	echo ''This is a valid email.'';\r\n}\r\nelse{\r\n	echo ''This is an invalid email.'';\r\n}'),
(2, 2, 'Config', 'define(''DB_HOST'',''host'');\r\ndefine(''DB_NAME'',''db'');\r\ndefine(''DB_USER'',''user'');\r\ndefine(''DB_PASS'',''pass'');\r\n\r\n// Pdo\r\ntry\r\n{\r\n    $pdo = new PDO(''mysql:dbname=''.DB_NAME.'';host=''.DB_HOST,DB_USER,DB_PASS);\r\n    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);\r\n}\r\ncatch (PDOException $e)\r\n{\r\n    die(''error'');\r\n}'),
(3, 3, 'Template HTML5', '		<!doctype html>\r\n		<html lang="en">\r\n		<head>\r\n			<meta charset="UTF-8">\r\n			<title>Document</title>\r\n		</head>\r\n		<body>\r\n			\r\n		</body>\r\n		</html>'),
(4, 4, 'Animation CSS3', '@-webkit-keyframes nomAnim{ ... } \r\n    @-moz-keyframes nomAnim{ ... } \r\n     @-ms-keyframes nomAnim{ ... } \r\n      @-o-keyframes nomAnim{ ... } \r\n         @keyframes nomAnim{ ... }    \r\n\r\ndiv{\r\n     -webkit-animation: nomAnim 5s linear 2s;\r\n        -moz-animation: nomAnim 5s linear 2s;\r\n         -ms-animation: nomAnim 5s linear 2s;\r\n          -o-animation: nomAnim 5s linear 2s;\r\n             animation: nomAnim 5s linear 2s;\r\n}'),
(5, 4, 'Transition CSS3', '-webkit-transition: all 1s ease-in-out;\r\n-moz-transition: all 1s ease-in-out;\r\n-ms-transition: all 1s ease-in-out;\r\n-o-transition: all 1s ease-in-out;\r\ntransition: all 1s ease-in-out;'),
(6, 1, 'Timeout / Interval', 'setTimeout(function(){alert("Hello")}, 3000);'),
(8, 3, 'Audio / Video', 'Contenu snippet 8'),
(9, 2, 'PDO prepare', '$req = $bdd->prepare(''INSERT INTO jeux_video(nom, possesseur, console, prix, nbre_joueurs_max, commentaires) VALUES(:nom, :possesseur, :console, :prix, :nbre_joueurs_max, :commentaires)'');\r\n$req->execute(array(\r\n	''nom'' => $nom,\r\n	''possesseur'' => $possesseur,\r\n	''console'' => $console,\r\n	''prix'' => $prix,\r\n	''nbre_joueurs_max'' => $nbre_joueurs_max,\r\n	''commentaires'' => $commentaires\r\n	));'),
(10, 4, 'Box-Shadow', '-webkit-box-shadow: 1px 1px 1px 0px rgba(0, 0, 0, 0.5);\r\n-moz-box-shadow: 1px 1px 1px 0px rgba(0, 0, 0, 0.5);\r\nbox-shadow: 1px 1px 1px 0px rgba(0, 0, 0, 0.5);'),
(15, 1, 'HLJS', '$(function() {\r\n\r\n 	$(''.copy'').on(''click'', function(){\r\n 		console.log(''Featuring'');\r\n  		return false;\r\n 	});\r\n\r\n 	// HlJS\r\n 	hljs.configure({useBR: true});\r\n	hljs.initHighlightingOnLoad();\r\n\r\n});');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
