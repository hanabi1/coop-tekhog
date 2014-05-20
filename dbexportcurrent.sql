-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.34-0ubuntu0.13.04.1 - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for samhalls_sar
DROP DATABASE IF EXISTS `samhalls_sar`;
CREATE DATABASE IF NOT EXISTS `samhalls_sar` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `samhalls_sar`;


-- Dumping structure for table samhalls_sar.movies
DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `link` varchar(60) COLLATE utf8_bin NOT NULL,
  `author` varchar(30) COLLATE utf8_bin NOT NULL,
  `machinetitle` varchar(60) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table samhalls_sar.movies: ~18 rows (approximately)
DELETE FROM `movies`;
/*!40000 ALTER TABLE `movies` DISABLE KEYS */;
INSERT INTO `movies` (`id`, `title`, `description`, `link`, `author`, `machinetitle`) VALUES
	(1, 'Sker - It Will Only Get Better (Official Video) Directed by ', 'Directed & Edited by Jay Cee\n\ninfo@jayceemedia.co.uk\n\nwww.iamjaycee.me\nwww.iamjaycee.com\n@jayceemediatv\n\nhttp://www.facebook.com/pages/Sker-Music/231027110288473\nhttp://soundcloud.com/sker-1', 'Ed7e_gRF50Y', 'Léa Claudie Fritsch Penninck', 'sker-it-will-only-get-better-official-video-directed-by-jay-'),
	(2, 'CRONOS X LANDER KHADEL - LIGHTBULBS', 'ϟ\n\n\n\n\n\nCronos X Lander Khadel - Lightbulbs \n(prod. by Cronos, mixed & mastered by A Bomb)\n\nmp3 download - http://tinyurl.com/cronosxkhadellightbulbs\n\nalternative mp3 download link http://www.sendspace.com/file/o1inzv\n\nA Lander Khadel Film\n___________\n\nDirector | Editor | Producer - Lander Khadel\nCreative Direction - Cronos\nCamera Operation - Lukas Kadys\nLine Producer - Line Rindvig\n\nMale Dancer - Benjamin Mailing\nFemale MPC Player - Rachel Simone Schwab\n\nhttp://cronosxlanderkhadel.tumblr.com (photos by AdeDirector)\n\n@heiscronos\n@lander_khadel\n\nContact: Linerindvig@gmail.com', 'eyxaqrfppds', 'Léa Claudie Fritsch Penninck', 'cronos-x-lander-khadel-lightbulbs'),
	(3, 'AppleBottom - OoOoOoOh Baby', 'Eton Messy social networks:\nhttp://www.facebook.com/Etonmessy\nhttp://soundcloud.com/etonmessy\n\n★Feature\'s in Messy Mix 7★\nhttp://soundcloud.com/etonmessy/messy-mix-7-free-download\n\nArtist Links:\nAppleBottom\nhttp://soundcloud.com/ramshackle7\n\nI don\'t own the rights to the music. They belong to the artist/label.\nIf I have one of your tracks up here that you wish to be removed then please private message me.\n\nEnjoy the tunes people!', 'pmlGA72rBNA', 'Léa Claudie Fritsch Penninck', 'applebottom-oooooooh-baby'),
	(4, 'Karma Kid - Lust, Love', 'Eton Messy social networks:\nhttp://www.facebook.com/Etonmessy\nhttp://soundcloud.com/etonmessy\n\nArtist Links:\nKarma Kid - http://soundcloud.com/karmakidmusic\n\nI don\'t own the rights to the music. They belong to the artist/label.\nIf I have one of your tracks up here that you wish to be removed then please private message me.\n\nEnjoy the tunes people!', 'CCAAHPJ0iXw', 'Léa Claudie Fritsch Penninck', 'karma-kid-lust-love'),
	(5, 'Koloah - Air', 'Share on Facebook if you\'d like: http://tinyurl.com/8f4walb\n \n...one smooth bass driven track; the silky vocal sample draws you in even deeper. Top notch production from Koloah, and another solid release from Soulection.  \n\nDownload Link Koloah \'Moments\' EP on Soulection:\nhttp://soulection.bandcamp.com/album/moments\n\nSupport Koloah:\nhttp://soundcloud.com/koloah\nhttp://www.facebook.com/koloah\nhttp://twitter.com/Crim_dub\n\nSoulection label/blog/promoters:\nhttp://soulection.com/\nhttp://www.facebook.com/Soulection\nhttp://soundcloud.com/soulection\nhttp://twitter.com/#!/soulection\nhttp://soulection.bandcamp.com\n \nImage: http://fav.me/d4o1u92\n_________________________________________________\n\nthe_accidental_poet\nFacebook: http://www.facebook.com/theaccidentalpoet\nSoundcloud: http://soundcloud.com/the_accidental_poet\nTwitter: https://twitter.com/#!/poet_tunes\nFuture Bass Network: http://www.youtube.com/FutureBassNetwork\nFuture Chill Nework: http://www.youtube.com/FutureChillNetwork\n\nSend me your tunes at: http://soundcloud.com/the_accidental_poet/dropbox\nEmail: theaccidentalpoet2@gmail.com\n\nTags: Koloah Air Moments EP Soulection label ambient future bass beats soul vocal experimental Ukraine Los Angeles theaccidentalpoet2 the_accidental_poet', '1uyAnofVs0I', 'Léa Claudie Fritsch Penninck', 'koloah-air'),
	(6, 'OL - Combination', 'OL "Combination" from the Body Varial - EP on Error Broadcast\r\nLearn more at http://www.error-broadcast.com/\n\r\n\r-uploaded in HD at http://www.TunesToTube.com', 'EA1Ypo8cXKQ', 'Léa Claudie Fritsch Penninck', 'ol-combination'),
	(7, 'The xx - Angels', 'Buy the new album Coexist: http://thexx.info/coexist\n\nGet the lyrics to Angels here: http://bit.ly/ThexxAngelsLyrics\n\nAngels is taken from The xx\'s new album Coexist, out now on Young Turks.\n\nPhotography by Davy Evans.\n\nhttp://thexx.info\nhttp://theyoungturks.co.uk/', '_nW5AF0m9Zw', 'Léa Claudie Fritsch Penninck', 'the-xx-angels'),
	(8, 'THE XX - Sunset (Rocque & Waslewski Bootleg)', NULL, 'i3WzC6Z3Hik', 'Léa Claudie Fritsch Penninck', 'the-xx-sunset-rocque-waslewski-bootleg'),
	(9, 'Metro Area - Miura (Original mix)', 'Metro Area - Miura', 'jT9IPPuNDyg', 'Léa Claudie Fritsch Penninck', 'metro-area-miura-original-mix'),
	(10, 'Marko Darko - Mobbed Deeper (Darko\'s So Fly Booty)', 'My bootleg of Mobb Deep\'s massive Shook Ones Part 2.', 'RBiSBGJvfTs', 'Léa Claudie Fritsch Penninck', 'marko-darko-mobbed-deeper-darkos-so-fly-booty'),
	(11, 'Nari & Milani - Atom (Original Mix) HQ', '2014 mix https://soundcloud.com/ethanmonty/ethan-monty-may-mix\n\nDisclaimer- I do not own this song or any rights to this, all rights are reserved by the respective artists and record companies. This song is purely for promotional purposes and for other people to enjoy. If the owners wish for their song to be removed please let me know.\n\n"Copyright Disclaimer Under Section 107 of the Copyright Act 1976, allowance is made for "fair use" for purposes such as criticism, comment, news reporting, teaching, scholarship, and research. Fair use is a use permitted by copyright statute that might otherwise be infringing. Non-profit, educational or personal use tips the balance in favor of fair use"', 'MVpVRAbfFsk', 'Léa Claudie Fritsch Penninck', 'nari-milani-atom-original-mix-hq'),
	(12, 'rene aubry-killer kid', 'rene aubry-killer kid', 'kS4mxfVYRQo', 'Léa Claudie Fritsch Penninck', 'rene-aubry-killer-kid'),
	(13, 'Breden - Nightfall ft. G Anna (Requake Remix)', 'Free download :\nhttp://soundcloud.com/requake/bredren-nightfall-requake-remix\n\n\nSupport Requake :\nhttp://soundcloud.com/requake\nhttp://www.facebook.com/Requakeofficial\n\n\nSupport me : You know what to do.', 'Zmzt9opYsco', 'Léa Claudie Fritsch Penninck', 'breden-nightfall-ft-g-anna-requake-remix'),
	(14, 'DC SHOES: ROBBIE MADDISON\'S AIR.CRAFT', 'It\'s finally arrived. We\'re proud to present the very first DC TeamWorks video: Robbie Maddison\'s AIR.CRAFT. Filmed in a military service airplane graveyard in Tucson, Arizona this short film showcases Robbie\'s legendary freestyle motocross skills. From Step-ups to airborne shipping containers to backflips over planes, AIR.CRAFT features never before seen stunts. In addition to the film, we\'re also debuting Robbie Maddison\'s newest TeamWorks Collection and signature motocross gear, which can be seen at http://www.dcshoes.com/moto\n\nWatch the behind the scenes here: http://www.youtube.com/watch?v=sf-TCjVnDhk\n\n\nFollow DC Shoes & DC Moto: http://www.dcshoes.com/moto\n\nFacebook: http://www.facebook.com/dcshoes and http://www.facebook.com/dcmoto\nTwitter:@dcshoes\nInstagram: @dc_moto\n\n*Make sure to watch in 1080p!', '_VHaQeY88po', 'Léa Claudie Fritsch Penninck', 'dc-shoes-robbie-maddisons-aircraft'),
	(15, 'GoPro HERO3: Almost as Epic as the HERO3+', 'Shot 100% on the new HERO3® camera from http://GoPro.com.\n\nCapture and share your life\'s most meaningful experiences with the HERO3+ Black Edition. 20% smaller and lighter than its best-selling predecessor, it delivers improved image quality and powerful new features geared for versatility and convenience. SuperView™ is a new video mode that captures the world\'s most immersive wide angle perspective, while Auto Low Light mode intelligently adjusts frame rate for stunning low-light performance. Combined with 30% longer battery life, faster built-in Wi-Fi and a sharper lens, the HERO3+ Black Edition is the most advanced GoPro yet.\n\nSit back and enjoy the HERO3: Black Edition in all its glory. #GoPro\n\nFEATURED ATHLETES (in element, location & order of appearance)\n\n\nSNOW: (Mt. Cook, New Zealand)\n\nTom Wallisch\nEric Willett\nJulia Mancuso\n\n\nSKI BASE JUMP: (Earnslaw Burn, New Zealand)\n\nJT Holmes\n\n\nSURF: (Tahiti, French Polynesia)\n\nKelly Slater\nAnthony Walsh\nManoa Drollet\n\n\nDIVE: (Vava\'u, Tonga)\n\nMandy Rae Krack\nErin Magee\nAshleigh Baird\n\n\nMTB: (Queenstown, New Zealand and Squamish, BC, Canada)\n\nAaron Chase\nMike Montgomery\nKelly McGarry\nBrett Tippie\n\n\nKAYAK: (Turangi, Taupo, Aratiatia, Whangarei, and Maruia in New Zealand)\n\nBen Brown\nRush Sturges\n\n\nMOTO: (San Francisco, CA)\n\nJames Rispoli\nJosh Herrin\nJake Ellington\n\n\nAEROBATIC PILOT: (Queenstown, New Zealand)\n\nChuck Berry\n\n\nMUSIC:\n\nOVERWERK - "Daybreak"\n(GoPro HERO3 Edit) \n\nFrom the upcoming EP "After Hours"\n\nDownload the song FREE here: \nhttp://on.fb.me/SZlDsY\n\n\nSPECIAL THANKS!\n\n\nDIVE:\n\nKirk Krack - Performance Freediving \nhttp://www.performancefreediving.com\n\nDolphin Pacific \nhttp://www.dolphinpacificdiving.com/\n\nRiffe \nhttp://www.speargun.com\n\nAqua Lung\nhttp://www.aqualung.com\n\nSuunto \nhttp://www.suunto.com\n\nAndy Casagrande\nhttp://abc4explore.com/\n\n\nSNOW:\n\nMAP Productions Ltd\nhttp://mapproductions.co.nz/welcome/ \n\nThe Northface\nhttp://www.thenorthface.com\n\nHeliworks Helicopters\nhttp://www.heliworks.co.nz/ \n\n\nKAYAK:\n\nNgati Tuwharetoa\nTe Runanganui o Ngati Hikairo ki Tongariro\n\n\nSURF:\n\nThe Drollet Family\n\nhttp://matarai.com/\n\nTodd Glaser\nhttp://www.tglaser.com/', 'A3PDXmYoF5U', 'Léa Claudie Fritsch Penninck', 'gopro-hero3-almost-as-epic-as-the-hero3'),
	(16, 'Santigold - Disparate Youth [Official Music Video]', 'Get this track on iTunes - http://smarturl.it/santigold.dspyth.it\n\nMaster of My Make-Believe out now!\nDownload on iTunes - http://smarturl.it/santi.mmmb\n\nGet a free download of "Big Mouth" by signing up @ http://www.santigold.com\n\nDirected & Produced by Santigold and Sam Fleischner', 'mIMMZQJ1H6E', 'Léa Claudie Fritsch Penninck', 'santigold-disparate-youth-official-music-video'),
	(17, 'Uncut - Understanding the New Violence', 'Queer as Folk Soundtrack Season 4', 'yvuJ_9Ac8Fs', 'Léa Claudie Fritsch Penninck', 'uncut-understanding-the-new-violence'),
	(18, 'Telepopmusik - Smile', 'Landscape Version', 'E1sySOJSBt0', 'Léa Claudie Fritsch Penninck', 'telepopmusik-smile'),
	(19, 'Cara Delevingne Makeup Tutorial', 'Oilatum\nhttp://tidd.ly/8971b64a\n\nYSL Le Teinte  Touche Eclate\nhttp://tidd.ly/81e11271\n\n\nMAC Moisture Cover Concealer\nhttp://tidd.ly/b28d8485\n\nBEN NYE Media Pro Crème Contour Ultra Light\n\nChanel Soleil tan De Chanel\nhttp://tidd.ly/831b7be4\n\nLouise Young LY24 Brush\nhttp://www.pomshopltd.com/product-category/brands/louise-young/\n\nReal Techniques Expert Face Brush\nhttp://www.pomshopltd.com/product-category/brands/real-techniques/\n\nReal Techniques Base Shadow Brush\nhttp://www.pomshopltd.com/product-category/brands/real-techniques/\n\nReal Techniques Contour Brush\nhttp://www.pomshopltd.com/product-category/brands/real-techniques/\n\nMAC 217\nhttp://tidd.ly/f93b6d19\n\nMAC Omega\nhttp://tidd.ly/b3d5ab82\n\nMAC Brun\nhttp://tidd.ly/b3d5ab82\n\nIllamasqua Brow Gel\nhttp://tidd.ly/b3d5ab82\n\nIllamasqua Hollow\nhttp://www.pomshopltd.com/product-category/brands/illamasqua/\n\nBurberry Sheer Eye Shadow 06\n\n\nMAC Blacktrack\nhttp://tidd.ly/7b2bab16', 'iO1nJrCqm_A', 'Léa Claudie Fritsch Penninck', 'cara-delevingne-makeup-tutorial');
/*!40000 ALTER TABLE `movies` ENABLE KEYS */;


-- Dumping structure for table samhalls_sar.system
DROP TABLE IF EXISTS `system`;
CREATE TABLE IF NOT EXISTS `system` (
  `lastupdate` bigint(20) NOT NULL,
  `contactdetails` text COLLATE utf8_bin,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table samhalls_sar.system: ~1 rows (approximately)
DELETE FROM `system`;
/*!40000 ALTER TABLE `system` DISABLE KEYS */;
INSERT INTO `system` (`lastupdate`, `contactdetails`, `id`) VALUES
	(1400417671, NULL, 0);
/*!40000 ALTER TABLE `system` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
