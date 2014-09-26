-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 05 Juin 2014 à 21:30
-- Version du serveur: 5.5.33
-- Version de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `hetic-silex-snippets`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`) VALUES
(1, 'javascript', 'JAVASCRIPT'),
(2, 'php', 'PHP'),
(3, 'html', 'HTML'),
(4, 'css', 'CSS'),
(14, 'coffeescript', 'CoffeeScript'),
(15, 'ruby', 'Ruby');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`id`, `username`, `email`, `subject`, `message`) VALUES
(21, 'Meghan Regior', 'regior.meghan@gmail.com', 'Objet test !', 'Message test !'),
(22, 'Meghan Regior', 'regior.meghan@gmail.com', 'Test1', 'Test1'),
(23, 'Meghan Regior', 'regior.meghan@gmail.com', 'Test1', 'Test1'),
(24, 'Clara Rua', 'clara.rua@gmail.com', 'Test', 'Test'),
(25, 'Meghan', 'regior.meghan@gmail.com', 'Hello World !', 'Hello World !'),
(26, 'Clara', 'clara.rua@gmail.com', 'hello !', 'hello world !');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `snippets`
--

INSERT INTO `snippets` (`id`, `id_category`, `title`, `content`) VALUES
(1, 2, 'Class PHP', '<?php\r\nclass Panier {\r\n    // Eléments de notre panier\r\n    var $items;\r\n\r\n    // Ajout de $num articles de type $artnr au panier\r\n\r\n    function add_item($artnr, $num) {\r\n        $this->items[$artnr] += $num;\r\n    }\r\n\r\n    // Suppression de $num articles du type $artnr du panier\r\n\r\n    function remove_item($artnr, $num) {\r\n        if ($this->items[$artnr] > $num) {\r\n            $this->items[$artnr] -= $num;\r\n            return true;\r\n        } elseif ($this->items[$artnr] == $num) {\r\n            unset($this->items[$artnr]);\r\n            return true;\r\n        } else {\r\n            return false;\r\n        }\r\n    }\r\n}\r\n?>'),
(2, 2, 'Config', '<?php\r\n\r\ndefine(''DB_NAME'',''dbname''); \r\ndefine(''DB_HOST'',''localhost'');\r\ndefine(''DB_USER'',''user'');\r\ndefine(''DB_PASS'',''pass'');\r\n\r\ntry\r\n{\r\n    $pdo = new PDO(''mysql:dbname=''.DB_NAME.'';host=''.DB_HOST,DB_USER,DB_PASS);\r\n    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);\r\n}\r\ncatch (PDOException $e)\r\n{\r\n	die(''error'');\r\n}\r\n\r\n?>'),
(3, 3, 'Template HTML5', '<!doctype html>\r\n<html lang="en">\r\n<head>\r\n  <meta charset="UTF-8">\r\n  <title>Document</title>\r\n</head>\r\n<body>\r\n  \r\n</body>\r\n</html>\r\n'),
(4, 4, 'Animation CSS3', 'div\n{\n-webkit-animation: myfirst 5s; /* Chrome, Safari, Opera */\nanimation: myfirst 5s;\n}\n\n/* Chrome, Safari, Opera */\n@-webkit-keyframes myfirst\n{\nfrom {background: red;}\nto {background: yellow;}\n}\n\n/* Standard syntax */\n@keyframes myfirst\n{\nfrom {background: red;}\nto {background: yellow;}\n}'),
(5, 4, 'Transition CSS3', 'div\n{\n-webkit-transition: width 2s, height 2s,-webkit-transform 2s;  /* For Safari 3.1 to 6.0 */\ntransition: width 2s, height 2s, transform 2s;\n}'),
(6, 1, 'Timeout / Interval', '\nwindow.setInterval("javascript function", milliseconds);\n\n'),
(7, 1, 'Geolocation', 'var x = document.getElementById("demo");\nfunction getLocation() {\n    if (navigator.geolocation) {\n        navigator.geolocation.getCurrentPosition(showPosition);\n    } else {\n        x.innerHTML = "Geolocation is not supported by this browser.";\n    }\n}\nfunction showPosition(position) {\n    x.innerHTML = "Latitude: " + position.coords.latitude + \n    "<br>Longitude: " + position.coords.longitude; \n}'),
(8, 3, 'Audio / Video', '<audio controls>\r\n  <source src="horse.ogg" type="audio/ogg">\r\n  <source src="horse.mp3" type="audio/mpeg">\r\n  Your browser does not support the audio tag.\r\n</audio>\r\n\r\n<video width="320" height="240" controls>\r\n  <source src="movie.mp4" type="video/mp4">\r\n  <source src="movie.ogg" type="video/ogg">\r\n  Your browser does not support the video tag.\r\n</video>'),
(9, 2, 'PDO prepare', '<?php\r\npublic PDOStatement PDO::prepare ( string $statement [, array $driver_options = array() ] )\r\n?>'),
(17, 1, 'Mouse Event', 'document.getElementById(''btn'').onclick = function() {\r\n  alert(''click!'')\r\n}\r\ndocument.getElementById(''btn2'').oncontextmenu = function() {\r\n  alert(''right click!'')\r\n}'),
(20, 14, 'If, Else, Unless, and Conditional Assignment', 'var date, mood;\r\n\r\nif (singing) {\r\n  mood = greatlyImproved;\r\n}\r\n\r\nif (happy && knowsIt) {\r\n  clapsHands();\r\n  chaChaCha();\r\n} else {\r\n  showIt();\r\n}\r\n\r\ndate = friday ? sue : jill;');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
