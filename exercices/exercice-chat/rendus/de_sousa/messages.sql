-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 24, 2014 at 02:03 AM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tchat`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(60) NOT NULL,
  `message` varchar(140) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=111 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `pseudo`, `message`, `date`) VALUES
(1, 'alves', 'bom dia', 0),
(2, 'alves', ' dsvdfvf', 0),
(3, 'steph', 'jojoijoi', 0),
(4, 'gfjfgj', 'gbhjk', 0),
(5, 'gfjfgj', ' nhfghn', 0),
(6, 'gfjfgj', 'eeeeee', 0),
(7, 'gfjfgj', 'rrrr', 0),
(8, 'polo@hot.com', ' jij', 0),
(9, 'wladi', 'dsvcdw', 0),
(10, 'wladi', ' ', 0),
(11, 'wladi', ' Bonsoir', 0),
(12, 'wladi', ' cvdfb', 0),
(13, 'wladi', ' dfvbdf', 0),
(14, 'wladi', ' sdfbvdf', 0),
(15, 'wladi', 'dfvdfv', 0),
(16, 'wladi', 'dsvdsva', 0),
(17, 'wladi', ' ', 0),
(18, 'wladi', 'asdvsafv', 0),
(19, 'wladi', ' ', 0),
(20, 'wladimir', 'wladimir', 0),
(21, 'wladimir', 'wladimi', 0),
(22, 'wladimir', 'weer', 0),
(23, 'wladimir', ' oioi', 0),
(24, 'wladimir', ' sdvsd', 0),
(25, 'wladimir', 'bonsoir', 0),
(26, 'wladimir', ' bonsoir', 0),
(27, 'wladimir', ' aloooo', 0),
(28, 'wladimir', ' ', 0),
(29, 'wladimir', ' aloo', 0),
(30, 'wladimir', ' boa noite', 0),
(31, 'wladimir', ' ', 0),
(32, 'wladimir', ' ', 0),
(33, 'wladimir', ' ', 0),
(34, 'wladimir', ' ', 0),
(35, 'wladimir', ' ', 0),
(36, 'wladimir', ' ', 0),
(37, 'wladimir', ' tchau', 0),
(38, 'wladimir', ' dsvds', 0),
(39, 'wladimir', ' ', 0),
(40, 'wladimir', ' ', 0),
(41, 'wladimir', ' ', 0),
(42, 'wladimir', ' ', 0),
(43, 'wladimir', ' ', 0),
(44, 'wladimir', ' ', 0),
(45, 'wladimir', ' ', 0),
(46, 'wladimir', ' boa ', 0),
(47, 'wladimir', 'pipiu', 0),
(48, 'wladimir', 'pipiu ', 0),
(49, 'wladimir', ' joao', 0),
(50, 'wladimir', ' paulo', 0),
(51, 'wladimir', ' maria', 0),
(52, 'wladimir', ' chapeu', 0),
(53, 'wladimir', ' papel', 0),
(54, 'wladimir', ' cunhado', 0),
(55, 'wladimir', ' pao', 0),
(56, 'wladimir', ' porque?', 0),
(57, 'wladimir', ' onde?', 0),
(58, 'wladimir', ' ali', 0),
(59, 'wladimir', ' quero', 0),
(60, 'wladimir', ' peixe', 0),
(61, 'wladimir', ' boa noite', 0),
(62, 'wladimir', ' ola', 0),
(63, 'wladimir', ' dsvsd', 0),
(64, 'wladimir', ' sadfvadfsv', 0),
(65, 'wladimir', 'sdavasd ', 0),
(66, 'wladimir', ' asvas', 0),
(67, 'wladimir', ' asdfvasdvdsfv', 0),
(68, 'wladimir', ' c vdf ', 0),
(69, 'wladimir', ' onde', 0),
(70, 'wladimir', ' quando', 0),
(71, 'wladimir', ' para', 0),
(72, 'wladimir', ' quero', 0),
(73, 'wladimir', ' onde?', 0),
(74, 'wladimir', ' agora', 0),
(75, 'wladimir', ' pra que?', 0),
(76, 'wladimir', 'aloo', 0),
(77, 'wladimir', ' dsvds', 0),
(78, 'wladimir', 'aloo', 0),
(79, 'wladimir', ' quero', 0),
(80, 'wladimir', ' oi', 0),
(81, 'wladimir', ' pai', 0),
(82, 'wladimir', ' irmao', 0),
(83, 'wladimir', ' irmao', 0),
(84, 'wladimir', 'mano', 0),
(85, 'wladimir', ' mana', 0),
(86, 'wladimir', ' papai', 0),
(87, 'wladimir', ' ', 0),
(88, 'wladimir', ' ', 0),
(89, 'wladimir', ' ', 0),
(90, 'wladimir', ' ', 0),
(91, 'wladimir', ' ', 0),
(92, 'wladimir', 'quer ', 0),
(93, 'wladimir', ' agora Ã© hora de dormir', 0),
(94, 'wladimir', ' sdcsad', 0),
(95, 'wladimir', ' eu quero dormir', 0),
(96, 'wladimir', 'quantas horas tu dormistes', 0),
(97, 'wladimir', ' quero mais', 0),
(98, 'wladimir', ' quero muito mais', 0),
(99, 'wladimir', 'aloo ', 0),
(100, 'wladimir', ' o que vocÃª quer ?', 0),
(101, 'wladimir', 'quero comer?', 0),
(102, 'wladimir', 'sdcvsad', 0),
(103, 'wladimir', 'cerveja ', 0),
(104, 'wladimir', ' cabeÃ§a', 0),
(105, 'wladimir', ' testa', 0),
(106, 'wladimir', ' manha', 0),
(107, 'wladimir', ' noite', 0),
(108, 'wladimir', ' acordado', 0),
(109, 'wladimir', ' :D', 0),
(110, 'wladimir', ' :D', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
