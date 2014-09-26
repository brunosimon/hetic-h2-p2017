-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 05 Juin 2014 à 21:41
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `devoir_silex_snippets`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `content` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`id`, `prenom`, `nom`, `email`, `content`) VALUES
(24, 'Bruno', 'Simon', 'bruno.simon@gmail.com', 'Bonjour !\r\nJe tiens Ã  vous dire que votre site de Snippets est une veritable merveille ! \r\nIl a change ma vie, MERCI !'),
(26, 'CÃ©ci', 'Lalan', 'cecile.lalanne@gmail.com', 'Bonjour !\r\nNos snippets sont-ils valides avant la publication sur le site ?'),
(27, 'Marion', 'Ribes', 'marion.ribes@hotmail.fr', 'Super site ! <3');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

--
-- Contenu de la table `snippets`
--

INSERT INTO `snippets` (`id`, `id_category`, `title`, `content`) VALUES
(81, 1, 'Close Window', '<form>\r\n       <input type=button value="Close Window" onClick="javascript:window.close();">\r\n</form> '),
(82, 1, 'Break out of Frames', '<body onLoad="if (self != top) top.location = self.location">'),
(83, 1, 'IP Adress', '<SCRIPT LANGUAGE="JavaScript">\r\nvar ip = ''<!--#echo var="REMOTE_ADDR"-->'';\r\ndocument.write("Your IP address is" + ip);\r\n</script>'),
(84, 4, 'Fade In and Out', '@-webkit-keyframes fadeInOut {\r\n  from { opacity: 1; }\r\n  to   { opacity: 0; }\r\n}\r\n@keyframes fadeInOut {\r\n  from { opacity: 1; }\r\n  to   { opacity: 0; }\r\n}'),
(85, 4, 'Shrink and Grow', '@-webkit-keyframes shrinkGrow {\r\n  from { width: 200px; height: 200px; }\r\n  to   { width: 100px; height: 100px; }\r\n}\r\n@keyframes shrinkGrow {\r\n  from { width: 200px; height: 200px; }\r\n  to   { width: 100px; height: 100px; }\r\n}'),
(86, 3, 'Nav', '<nav class="$1">\r\n    <ul>\r\n        <li><a href="#">$2</a></li><li><a href="#">$3</a></li><li><a href="#">$4</a></li><li><a href="#">$5</a></li>\r\n    </ul>\r\n</nav>'),
(87, 2, 'Print_r', 'echo ''<pre>'';\r\nprint_r($data);\r\necho ''</pre>'';'),
(88, 3, 'Doctype', '<!doctype html>\r\n<html>\r\n    <head>\r\n        <meta charset="utf-8">\r\n        <meta name="description" content="$1">\r\n        <meta name="viewport" content="width=device-width, initial-scale=1">\r\n        <title>${2:Untitled}</title>\r\n        <link rel="stylesheet" href="css/style.css">\r\n        <link rel="author" href="humans.txt">\r\n    </head>\r\n    <body>\r\n        $3\r\n        <script src="js/main.js"></script>\r\n    </body>\r\n</html>'),
(89, 2, 'Image Magick', '$pdf_file   = ''./pdf/demo.pdf'';\r\n$save_to    = ''./jpg/demo.jpg'';     //make sure that apache has permissions to write in this folder! (common problem)\r\n\r\n//execute ImageMagick command ''convert'' and convert PDF to JPG with applied settings\r\nexec(''convert "''.$pdf_file.''" -colorspace RGB -resize 800 "''.$save_to.''"'', $output, $return_var);\r\n\r\n\r\nif($return_var == 0) {              //if exec successfuly converted pdf to jpg\r\n    print "Conversion OK";\r\n}\r\nelse print "Conversion failed.<br />".$output;'),
(90, 2, 'CSV file', 'function generateCsv($data, $delimiter = '','', $enclosure = ''"'') {\r\n       $handle = fopen(''php://temp'', ''r+'');\r\n       foreach ($data as $line) {\r\n               fputcsv($handle, $line, $delimiter, $enclosure);\r\n       }\r\n       rewind($handle);\r\n       while (!feof($handle)) {\r\n               $contents .= fread($handle, 8192);\r\n       }\r\n       fclose($handle);\r\n       return $contents;\r\n}');
