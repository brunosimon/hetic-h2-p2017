-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 05 Juin 2014 à 20:22
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


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
(1, 'javascript', 'javascript'),
(2, 'php', 'php'),
(3, 'html', 'html'),
(4, 'css', 'css');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`) VALUES
(1, 'erg', 'test@test.fr', 'test');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `snippets`
--

INSERT INTO `snippets` (`id`, `id_category`, `title`, `content`) VALUES
(1, 2, 'Debug', '<snippet>\r\n	<content><![CDATA[debug(${1:variable});]]></content>\r\n	<tabTrigger>db</tabTrigger>\r\n	<scope>source.php</scope>\r\n	<description>CakePHP: debug();</description>\r\n</snippet>'),
(2, 2, 'Data', '<snippet>\r\n	<content><![CDATA[\\$this->data[''${2:Model}''][''${3:field}'']$4;]]></content>\r\n	<tabTrigger>td</tabTrigger>\r\n	<scope>source.php</scope>\r\n	<description>CakePHP: $this->data[''Model''][''field'']</description>\r\n</snippet>'),
(3, 3, 'Template HTML5', '<snippet>\r\n    <content><![CDATA[<!doctype html>\r\n<html>\r\n    <head>\r\n        <meta charset="utf-8">\r\n        <meta name="description" content="$1">\r\n        <meta name="viewport" content="width=device-width, initial-scale=1">\r\n        <title>${2:Untitled}</title>\r\n        <link rel="stylesheet" href="css/style.css">\r\n        <link rel="author" href="humans.txt">\r\n    </head>\r\n    <body>\r\n        $3\r\n        <script src="js/main.js"></script>\r\n    </body>\r\n</html>]]></content>\r\n    <tabTrigger>doctype</tabTrigger>\r\n    <description>HTML - HTML foundation</description>\r\n    <scope>text.html</scope>\r\n</snippet>'),
(4, 4, 'Animation play-state', '<snippet>\r\n	<content><![CDATA[-webkit-animation-play-state: ${1:running|paused};\r\n   -moz-animation-play-state: ${1:running|paused};\r\n    -ms-animation-play-state: ${1:running|paused};\r\n     -o-animation-play-state: ${1:running|paused};\r\n        animation-play-state: ${1:running|paused};\r\n\r\n]]></content>\r\n	<tabTrigger>pla</tabTrigger>\r\n    <description>CSS - animation-play-state: ;</description>\r\n    <scope>source.css</scope>\r\n</snippet>'),
(5, 4, 'background CSS3', '<snippet>\r\n    <content><![CDATA[background: ${1:#fff} url(''$2'') ${3:0} ${4:0} ${5:repeat|repeat-x|repeat-y|no-repeat|inherit|round|space};\r\n\r\n]]></content>\r\n    <tabTrigger>bac</tabTrigger>\r\n    <description>CSS background: #fff url('''') 0 0 repeat;</description>\r\n    <scope>source.css</scope>\r\n</snippet'),
(6, 1, 'Console', '<snippet>\r\n	<content><![CDATA[console.dir(${1:variable});]]></content>\r\n	<tabTrigger>cd</tabTrigger>\r\n	<scope>source.js</scope>\r\n	<description>console.dir();</description>\r\n</snippet>'),
(7, 1, 'Console log', '<snippet>\r\n	<content><![CDATA[console.log(${1:variable});]]></content>\r\n	<tabTrigger>cl</tabTrigger>\r\n	<scope>source.js</scope>\r\n	<description>console.log();</description>\r\n</snippet>'),
(8, 3, 'Audio / Video', '<snippet>\r\n	<content><![CDATA[<input type="radio">$1]]></content>\r\n	<tabTrigger>inp:radio</tabTrigger>\r\n	<description>HTML - Input:radio</description>\r\n	<scope>text.html</scope>\r\n</snippet>'),
(9, 2, 'PDO prepare', 'Contenu snippet 9'),
(10, 3, 'HTML5 ', '<snippet>\r\n    <content><![CDATA[background: ${1:#fff} url(''$2'') ${3:0} ${4:0} ${5:repeat|repeat-x|repeat-y|no-repeat|inherit|round|space};\r\n\r\n]]></content>\r\n    <tabTrigger>bac</tabTrigger>\r\n    <description>CSS background: #fff url('''') 0 0 repeat;</description>\r\n    <scope>source.css</scope>\r\n</snippet'),
(11, 2, 'Request data', '<snippet>\r\n	<content><![CDATA[\\$this->${1:request->}data[''${2:Model}''][''${3:field}'']$4;]]></content>\r\n	<tabTrigger>trd</tabTrigger>\r\n	<scope>source.php</scope>\r\n	<description>CakePHP: $this->request->data[''Model''][''field'']</description>\r\n</snippet>'),
(12, 4, 'Comment CSS3', '<snippet>\r\n  <content><![CDATA[\r\n/* `${1}\r\n----------------------------------------------------------------------------------------------------*/\r\n\r\n${2}\r\n]]></content>\r\n  <tabTrigger>comment</tabTrigger>\r\n  <scope>source.css</scope>\r\n</snippet>'),
(13, 4, 'Gradient CSS3', '<snippet>\r\n	<content><![CDATA[\r\n/* Select only h1s that contain a ''data-text'' attribute */\r\nh1[data-text] {\r\n	position: relative;\r\n        color: red;\r\n}\r\n\r\nh1[data-text]::after {\r\n	content: attr(data-text);\r\n	z-index: 2;\r\n	color: green;\r\n	position: absolute;\r\n	left: 0;\r\n	-webkit-mask-image: -webkit-gradient(\r\n		linear,\r\n		left top, left bottom,\r\n		from(rgba(0,0,0,1)),\r\n		color-stop(40%, rgba(0,0,0,0))\r\n	);\r\n}\r\n\r\n]]></content>\r\n	<!-- Optional: Set a tabTrigger to define how to trigger the snippet -->\r\n	<tabTrigger>text-gradient</tabTrigger>\r\n	<scope>source.css, source.scss</scope>\r\n</snippet>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
