-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 10, 2014 at 09:16 AM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bdd_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES(1, 'rez');
INSERT INTO `user` VALUES(2, 'ezs');
INSERT INTO `user` VALUES(3, 'ezr');
INSERT INTO `user` VALUES(4, 'erzrtze');
INSERT INTO `user` VALUES(5, 'alex');
INSERT INTO `user` VALUES(6, 'fdsfds');
INSERT INTO `user` VALUES(7, 'g');
INSERT INTO `user` VALUES(8, 'rez');
INSERT INTO `user` VALUES(9, 'efz');
INSERT INTO `user` VALUES(10, 'fz');
INSERT INTO `user` VALUES(11, 'rez');
INSERT INTO `user` VALUES(12, 'rezre');
INSERT INTO `user` VALUES(13, 'rez');
INSERT INTO `user` VALUES(14, 'aaa');
INSERT INTO `user` VALUES(15, 'aaa');
INSERT INTO `user` VALUES(16, 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=336 ;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` VALUES(152, 'intervenant');
INSERT INTO `votes` VALUES(153, 'non');
INSERT INTO `votes` VALUES(154, 'oui');
INSERT INTO `votes` VALUES(155, 'natation');
INSERT INTO `votes` VALUES(156, 'etudiant');
INSERT INTO `votes` VALUES(157, 'oui');
INSERT INTO `votes` VALUES(158, 'oui');
INSERT INTO `votes` VALUES(159, 'foot');
INSERT INTO `votes` VALUES(160, 'billard');
INSERT INTO `votes` VALUES(161, 'administration');
INSERT INTO `votes` VALUES(162, 'non1');
INSERT INTO `votes` VALUES(163, 'non2');
INSERT INTO `votes` VALUES(164, 'trampoline');
INSERT INTO `votes` VALUES(165, 'autre');
INSERT INTO `votes` VALUES(166, 'oui1');
INSERT INTO `votes` VALUES(167, 'non2');
INSERT INTO `votes` VALUES(168, 'curling');
INSERT INTO `votes` VALUES(169, 'administration');
INSERT INTO `votes` VALUES(170, 'non1');
INSERT INTO `votes` VALUES(171, 'oui2');
INSERT INTO `votes` VALUES(172, 'lance de nain');
INSERT INTO `votes` VALUES(173, 'administration');
INSERT INTO `votes` VALUES(174, 'non1');
INSERT INTO `votes` VALUES(175, 'non2');
INSERT INTO `votes` VALUES(176, '');
INSERT INTO `votes` VALUES(177, '');
INSERT INTO `votes` VALUES(178, '');
INSERT INTO `votes` VALUES(179, '');
INSERT INTO `votes` VALUES(180, '');
INSERT INTO `votes` VALUES(181, '');
INSERT INTO `votes` VALUES(182, '');
INSERT INTO `votes` VALUES(183, '');
INSERT INTO `votes` VALUES(184, '');
INSERT INTO `votes` VALUES(185, '');
INSERT INTO `votes` VALUES(186, '');
INSERT INTO `votes` VALUES(187, '');
INSERT INTO `votes` VALUES(188, '');
INSERT INTO `votes` VALUES(189, '');
INSERT INTO `votes` VALUES(190, '');
INSERT INTO `votes` VALUES(191, '');
INSERT INTO `votes` VALUES(192, '');
INSERT INTO `votes` VALUES(193, '');
INSERT INTO `votes` VALUES(194, '');
INSERT INTO `votes` VALUES(195, '');
INSERT INTO `votes` VALUES(196, '');
INSERT INTO `votes` VALUES(197, '');
INSERT INTO `votes` VALUES(198, '');
INSERT INTO `votes` VALUES(199, '');
INSERT INTO `votes` VALUES(200, '');
INSERT INTO `votes` VALUES(201, '');
INSERT INTO `votes` VALUES(202, '');
INSERT INTO `votes` VALUES(203, '');
INSERT INTO `votes` VALUES(204, '');
INSERT INTO `votes` VALUES(205, '');
INSERT INTO `votes` VALUES(206, '');
INSERT INTO `votes` VALUES(207, '');
INSERT INTO `votes` VALUES(208, '');
INSERT INTO `votes` VALUES(209, '');
INSERT INTO `votes` VALUES(210, '');
INSERT INTO `votes` VALUES(211, '');
INSERT INTO `votes` VALUES(212, '');
INSERT INTO `votes` VALUES(213, '');
INSERT INTO `votes` VALUES(214, '');
INSERT INTO `votes` VALUES(215, 'technicien');
INSERT INTO `votes` VALUES(216, 'oui1');
INSERT INTO `votes` VALUES(217, 'oui2');
INSERT INTO `votes` VALUES(218, 'rugby');
INSERT INTO `votes` VALUES(219, 'un simulateur de f1');
INSERT INTO `votes` VALUES(220, '');
INSERT INTO `votes` VALUES(221, 'intervenant');
INSERT INTO `votes` VALUES(222, 'non1');
INSERT INTO `votes` VALUES(223, 'non2');
INSERT INTO `votes` VALUES(224, 'natation');
INSERT INTO `votes` VALUES(225, 'trampoline');
INSERT INTO `votes` VALUES(226, '');
INSERT INTO `votes` VALUES(227, 'etudiant');
INSERT INTO `votes` VALUES(228, 'oui1');
INSERT INTO `votes` VALUES(229, 'oui2');
INSERT INTO `votes` VALUES(230, 'foot');
INSERT INTO `votes` VALUES(231, 'babyfoot');
INSERT INTO `votes` VALUES(232, '');
INSERT INTO `votes` VALUES(233, 'etudiant');
INSERT INTO `votes` VALUES(234, 'non1');
INSERT INTO `votes` VALUES(235, 'non2');
INSERT INTO `votes` VALUES(236, 'rugby');
INSERT INTO `votes` VALUES(237, 'billard');
INSERT INTO `votes` VALUES(238, '');
INSERT INTO `votes` VALUES(239, 'etudiant');
INSERT INTO `votes` VALUES(240, 'non1');
INSERT INTO `votes` VALUES(241, 'non2');
INSERT INTO `votes` VALUES(242, 'rugby');
INSERT INTO `votes` VALUES(243, 'barre de pole dance');
INSERT INTO `votes` VALUES(244, '');
INSERT INTO `votes` VALUES(245, 'intervenant');
INSERT INTO `votes` VALUES(246, 'non1');
INSERT INTO `votes` VALUES(247, 'non2');
INSERT INTO `votes` VALUES(248, 'handball');
INSERT INTO `votes` VALUES(249, 'trampoline');
INSERT INTO `votes` VALUES(250, '');
INSERT INTO `votes` VALUES(251, 'administration');
INSERT INTO `votes` VALUES(252, 'non1');
INSERT INTO `votes` VALUES(253, 'non2');
INSERT INTO `votes` VALUES(254, 'rugby');
INSERT INTO `votes` VALUES(255, 'flechettes');
INSERT INTO `votes` VALUES(256, '');
INSERT INTO `votes` VALUES(257, '');
INSERT INTO `votes` VALUES(258, 'administration');
INSERT INTO `votes` VALUES(259, 'non1');
INSERT INTO `votes` VALUES(260, 'non2');
INSERT INTO `votes` VALUES(261, 'handball');
INSERT INTO `votes` VALUES(262, 'barre de pole dance');
INSERT INTO `votes` VALUES(263, '');
INSERT INTO `votes` VALUES(264, 'intervenant');
INSERT INTO `votes` VALUES(265, 'non1');
INSERT INTO `votes` VALUES(266, 'non2');
INSERT INTO `votes` VALUES(267, 'handball');
INSERT INTO `votes` VALUES(268, 'trampoline');
INSERT INTO `votes` VALUES(269, '');
INSERT INTO `votes` VALUES(270, 'intervenant');
INSERT INTO `votes` VALUES(271, 'non1');
INSERT INTO `votes` VALUES(272, 'non2');
INSERT INTO `votes` VALUES(273, 'handball');
INSERT INTO `votes` VALUES(274, 'barre de pole dance');
INSERT INTO `votes` VALUES(275, '');
INSERT INTO `votes` VALUES(276, 'intervenant');
INSERT INTO `votes` VALUES(277, '');
INSERT INTO `votes` VALUES(278, '');
INSERT INTO `votes` VALUES(279, '');
INSERT INTO `votes` VALUES(280, 'intervenant');
INSERT INTO `votes` VALUES(281, '');
INSERT INTO `votes` VALUES(282, '');
INSERT INTO `votes` VALUES(283, 'administration');
INSERT INTO `votes` VALUES(284, '');
INSERT INTO `votes` VALUES(285, 'administration');
INSERT INTO `votes` VALUES(286, 'non1');
INSERT INTO `votes` VALUES(287, 'oui2');
INSERT INTO `votes` VALUES(288, 'rugby');
INSERT INTO `votes` VALUES(289, 'un simulateur de f1');
INSERT INTO `votes` VALUES(290, '');
INSERT INTO `votes` VALUES(291, '');
INSERT INTO `votes` VALUES(292, '');
INSERT INTO `votes` VALUES(293, '');
INSERT INTO `votes` VALUES(294, '');
INSERT INTO `votes` VALUES(295, '');
INSERT INTO `votes` VALUES(296, '');
INSERT INTO `votes` VALUES(297, '');
INSERT INTO `votes` VALUES(298, '');
INSERT INTO `votes` VALUES(299, '');
INSERT INTO `votes` VALUES(300, '');
INSERT INTO `votes` VALUES(301, '');
INSERT INTO `votes` VALUES(302, '');
INSERT INTO `votes` VALUES(303, '');
INSERT INTO `votes` VALUES(304, '');
INSERT INTO `votes` VALUES(305, '');
INSERT INTO `votes` VALUES(306, '');
INSERT INTO `votes` VALUES(307, '');
INSERT INTO `votes` VALUES(308, '');
INSERT INTO `votes` VALUES(309, 'technicien');
INSERT INTO `votes` VALUES(310, 'oui1');
INSERT INTO `votes` VALUES(311, 'non2');
INSERT INTO `votes` VALUES(312, 'curling');
INSERT INTO `votes` VALUES(313, 'barre de pole dance');
INSERT INTO `votes` VALUES(314, '');
INSERT INTO `votes` VALUES(315, '');
INSERT INTO `votes` VALUES(316, 'autre');
INSERT INTO `votes` VALUES(317, 'oui1');
INSERT INTO `votes` VALUES(318, 'non2');
INSERT INTO `votes` VALUES(319, 'rugby');
INSERT INTO `votes` VALUES(320, 'flechettes');
INSERT INTO `votes` VALUES(321, '');
INSERT INTO `votes` VALUES(322, '');
INSERT INTO `votes` VALUES(323, 'administration');
INSERT INTO `votes` VALUES(324, 'non1');
INSERT INTO `votes` VALUES(325, 'non2');
INSERT INTO `votes` VALUES(326, 'handball');
INSERT INTO `votes` VALUES(327, 'trampoline');
INSERT INTO `votes` VALUES(328, '');
INSERT INTO `votes` VALUES(329, '');
INSERT INTO `votes` VALUES(330, '');
INSERT INTO `votes` VALUES(331, 'technicien');
INSERT INTO `votes` VALUES(332, 'non1');
INSERT INTO `votes` VALUES(333, 'oui2');
INSERT INTO `votes` VALUES(334, 'handball');
INSERT INTO `votes` VALUES(335, 'un simulateur de f1');
