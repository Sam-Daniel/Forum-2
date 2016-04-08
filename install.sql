CREATE TABLE IF NOT EXISTS `forum_posts` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) NOT NULL,
  `author` int(11) NOT NULL,
  `category` varchar(128) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `forum_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) NOT NULL,
  `post` int(11) NOT NULL,
  `reply` int(11) NOT NULL DEFAULT 0,
  `layer` int(11) NOT NULL DEFAULT 0,
  `author` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `forum_profile` (
  `uid` int(11) NOT NULL,
  `steam` varchar(128) NOT NULL DEFAULT "",
  `youtube` varchar(128) NOT NULL DEFAULT "",
  `twitch` varchar(128) NOT NULL DEFAULT "",
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;