-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 05, 2014 at 08:12 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `snippets`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `active`) VALUES
(1, 'Autres', 'autres', 1),
(2, 'PHP', 'php', 1),
(3, 'HTML', 'html', 1),
(4, 'CSS', 'css', 1),
(24, 'Test', 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`) VALUES
(1, 'About', 'Amazing Spider-Man is the cornerstone of the Marvel Universe.\r\n\r\nThe instructors at Avengers Academy hope to steer these super-powered and highly-troubled teens in the right direction, but twists and turns abound. Amazing Spider-Man is the cornerstone of the Marvel Universe. Featuring the work of Kurt Busiek, George Perez and other quintessential Avengers creators.\r\n\r\nFeaturing the work of Kurt Busiek, George Perez and other quintessential Avengers creators. See the Avengers go up against Ultron, Kang, the Masters of Evil and more over three decades of epic action. The instructors at Avengers Academy hope to steer these super-powered and highly-troubled teens in the right direction, but twists and turns abound.');

-- --------------------------------------------------------

--
-- Table structure for table `snippets`
--

CREATE TABLE `snippets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `content` text NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `snippets`
--

INSERT INTO `snippets` (`id`, `id_category`, `title`, `content`, `active`) VALUES
(1, 2, 'Class PHP', 'Contenu snippet 111', 1),
(2, 2, 'Config', 'Contenu snippet 2', 1),
(3, 3, 'Template HTML5', 'Contenu snippet 333', 0),
(4, 4, 'Animation CSS3', 'Contenu snippet 4', 0),
(5, 4, 'Transition CSS3', 'Contenu snippet 5', 1),
(6, 1, 'Timeout / Interval', 'Contenu snippet 6', 1),
(7, 1, 'Geolocation', 'Contenu snippet 7', 1),
(8, 3, 'Audio / Video', 'Contenu snippet 8', 1),
(9, 2, 'PDO prepare', 'Contenu snippet 9', 0),
(10, 4, 'Salut', '&lt;html&gt;\r\ntest\r\n&lt;/html&gt;', 1),
(12, 2, 'Super PrintR', 'echo ''&lt;pre&gt;'';\r\nprint_r(this);\r\necho ''&lt;/pre&gt;'';\r\nexit;', 1),
(13, 2, 'Blablabla Snippet', 'echo ''blabla'';\r\necho ''blabla'';\r\necho ''blabla'';\r\necho ''blabla'';\r\necho ''blabla'';\r\necho ''blabla'';\r\necho ''blabla'';\r\necho ''blabla'';\r\necho ''blabla'';\r\necho ''blabla'';\r\necho ''blabla'';\r\necho ''blabla'';', 1),
(20, 2, 'Snippet PHP', 'posqkdpokqs podkqsd\r\nqsdoqksd\r\n qskdo\r\n qsdk\r\n qsodk qosd', 1),
(21, 4, 'Coucou sqopdkqspodk', 'dposqk\r\n\r\noqkd qsod\r\ns', 0),
(24, 24, 'Tralala', 'atkzrpozkdpozakdpoqskdposqkdpq', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
