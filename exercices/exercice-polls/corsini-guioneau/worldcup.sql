-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 09 Février 2014 à 15:47
-- Version du serveur: 5.5.33
-- Version de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `worldcup`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `maracana` int(11) NOT NULL,
  `sao` int(11) NOT NULL,
  `mineirao` int(11) NOT NULL,
  `brasilia` int(11) NOT NULL,
  `castelao` int(11) NOT NULL,
  `fonte` int(11) NOT NULL,
  `beira` int(11) NOT NULL,
  `pernambuco` int(11) NOT NULL,
  `amazonia` int(11) NOT NULL,
  `pantanal` int(11) NOT NULL,
  `dunas` int(11) NOT NULL,
  `baixada` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `country`, `maracana`, `sao`, `mineirao`, `brasilia`, `castelao`, `fonte`, `beira`, `pernambuco`, `amazonia`, `pantanal`, `dunas`, `baixada`) VALUES
(70, 'Test', 'test@test.test', 'ivoire', 3, 2, 2, 4, 1, 3, 1, 2, 1, 5, 2, 1),
(71, 'alexandre', 'alexandre@ssdf.sdfsdf', 'honduras', 5, 2, 4, 1, 2, 3, 4, 1, 1, 3, 2, 1),
(72, 'inconnu', 'dfsdfdsfsdf@qsfs.sfd', 'france', 1, 5, 2, 1, 1, 3, 4, 1, 2, 3, 1, 5),
(73, 'User1', 'user@user.user', 'france', 3, 2, 4, 2, 1, 4, 2, 4, 5, 2, 2, 3),
(74, 'azerty', 'azerty@uiop.qsd', 'brazil', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(75, 'Albert', 'albert@monemail.com', 'brazil', 3, 5, 2, 1, 3, 2, 5, 4, 2, 1, 2, 4),
(76, 'okok', 'ok@ok.ok', 'france', 3, 4, 2, 2, 5, 5, 1, 2, 3, 5, 4, 1),
(77, 'dsfsdf', 'sdfsdfsdf@sf.sfsf', 'bosnia', 3, 2, 1, 3, 1, 1, 3, 1, 1, 3, 1, 1),
(78, 'world', 'cup@cup.cup', 'france', 3, 2, 4, 5, 1, 2, 2, 2, 3, 3, 4, 5),
(79, 'test2', 'test@qdqsqsd.sdfds', 'brazil', 1, 2, 1, 5, 2, 4, 3, 2, 3, 1, 1, 4),
(80, 'romain', 'romain@romain.romain', 'brazil', 3, 4, 2, 2, 3, 5, 2, 4, 2, 2, 1, 2),
(81, 'nbvcx', 'nbvcx@nbvcx.nbvcx', 'australia', 3, 2, 4, 2, 2, 3, 5, 3, 1, 3, 2, 5),
(82, 'User2', 'user2@user2.user2', 'usa', 1, 5, 3, 3, 3, 3, 5, 2, 4, 3, 4, 2),
(83, 'User3', 'user3@user3.user3', 'usa', 2, 3, 2, 1, 3, 1, 2, 1, 5, 2, 2, 3),
(84, 'User4', 'user4@user4.user4', 'korea', 3, 2, 4, 3, 2, 3, 1, 3, 2, 3, 4, 1),
(85, 'Ceci', 'est@un.test', 'usa', 5, 2, 4, 5, 5, 5, 5, 2, 4, 3, 4, 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
