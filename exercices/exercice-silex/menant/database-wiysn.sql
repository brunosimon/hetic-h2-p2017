-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 05 Juin 2014 à 20:22
-- Version du serveur: 5.5.33
-- Version de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `snippets-centis`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`) VALUES
(0, 'JS', 'js'),
(1, 'Autres', 'autres'),
(2, 'PHP', 'php'),
(3, 'HTML', 'html'),
(16, 'CSS', 'css');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`) VALUES
(1, 'About', '<p><font face="Helvetica Neue, Helvetica, arial, sans-serief"></font></p><p><font face="Helvetica Neue, Helvetica, arial, sans-serief">Ce site est un devoir <i><u>PHP</u></i> sur le Framework <strong>Silex</strong>. Il est conçu dans l''optique de progresser en développement web et particulièrement en PHP, et exercer seul (ou presque) dans ce travail de templating.</font></p><p></p><p><font face="Helvetica Neue, Helvetica, arial, sans-serief"><span class="Apple-tab-span" style="white-space: pre;">	</span></font></p><p><font face="Helvetica Neue, Helvetica, arial, sans-serief">Il s''agit d''un site regroupant des snippets déposés par les utilisateurs. Ils stockent du côté serveur toutes les informations de ces snippets : <strong>Nom</strong>, <strong>Description</strong> et <strong>Catégorie</strong> (PHP, Javascript, HTML, CSS, etc.)</font></p><br><p><font face="Helvetica Neue, Helvetica, arial, sans-serief">Je tiens personnellement à remercier <b>Guillaume JUVENET</b>&nbsp;pour sa grande aide sur le backend du site, et sur ces explications de Silex qui m''ont permis de mieux l''appréhender et de m''améliorer en PHP. Je remercie également <b>Bruno SIMON</b>, notre intervenant en <i>Développement Web</i> qui, pour sa première année d''enseignement, a été remarquable tant professionnellement que pédagogiquement parlant.</font></p><br><p><font face="Helvetica Neue, Helvetica, arial, sans-serief">Merci beaucoup pour toute cette année.</font></p><br><p><font face="Helvetica Neue, Helvetica, arial, sans-serief"><b>L''équipe wiYsn</b></font></p><p></p>');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Contenu de la table `snippets`
--

INSERT INTO `snippets` (`id`, `id_category`, `title`, `content`) VALUES
(3, 3, 'Template HTML5', 'Contenu snippet 333'),
(6, 1, 'Timeout / Interval', 'Contenu snippet 6'),
(7, 1, 'Geolocation', 'Contenu snippet 7'),
(9, 2, 'PDO prepare', 'Contenu snippet 9'),
(34, 16, 'Transition CSS3', '.trs {\r\n	-webkit-transition:all 0.2s cubic-bezier(0.68,0,0.34,1); -moz-transition:all 0.2s cubic-bezier(0.68,0,0.34,1); -o-transition:all 0.2s cubic-bezier(0.68,0,0.34,1); transition:all 0.2s cubic-bezier(0.68,0,0.34,1);\r\n}'),
(35, 16, 'Reset CSS', 'html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}\r\narticle,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'''';content:none}\r\ntable{border-collapse:collapse;border-spacing:0}\r\n*,*:before,*:after{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;}'),
(36, 16, 'CSS Architecture', 'strong,b{font-weight:bold; font-weight:600;}\r\ni{font-style:italic;}\r\nimg{height:auto;max-width:100%;width:auto\\9;}\r\na,a:hover,a:active,a:focus{text-decoration:none;}'),
(37, 2, 'cUrl Facebook', 'curl facebook'),
(38, 1, 'API Marvel', 'api marvel'),
(39, 0, 'jQuery slideUp', '$(id).slideUp();'),
(40, 0, 'jQuery animate', '$(id).animate(''background'', ''red'');'),
(41, 0, 'onClick event', 'window.onclick = function($e){\r\n	//function\r\n}'),
(42, 1, 'C Array', 'char text = [''h'',''e'',''l'',''l'',''o''];'),
(43, 2, 'Try Catch', 'try {\r\n	//function tried\r\n} catch {\r\n	//other function\r\n}'),
(44, 16, 'Animation CSS3', '.anim { animation:animkey 1s linear infinite; }'),
(45, 0, 'localStorage', 'localStorage snippet'),
(46, 3, 'Video HTML5', '<video></video>'),
(47, 3, 'Audio HTML5', '<audio></audio>'),
(48, 16, 'LESS Structure', 'for less '),
(49, 16, 'SASS Structure', 'Sass structure'),
(50, 16, 'Super CSS compass', 'compilator snippet'),
(51, 3, 'Form', '<form></form>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
