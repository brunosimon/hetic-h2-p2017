-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 09 Février 2014 à 21:12
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `hetic-poll`
--

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id_answer` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `text` varchar(250) NOT NULL,
  `img` varchar(254) NOT NULL,
  PRIMARY KEY (`id_answer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `answers`
--

INSERT INTO `answers` (`id_answer`, `id_question`, `value`, `text`, `img`) VALUES
(1, 1, 1, 'Une armure', ''),
(2, 1, 2, 'Les collants', ''),
(3, 1, 3, 'Je laisse ça aux tapettes', ''),
(4, 1, 4, 'Le second', ''),
(5, 2, 1, 'Mon cerveau je présume', ''),
(6, 2, 2, 'Tout dans le biceps', ''),
(7, 2, 3, 'Mercurochrome ne m''aime pas', ''),
(8, 2, 4, 'Ma voix sensuelle', ''),
(9, 3, 1, 'Bien sûr, pourquoi je me cacherai ?', ''),
(10, 3, 2, 'Oui, Papa et Maman le saurait', ''),
(11, 3, 3, 'S''ils le sont eux-même', ''),
(12, 3, 4, 'En aucun cas !', ''),
(13, 4, 1, 'Le super héros le plus cool de la planète', ''),
(14, 4, 2, 'Le super héros qui sauve le plus de monde', ''),
(15, 4, 3, 'Le super héros incompris', ''),
(16, 4, 4, 'Le superhéros mystérieux', ''),
(17, 5, 1, 'La guerre', ''),
(18, 5, 2, 'Je suis né comme ça', ''),
(19, 5, 3, 'Le résultat d''une expérience', ''),
(20, 5, 4, 'Je préfère ne pas en parler, c''est personnel', ''),
(21, 6, 1, 'Prétentieux', ''),
(22, 6, 2, 'Trop gentil', ''),
(23, 6, 3, 'Trop solitaire', ''),
(24, 6, 4, 'Trop silencieux', ''),
(25, 7, 1, 'Ma maison ne suffit-elle pas ?', ''),
(26, 7, 2, 'Je ne pense pas que ce soit nécessaire', ''),
(27, 7, 3, 'Le monde est ma cachette', ''),
(28, 7, 4, 'Une base sur-équipée', ''),
(29, 8, 1, 'Un terroriste fou', ''),
(30, 8, 2, 'Un business-man jaloux', ''),
(31, 8, 3, 'Une expérience ratée', ''),
(32, 8, 4, 'Un génie complêtement barge', ''),
(33, 9, 1, 'Rire de ses ennemis', ''),
(34, 9, 2, 'Prendre pitié de ses ennemis', ''),
(35, 9, 3, 'Tuer ses ennemis', ''),
(36, 9, 4, 'Enfermer ses ennemis', '');

-- --------------------------------------------------------

--
-- Structure de la table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id_profile` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id_profile`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `profiles`
--

INSERT INTO `profiles` (`id_profile`, `name`, `img`, `description`) VALUES
(1, 'Iron Man', 'http://i.imgur.com/tHKXhEn.jpg', 'Votre cerveau fonctionne mieux que vos biceps ? Aucun problème ! Après tout, vous êtes le super héros le plus cool que la terre ai pu porter ! Le seul et unique Iron Man ! Un joueur, aussi bien avec votre vie (avouer qu’annoncer à la presse votre lieu de résidence et votre identité n’est pas très judicieux) qu’avec vos ennemis. Vous pouvez cependant toujours compter sur vos armures et J.A.R.V.I.S. Vous êtes un génie et vous le savez, évitez simplement de le répéter à tout va, ça peut en irriter certains.'),
(2, 'Superman', 'http://i.imgur.com/dIBCYOY.jpg', 'L’homme de fer, voilà qui en ravira plus d’un ! Vous êtes l’indestructible protecteur de la veuve et l’orphelin ! Soucieux de vos proches, vous êtes parfois considéré comme un grand cœur bien naïf. Mais qu’à cela ne tienne, vous êtes né pour faire le bien et aider le monde. Après tout, à quoi vous servirai tous ces super pouvoirs si ce n’était pour cela. Lex Luthor n’a qu’à bien se tenir, vous êtes prêts à lui en faire voir de toutes les couleurs ! Le monde a besoin de vous et vous appelle !'),
(3, 'Wolverine', 'http://i.imgur.com/0ErLeA8.jpg', 'La bête qui est en vous sommeille, ne la faites pas attendre plus longtemps. Vos griffes vous démangent et réclament justice. Enfin, pour être plus précis, VOTRE justice. Car bien loin du héros conventionnel, vous faites partie de ces loups solitaires qui ne vivent que pour eux et n’ont de comptes à régler à personne. Enfermer vos ennemis ? Cette idée ne vous est même pas venue à l’esprit. Ils n’auraient jamais dû croiser votre route.  On tape puis on questionne, non ?'),
(4, 'Batman', 'http://i.imgur.com/DuC8w2H.jpg', 'L’homme de la nuit, ombre parmi les ombres, le justicier qui représente la vengeance. Malgré votre inexistence de super pouvoir, vous faites régner la justice de par votre intelligence et vote ingéniosité. Il n’est pas né le super héros qui vous donnera l’impression de lui être inférieur. Eternel homme mystérieux, vous multipliez les idées et les entraînements pour vous préparer à n’importe quelle situation. Le Joker va retourner à l’asile sous peu et vous n’y serez pas pour rien !');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `ordre` int(11) NOT NULL,
  `text` varchar(100) NOT NULL,
  PRIMARY KEY (`id_question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`id_question`, `ordre`, `text`) VALUES
(1, 1, 'L''accessoire indispensable ?'),
(2, 2, 'Quel est ton principal atout ?'),
(3, 3, 'Si tu étais un super héros, le dirais-tu à tes proches ?'),
(4, 4, 'Tu voudrais être reconnu comme ...'),
(5, 5, 'Comment préfèrerais-tu devenir un super héros ?'),
(6, 6, 'Quel est ton principal défaut ?'),
(7, 7, 'Une cachette secrète ?'),
(8, 8, 'Quel genre d''ennemi aurais-tu ?'),
(9, 9, 'Pour toi, il faut ...');

-- --------------------------------------------------------

--
-- Structure de la table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `id_result` int(11) NOT NULL AUTO_INCREMENT,
  `id_profile` int(11) NOT NULL,
  `date` date NOT NULL,
  `token` varchar(16) NOT NULL,
  PRIMARY KEY (`id_result`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- Contenu de la table `results`
--

INSERT INTO `results` (`id_result`, `id_profile`, `date`, `token`) VALUES
(1, 2, '2014-02-09', 'GUsYf1q4DEFt9ein'),
(43, 1, '2014-02-09', 'IMh4Cljv0DcPXSK2'),
(62, 1, '2014-02-09', 'wB1aQNZ10aRZzt1y'),
(63, 3, '2014-02-09', 'EVhGPd1QcA2ZlLIC'),
(64, 4, '2014-02-09', 'nWTFTRTCYJzsdggD'),
(86, 4, '2014-02-09', 'mC9kKVwB7k4HGDJc');

-- --------------------------------------------------------

--
-- Structure de la table `user_answers`
--

CREATE TABLE IF NOT EXISTS `user_answers` (
  `id_user_answer` int(11) NOT NULL AUTO_INCREMENT,
  `token_user` varchar(16) NOT NULL,
  `id_answer` int(11) NOT NULL,
  PRIMARY KEY (`id_user_answer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- Contenu de la table `user_answers`
--

INSERT INTO `user_answers` (`id_user_answer`, `token_user`, `id_answer`) VALUES
(1, 'PlthTJeAOA04PKMm', 1),
(2, 'PlthTJeAOA04PKMm', 5),
(3, 'PlthTJeAOA04PKMm', 9),
(4, 'PlthTJeAOA04PKMm', 13),
(5, 'PlthTJeAOA04PKMm', 17),
(6, 'PlthTJeAOA04PKMm', 21),
(7, 'PlthTJeAOA04PKMm', 25),
(8, 'PlthTJeAOA04PKMm', 29),
(9, 'PlthTJeAOA04PKMm', 33),
(10, 'Cx1wqPH9YXimsLKI', 1),
(11, 'Cx1wqPH9YXimsLKI', 8),
(12, 'Cx1wqPH9YXimsLKI', 10),
(13, 'Cx1wqPH9YXimsLKI', 13),
(14, 'Cx1wqPH9YXimsLKI', 19),
(15, 'Cx1wqPH9YXimsLKI', 21),
(16, 'Cx1wqPH9YXimsLKI', 25),
(17, 'Cx1wqPH9YXimsLKI', 29),
(18, 'Cx1wqPH9YXimsLKI', 34),
(19, 'GUsYf1q4DEFt9ein', 2),
(20, 'GUsYf1q4DEFt9ein', 7),
(21, 'GUsYf1q4DEFt9ein', 10),
(22, 'GUsYf1q4DEFt9ein', 14),
(23, 'GUsYf1q4DEFt9ein', 18),
(24, 'GUsYf1q4DEFt9ein', 21),
(25, 'GUsYf1q4DEFt9ein', 25),
(26, 'GUsYf1q4DEFt9ein', 32),
(27, 'GUsYf1q4DEFt9ein', 33),
(28, 'IMh4Cljv0DcPXSK2', 2),
(29, 'IMh4Cljv0DcPXSK2', 6),
(30, 'IMh4Cljv0DcPXSK2', 9),
(31, 'IMh4Cljv0DcPXSK2', 14),
(32, 'IMh4Cljv0DcPXSK2', 20),
(33, 'IMh4Cljv0DcPXSK2', 21),
(34, 'IMh4Cljv0DcPXSK2', 26),
(35, 'IMh4Cljv0DcPXSK2', 30),
(36, 'IMh4Cljv0DcPXSK2', 35),
(37, 'wB1aQNZ10aRZzt1y', 1),
(38, 'wB1aQNZ10aRZzt1y', 8),
(39, 'wB1aQNZ10aRZzt1y', 11),
(40, 'wB1aQNZ10aRZzt1y', 13),
(41, 'wB1aQNZ10aRZzt1y', 20),
(42, 'wB1aQNZ10aRZzt1y', 21),
(43, 'wB1aQNZ10aRZzt1y', 26),
(44, 'wB1aQNZ10aRZzt1y', 29),
(45, 'wB1aQNZ10aRZzt1y', 34),
(46, 'EVhGPd1QcA2ZlLIC', 3),
(47, 'EVhGPd1QcA2ZlLIC', 7),
(48, 'EVhGPd1QcA2ZlLIC', 11),
(49, 'EVhGPd1QcA2ZlLIC', 15),
(50, 'EVhGPd1QcA2ZlLIC', 19),
(51, 'EVhGPd1QcA2ZlLIC', 22),
(52, 'EVhGPd1QcA2ZlLIC', 25),
(53, 'EVhGPd1QcA2ZlLIC', 31),
(54, 'EVhGPd1QcA2ZlLIC', 35),
(55, 'nWTFTRTCYJzsdggD', 4),
(56, 'nWTFTRTCYJzsdggD', 8),
(57, 'nWTFTRTCYJzsdggD', 12),
(58, 'nWTFTRTCYJzsdggD', 16),
(59, 'nWTFTRTCYJzsdggD', 20),
(60, 'nWTFTRTCYJzsdggD', 24),
(61, 'nWTFTRTCYJzsdggD', 28),
(62, 'nWTFTRTCYJzsdggD', 29),
(63, 'nWTFTRTCYJzsdggD', 36),
(64, 'mC9kKVwB7k4HGDJc', 2),
(65, 'mC9kKVwB7k4HGDJc', 6),
(66, 'mC9kKVwB7k4HGDJc', 10),
(67, 'mC9kKVwB7k4HGDJc', 16),
(68, 'mC9kKVwB7k4HGDJc', 17),
(69, 'mC9kKVwB7k4HGDJc', 24),
(70, 'mC9kKVwB7k4HGDJc', 28),
(71, 'mC9kKVwB7k4HGDJc', 29),
(72, 'mC9kKVwB7k4HGDJc', 33);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
