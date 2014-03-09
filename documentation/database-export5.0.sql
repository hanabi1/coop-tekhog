CREATE DATABASE IF NOT EXISTS `samhalls_sar` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `samhalls_sar`;

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `link` varchar(60) COLLATE utf8_bin NOT NULL,
  `author` varchar(30) COLLATE utf8_bin NOT NULL,
  `machinetitle` varchar(60) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

DROP TABLE IF EXISTS `system`;
CREATE TABLE IF NOT EXISTS `system` (
  `lastupdate` bigint(20) NOT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `system` (`lastupdate`, `id`) VALUES
(1394359483, 0);