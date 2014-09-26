-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 05 Juin 2014 à 21:08
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(254) NOT NULL,
  `title` varchar(254) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`, `count`) VALUES
(1, 'php', 'PHP', 1),
(2, 'css', 'CSS', 1),
(3, 'html', 'HTML', 4),
(4, 'javascript', 'Javascript', 1);

-- --------------------------------------------------------

--
-- Structure de la table `snippets`
--

CREATE TABLE IF NOT EXISTS `snippets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `content` text NOT NULL,
  `down` varchar(255) NOT NULL,
  `id_sender` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `snippets`
--

INSERT INTO `snippets` (`id`, `id_category`, `title`, `content`, `down`, `id_sender`) VALUES
(2, 3, 'Embed flash', '<object type="application/x-shockwave-flash" \r\n  data="your-flash-file.swf" \r\n  width="0" height="0">\r\n  <param name="movie" value="your-flash-file.swf" />\r\n  <param name="quality" value="high"/>\r\n</object>', 'Embedflash', '1'),
(3, 3, 'Doctype', '<!doctype html>\r\n<html>\r\n    <head>\r\n        <meta charset="utf-8">\r\n        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">\r\n        <meta name="description" content="$1">\r\n        <meta name="viewport" content="width=device-width, initial-scale=1">\r\n        <title>$2</title>\r\n        <link rel="stylesheet" href="css/main.css">\r\n    </head>\r\n    <body>\r\n        $3\r\n        <script src="js/main.js"></script>\r\n    </body>\r\n</html>', 'Doctype', '1'),
(4, 3, 'Lorem', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus', 'Lorem', '1'),
(5, 3, 'Structure', '<!DOCTYPE HTML>\r\n\r\n<html>\r\n\r\n<head>\r\n	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\r\n	<title>Your Website</title>\r\n</head>\r\n\r\n<body>\r\n\r\n	<header>\r\n		<nav>\r\n			<ul>\r\n				<li>Your menu</li>\r\n			</ul>\r\n		</nav>\r\n	</header>\r\n	\r\n	<section>\r\n	\r\n		<article>\r\n			<header>\r\n				<h2>Article title</h2>\r\n				<p>Posted on <time datetime="2009-09-04T16:31:24+02:00">September 4th 2009</time> by <a href="#">Writer</a> - <a href="#comments">6 comments</a></p>\r\n			</header>\r\n			<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>\r\n		</article>\r\n		\r\n		<article>\r\n			<header>\r\n				<h2>Article title</h2>\r\n				<p>Posted on <time datetime="2009-09-04T16:31:24+02:00">September 4th 2009</time> by <a href="#">Writer</a> - <a href="#comments">6 comments</a></p>\r\n			</header>\r\n			<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>\r\n		</article>\r\n		\r\n	</section>\r\n\r\n	<aside>\r\n		<h2>About section</h2>\r\n		<p>Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>\r\n	</aside>\r\n\r\n	<footer>\r\n		<p>Copyright 2009 Your name</p>\r\n	</footer>\r\n\r\n</body>\r\n\r\n</html>', 'Structure', '1'),
(6, 2, 'Better Helvetica', 'body {\r\n   font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; \r\n   font-weight: 300;\r\n}', 'BetterHelvetica', '1'),
(7, 1, 'SQL connection', '<?php\r\n\r\ndefine (''HOSTNAME'', ''localhost'');\r\ndefine (''USERNAME'', ''username'');\r\ndefine (''PASSWORD'', ''password'');\r\ndefine (''DATABASE_NAME'', ''recommendations'');\r\n\r\n$db = mysql_connect(HOSTNAME, USERNAME, PASSWORD) or die (''I cannot connect to MySQL.'');\r\n\r\nmysql_select_db(DATABASE_NAME);\r\n\r\n$query = "SELECT testimonial,author FROM recommendations WHERE 1 ORDER by rand() LIMIT 1";\r\n\r\n$result = mysql_query($query);\r\n\r\nwhile ($row = mysql_fetch_array($result)) {\r\necho "<p id="quote">" , ($row[''testimonial'']) , "</p> \\n <p id="author">&ndash;" , nl2br($row[''author'']) , "</p>";\r\n}\r\n\r\nmysql_free_result($result);\r\nmysql_close();\r\n?>', 'SQLconnection', '1'),
(8, 4, 'IE detection', '<script type="text/javascript">\r\n\r\nif (/MSIE (\\d+\\.\\d+);/.test(navigator.userAgent)) { //test for MSIE x.x;\r\n var ieversion=new Number(RegExp.$1) // capture x.x portion and store as a number\r\n if (ieversion>=8)\r\n  document.write("You''re using IE8 or above")\r\n else if (ieversion>=7)\r\n  document.write("You''re using IE7.x")\r\n else if (ieversion>=6)\r\n  document.write("You''re using IE6.x")\r\n else if (ieversion>=5)\r\n  document.write("You''re using IE5.x")\r\n}\r\nelse\r\n document.write("n/a")\r\n\r\n</script>', 'IEdetection', '1');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(1, 'matthieu', 'ad1d5060fe50fb3f153b59170393c5030658f6d2fdc049e1500fd2693b2c0c2d');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
