CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `link` varchar(60) COLLATE utf8_bin NOT NULL,
  `author` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

INSERT INTO `movies` (`id`, `title`, `description`, `link`, `author`) VALUES
(1, 'film1', 'test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1', '//www.youtube.com/embed/YJVmu6yttiw', 'Mr. Rabbit'),
(2, 'test2', 'test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2', '//www.youtube.com/embed/YJVmu6yttiw', 'Mr.TwoTime'),
(3, 'test3', 'test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3', '//www.youtube.com/embed/YJVmu6yttiw', 'Jane Doe'),
(4, 'test4', 'test4test4test4test4test4test4test4test4test4test4test4test4test4test4test4test4vv', '//www.youtube.com/embed/YJVmu6yttiw', 'John Doe');

CREATE TABLE IF NOT EXISTS `system` (
  `lastupdate` bigint(20) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

INSERT INTO `system` (`lastupdate`, `id`) VALUES
(1394133431, 0);

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_bin NOT NULL,
  `password` varchar(25) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
