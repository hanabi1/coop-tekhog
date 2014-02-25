DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `link` varchar(60) COLLATE utf8_bin NOT NULL,
  `author` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

INSERT INTO `movies` (`id`, `title`, `description`, `link`, `author`) VALUES
(1, 'film1', 'test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1', 'http://youtu.be/i1p9AxZSOmA', 'Mr. Rabbit'),
(2, 'test2', 'test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2', 'http://youtu.be/i1p9AxZSOmA', 'Mr.TwoTime'),
(3, 'test3', 'test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3test3', 'http://youtu.be/i1p9AxZSOmA', 'Jane Doe'),
(4, 'test4', 'test4test4test4test4test4test4test4test4test4test4test4test4test4test4test4test4vv', 'http://youtu.be/i1p9AxZSOmA', 'John Doe');
