--
-- Structure de la table `bad_words`
--

CREATE TABLE `bad_words` (
  `word` varchar(255) NOT NULL,
  PRIMARY KEY (`word`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bad_words`
--

INSERT INTO `bad_words` (`word`) VALUES
('connard'),
('enculé'),
('fils de pute'),
('merde'),
('nike ta mère');

-- --------------------------------------------------------

--
-- Structure de la table `chat_room`
--

CREATE TABLE `chat_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `chat_room`
--

INSERT INTO `chat_room` (`id`, `author`, `name`) VALUES
(1, 'Julia', 'Marketing'),
(2, 'Thomas', 'Le Web de demain !');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  `room_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Structure de la table `smiley`
--

CREATE TABLE `smiley` (
  `short` varchar(5) NOT NULL,
  `smiley` varchar(255) NOT NULL,
  PRIMARY KEY (`short`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `smiley`
--

INSERT INTO `smiley` (`short`, `smiley`) VALUES
(':)', 'happy.gif'),
('^1', 'angel.gif'),
('^2', 'dead.gif'),
('^3', 'bleh.gif'),
('^4', 'bye.gif'),
('^5', 'bop.gif'),
('^6', 'arms.gif');