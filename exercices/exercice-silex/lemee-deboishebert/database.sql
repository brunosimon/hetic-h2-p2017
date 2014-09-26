-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Jeu 05 Juin 2014 à 22:41
-- Version du serveur: 5.5.9
-- Version de PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `hetic`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` VALUES(1, 'javascript', 'Javascript');
INSERT INTO `categories` VALUES(2, 'php', 'PHP');
INSERT INTO `categories` VALUES(3, 'html', 'HTML');
INSERT INTO `categories` VALUES(4, 'css', 'CSS');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `snippets`
--

INSERT INTO `snippets` VALUES(1, 2, 'Class PHP', '<?php\r\n\r\nclass SclassName\r\n{\r\n    function __construct()\r\n    {\r\n        \r\n    }\r\n\r\n    function random_function()\r\n    {\r\n        \r\n    }\r\n}\r\n\r\n?>');
INSERT INTO `snippets` VALUES(2, 2, 'Config', '<?php\r\n\r\nerror_reporting(E_ALL);\r\nini_set(''display_errors'',1);\r\n\r\ndefine(''DB_HOST'',''localhost'');\r\ndefine(''DB_NAME'',''db_name'');\r\ndefine(''DB_USER'',''db_user'');\r\ndefine(''DB_PASS'',''db_pass'');\r\n\r\ntry\r\n{\r\n    $pdo = new PDO(''mysql:dbname=''.DB_NAME.'';host=''.DB_HOST,DB_USER,DB_PASS);\r\n    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);\r\n}\r\ncatch (PDOException $e)\r\n{\r\n    die(''error'');\r\n}\r\n\r\n?>');
INSERT INTO `snippets` VALUES(3, 3, 'Template HTML5', '<!DOCTYPE html>\r\n<html lang="fr">\r\n	<head>\r\n		<title>Title</title>\r\n		<meta charset="UTF-8">\r\n\r\n		\r\n		<link rel="icon" type="image/png" href="favicon.jpg" />\r\n		<link href="./css/main.css" rel="stylesheet" type="text/css">\r\n\r\n	</head>\r\n	\r\n	<body>\r\n\r\n	</body>\r\n</html>');
INSERT INTO `snippets` VALUES(4, 4, 'Animation CSS3', '.animation{\r\n    animation : monanimation 3s;\r\n}\r\n\r\n@keyframes monanimation {\r\n    0%   {left:0px;width:100px;}\r\n    50%  {left:800px;width:50px;background:green;}\r\n    70%  {left:700px;width:300px;background:red;}\r\n    100% {left:0px;width:50px;}\r\n}');
INSERT INTO `snippets` VALUES(5, 4, 'Transition CSS3', '.transition{\r\n    transition:all 2s ease-out 1s;\r\n}');
INSERT INTO `snippets` VALUES(6, 1, 'Timeout / Interval', 'setTimeout(function()}, 3000);\r\n\r\nsetInterval(function()}, 3000);');
INSERT INTO `snippets` VALUES(7, 1, 'Geolocation', 'if(navigator.geolocation)\r\n{\r\n    navigator.geolocation.getCurrentPosition(\r\n        function(position)\r\n        {\r\n            console.log(position);\r\n        },\r\n        function(error)\r\n        {\r\n            console.log(error.message);\r\n        }\r\n    );\r\n}\r\nelse\r\n{\r\n    alert(''Geolocation is not supported'');\r\n}');
INSERT INTO `snippets` VALUES(8, 3, 'Audio / Video', '<audio autoplay="autoplay" loop="loop" controls="controls">\r\n    <source src="audio.mp3" type="audio/mp3">\r\n    <source src="audio.ogg" type="audio/ogg">\r\n    Your browser doesn''t support audio API\r\n</audio>\r\n\r\n<video autoplay="autoplay" loop="loop" controls="controls" width="800">\r\n    <source src="video.mp4" type="video/mp4">\r\n    <source src="video.webm" type="video/webm">\r\n    <source src="video.ogv" type="video/ogg">\r\n    Your browser doesn''t support video API\r\n</video>');
INSERT INTO `snippets` VALUES(9, 2, 'PDO prepare', '<?php\r\n\r\n$prepare = $this->pdo->prepare(''QUERY'');\r\n$prepare->bindValue(''variable'',$variable,PDO::PARAM_STR);\r\n$prepare->execute();\r\n\r\n?>');
