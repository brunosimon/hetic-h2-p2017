-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 05, 2014 at 11:26 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `silex`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `title` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`) VALUES
(1, 'html-5', 'HTML 5'),
(2, 'js', 'Javascript'),
(3, 'css', 'CSS'),
(4, 'php', 'PHP'),
(5, 'jquery', 'jQuery');

-- --------------------------------------------------------

--
-- Table structure for table `snippets`
--

CREATE TABLE `snippets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `snippets`
--

INSERT INTO `snippets` (`id`, `title`, `content`, `category_id`, `date`) VALUES
(9, 'Random Color', '<?php \n    function randColor(){ \n        $letters = "1234567890ABCDEF"; \n        for($i=1;$i<6;$i++){ \n            $pos = rand(0,16); \n            $str .= $string{$pos}; \n        } \n        return "#".$str; \n    } \n    echo ''<span style="color:''.randColor().''">Random Color Text</span>''; \n?>', 4, '0000-00-00 00:00:00'),
(10, 'MYSQL table builder', '<?php \ninclude ''file/for/database/connection.php''; \nfunction displayTable($query = ""){ \n    $table = ''''; \n    $sql = mysql_query($query); \n    $table .= ''<table>''; \n    $table .= ''<tr>''; \n    while($field = mysql_fetch_field($sql)){ \n        $table .= ''<th>''.$field->name.''</th>''; \n    } \n    $table .= ''</tr>''; \n    while($row = mysql_fetch_assoc($sql)){ \n        $table .= ''<tr>''; \n        foreach($row as $key => $item){ \n            $table .= ''<td style="padding-right:50px;">''.htmlentities($item).''</td>''; \n        } \n        $table .= ''</tr>''; \n    } \n    $table .= ''</table>''; \n    return $table; \n} \necho displayTable("SELECT * FROM users"); // Displays all rows in the table \necho displayTable("SELECT username, email FROM users"); // displays only username and email in the table \n?>', 4, '0000-00-00 00:00:00'),
(11, 'Valid email check', '<?php \nif(isset($_POST[''email''])){ \n    $email = $_POST[''email'']; \n    if(filter_var($email, FILTER_VALIDATE_EMAIL)){ \n        echo ''<p>This is a valid email.<p>''; \n    }else{ \n        echo ''<p>This is an invalid email.</p>''; \n    } \n} \n?> \n<form action="" method="post">\n    Email: <input type="text" name="email" value=" <?php echo $_POST[''email'']; ?> ">\n    <input type="submit" value="Check Email">\n</form>', 4, '0000-00-00 00:00:00'),
(12, 'Cross Browser Vertically and Horizontally Centered Images in CSS without Tables', '<figure class=''logo''>\r\n    <span></span>\r\n    <img class=''photo''/>\r\n</figure>\r\n<style>\r\n.logo {\r\n  display: block;\r\n  text-align: center;\r\n  display: block;\r\n  text-align: center;\r\n  vertical-align: middle;\r\n  border: 4px solid #dddddd;\r\n  padding: 4px;\r\n  height: 74px;\r\n  width: 74px; }\r\n  .logo * {\r\n    display: inline-block;\r\n    height: 100%;\r\n    vertical-align: middle; }\r\n    .logo .photo {\r\n    height: auto;\r\n    width: auto;\r\n    max-width: 100%;\r\n    max-height: 100%; }\r\n</style>', 3, '0000-00-00 00:00:00'),
(13, 'Cross-Browser Transparency via CSS', 'selector {\n    filter: alpha(opacity=50); /* internet explorer */\n    -khtml-opacity: 0.5;      /* khtml, old safari */\n    -moz-opacity: 0.5;       /* mozilla, netscape */\n    opacity: 0.5;           /* fx, safari, opera */\n    }\n', 3, '0000-00-00 00:00:00'),
(14, 'CSS Fixed Footer', '#footer {\n   position:fixed;\n   left:0px;\n   bottom:0px;\n   height:30px;\n   width:100%;\n   background:#999;\n}\n \n/* IE 6 */\n* html #footer {\n   position:absolute;\n   top:expression((0-(footer.offsetHeight)+(document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight)+(ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop))+''px'');\n}', 3, '0000-00-00 00:00:00'),
(15, 'iPad Orientation CSS (Revised)', '<!-- css -->\r\n<style> \r\n@media only screen and (max-device-width: 1024px) and (orientation:portrait) { \r\n    .landscape { display: none; }\r\n}\r\n@media only screen and (max-device-width: 1024px) and (orientation:landscape) { \r\n    .portrait { display: none; }\r\n}\r\n</style>\r\n \r\n<!-- example markup -->\r\n<h1 class="portrait">Your device orientation is "portrait"<h1>\r\n<h1 class="landscape">Your device orientation is "landscape"<h1>', 3, '0000-00-00 00:00:00'),
(32, 'Glowing Blue Input Highlights', '<style>\r\ninput[type=text], textarea {\r\n  @include transition(all 0.30s ease-in-out);\r\n  outline: none;\r\n  padding: 3px 0px 3px 3px;\r\n  margin: 5px 1px 3px 0px;\r\n  border: 1px solid #DDDDDD;\r\n}\r\n \r\ninput[type=text]:focus, textarea:focus {\r\n  @include box-shadow(0 0 5px rgba(81, 203, 238, 1));\r\n  padding: 3px 0px 3px 3px;\r\n  margin: 5px 1px 3px 0px;\r\n  border: 1px solid rgba(81, 203, 238, 1);\r\n}\r\n</style>\r\n', 3, '0000-00-00 00:00:00'),
(34, 'Blurry Effect', '<style>\r\n.blur {\r\n   color: transparent;\r\n   text-shadow: 0 0 5px rgba(0,0,0,0.5);\r\n}\r\n</style>', 3, '0000-00-00 00:00:00'),
(37, 'Fix broken images automatically', '$(''img'').error(function(){\r\n$(this).attr(''src'', ''img/broken.png'');\r\n});', 2, '0000-00-00 00:00:00'),
(38, 'Toggle class on hover', '$(''.btn'').hover(function(){\r\n$(this).addClass(''hover'');\r\n}, function(){\r\n$(this).removeClass(''hover'');\r\n}\r\n);', 5, '0000-00-00 00:00:00'),
(39, 'Stop the loading of links', '$(''a.no-link'').click(function(e){\r\ne.preventDefault();\r\n});', 5, '0000-00-00 00:00:00'),
(41, 'Back to top button', '// Back To Top\n$(''a.top'').click(function(){\n$(document.body).animate({scrollTop : 0},800);\nreturn false;\n});\n//Create an anchor tag\n<a class=â€topâ€ href=â€#â€>Back to top</a>', 5, '0000-00-00 00:00:00'),
(43, 'Toggle fade/slide', '// Fade\r\n$( ".btn" ).click(function() {\r\n$( ".element" ).fadeToggle("slow");\r\n});\r\n// Toggle\r\n$( ".btn" ).click(function() {\r\n$( ".element" ).slideToggle("slow");\r\n});', 5, '0000-00-00 00:00:00'),
(44, 'Simple accordion', '// Close all Panels\r\n$(''#accordion'').find(''.content'').hide();\r\n// Accordion\r\n$(''#accordion'').find(''.accordion-header'').click(function(){\r\nvar next = $(this).next();\r\nnext.slideToggle(''fast'');\r\n$(''.content'').not(next).slideUp(''fast'');\r\nreturn false;\r\n});', 5, '0000-00-00 00:00:00'),
(45, ' Make two divs the same height', '$(''.div'').css(''min-height'', $(''.main-div'').height());', 5, '0000-00-00 00:00:00'),
(46, ' Zebra stripped unordered list', '$(''li:odd'').css(''background'', ''#E8E8E8'');', 5, '0000-00-00 00:00:00'),
(47, 'Wrapping Text Inside Pre Tags', 'height: 120px;\noverflow: auto;\nfont-family: ''Consolas'',monospace;\nfont-size: 9pt;\ntext-align:left;\nbackground-color: #FCF7EC;\noverflow-x: auto; /* Use horizontal scroller if needed; for Firefox 2, not\nwhite-space: pre-wrap; /* css-3 */\nwhite-space: -moz-pre-wrap !important; /* Mozilla, since 1999 */\nword-wrap: break-word; /* Internet Explorer 5.5+ */\nmargin: 0px 0px 0px 0px;\npadding:5px 5px 3px 5px;\nwhite-space : normal; /* crucial for IE 6, maybe 7? */', 3, '0000-00-00 00:00:00');
