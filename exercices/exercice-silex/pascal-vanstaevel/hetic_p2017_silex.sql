-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 05 Juin 2014 à 23:40
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `hetic_p2017_silex`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

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
-- Structure de la table `mail`
--

CREATE TABLE `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `mail` varchar(60) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Contenu de la table `snippets`
--

INSERT INTO `snippets` (`id`, `id_category`, `title`, `content`) VALUES
(45, 1, 'Back Button', '<FORM>\r\n<INPUT TYPE="Button" VALUE="Previous Page" onClick="history.go(-1)">\r\n</FORM>'),
(46, 1, 'Add to favorites', '<a href="javascript:window.external.AddFavorite(''http://www.yoursite.com'', ''Your Site Name'')">Add to Favorites</a>'),
(60, 2, 'String match', ' <?php\r\nfunction strcomp($str1,$str2){\r\n    if($str1 == $str2){\r\n        return TRUE;\r\n    }else{\r\n        return FALSE;\r\n    }\r\n}\r\n\r\necho strcomp("First string","Second string"); //Returns FALSE\r\necho strcomp("A string","A string"); //Returns TRUE\r\n?> '),
(61, 2, 'Generate Random Passwords', ' <?php\r\nrequire_once "database_connections.php";\r\n\r\n$uniq = uniqid();\r\n$pass = substr(md5($uniq), 0, 10);\r\n\r\n$username = mysql_real_escape_string($_POST["username"]);\r\nmysql_query("insert into members (username, password) values (''$username'', md5(''$pass''))");\r\n?> '),
(64, 3, 'HTML 5 template', '<!DOCTYPE HTML>\r\n\r\n<html>\r\n\r\n<head>\r\n	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\r\n	<title>Your Website</title>\r\n</head>\r\n\r\n<body>\r\n\r\n	<header>\r\n		<nav>\r\n			<ul>\r\n				<li>Your menu</li>\r\n			</ul>\r\n		</nav>\r\n	</header>\r\n	\r\n	<section>\r\n	\r\n		<article>\r\n			<header>\r\n				<h2>Article title</h2>\r\n				<p>Posted on <time datetime="2009-09-04T16:31:24+02:00">September 4th 2009</time> by <a href="#">Writer</a> - <a href="#comments">6 comments</a></p>\r\n			</header>\r\n			<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>\r\n		</article>\r\n		\r\n		<article>\r\n			<header>\r\n				<h2>Article title</h2>\r\n				<p>Posted on <time datetime="2009-09-04T16:31:24+02:00">September 4th 2009</time> by <a href="#">Writer</a> - <a href="#comments">6 comments</a></p>\r\n			</header>\r\n			<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>\r\n		</article>\r\n		\r\n	</section>\r\n\r\n	<aside>\r\n		<h2>About section</h2>\r\n		<p>Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>\r\n	</aside>\r\n\r\n	<footer>\r\n		<p>Copyright 2009 Your name</p>\r\n	</footer>\r\n\r\n</body>\r\n\r\n</html>'),
(65, 3, 'Form', '<form id="myForm" action="#" method="post">\r\n\r\n  <div>\r\n    <label for="name">Text Input:</label>\r\n    <input type="text" name="name" id="name" value="" tabindex="1">\r\n   </div>\r\n\r\n   <div>\r\n     <h4>Radio Button Choice</h4>\r\n\r\n     <label for="radio-choice-1">Choice 1</label>\r\n     <input type="radio" name="radio-choice-1" id="radio-choice-1" tabindex="2" value="choice-1">\r\n\r\n    <label for="radio-choice-2">Choice 2</label>\r\n    <input type="radio" name="radio-choice-2" id="radio-choice-2" tabindex="3" value="choice-2">\r\n  </div>\r\n\r\n  <div>\r\n    <label for="select-choice">Select Dropdown Choice:</label>\r\n    <select name="select-choice" id="select-choice">\r\n      <option value="Choice 1">Choice 1</option>\r\n      <option value="Choice 2">Choice 2</option>\r\n      <option value="Choice 3">Choice 3</option>\r\n    </select>\r\n  </div>\r\n	\r\n  <div>\r\n    <label for="textarea">Textarea:</label>\r\n    <textarea cols="40" rows="8" name="textarea" id="textarea"></textarea>\r\n  </div>\r\n	\r\n  <div>\r\n    <label for="checkbox">Checkbox:</label>\r\n    <input type="checkbox" name="checkbox">\r\n  </div>\r\n\r\n  <div>\r\n    <input type="submit" value="Submit">\r\n  </div>\r\n\r\n</form>'),
(66, 4, 'Top shadow', 'body:before {\r\n          content: "";\r\n          position: fixed;\r\n          top: -10px;\r\n          left: 0;\r\n          width: 100%;\r\n          height: 10px;\r\n\r\n          -webkit-box-shadow: 0px 0px 10px rgba(0,0,0,.8);\r\n              -moz-box-shadow: 0px 0px 10px rgba(0,0,0,.8);\r\n                         box-shadow: 0px 0px 10px rgba(0,0,0,.8);\r\n\r\n          z-index: 100;\r\n}'),
(67, 4, 'Fixed footer', '#footer {\r\n   position:fixed;\r\n   left:0px;\r\n   bottom:0px;\r\n   height:30px;\r\n   width:100%;\r\n   background:#999;\r\n}\r\n\r\n/* IE 6 */\r\n* html #footer {\r\n   position:absolute;\r\n   top:expression((0-(footer.offsetHeight)+(document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight)+(ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop))+''px'');\r\n}'),
(68, 4, 'Media Queries', '/* Smartphones (portrait and landscape) ----------- */\r\n@media only screen \r\nand (min-device-width : 320px) \r\nand (max-device-width : 480px) {\r\n/* Styles */\r\n}\r\n\r\n/* Smartphones (landscape) ----------- */\r\n@media only screen \r\nand (min-width : 321px) {\r\n/* Styles */\r\n}\r\n\r\n/* Smartphones (portrait) ----------- */\r\n@media only screen \r\nand (max-width : 320px) {\r\n/* Styles */\r\n}\r\n\r\n/* iPads (portrait and landscape) ----------- */\r\n@media only screen \r\nand (min-device-width : 768px) \r\nand (max-device-width : 1024px) {\r\n/* Styles */\r\n}\r\n\r\n/* iPads (landscape) ----------- */\r\n@media only screen \r\nand (min-device-width : 768px) \r\nand (max-device-width : 1024px) \r\nand (orientation : landscape) {\r\n/* Styles */\r\n}\r\n\r\n/* iPads (portrait) ----------- */\r\n@media only screen \r\nand (min-device-width : 768px) \r\nand (max-device-width : 1024px) \r\nand (orientation : portrait) {\r\n/* Styles */\r\n}\r\n\r\n/* Desktops and laptops ----------- */\r\n@media only screen \r\nand (min-width : 1224px) {\r\n/* Styles */\r\n}\r\n\r\n/* Large screens ----------- */\r\n@media only screen \r\nand (min-width : 1824px) {\r\n/* Styles */\r\n}\r\n\r\n/* iPhone 4 ----------- */\r\n@media\r\nonly screen and (-webkit-min-device-pixel-ratio : 1.5),\r\nonly screen and (min-device-pixel-ratio : 1.5) {\r\n/* Styles */\r\n}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
