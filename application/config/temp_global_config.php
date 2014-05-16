<?php

//////////////////////////IMPORTANT\\\\\\\\\\\\\\\\\\\\\\\\\


//  		MERGE THIS FILE INTO CONFIG.PHP AT DEPLOYMENT \\


//////////////////////////IMPORTANT\\\\\\\\\\\\\\\\\\\\\\\\\

/**
 * Configuration for: YouTube
 * The backend will only update the DB from youtube when a user visits the site.
 * To keep youtube for beeing spammed wait at least this delay (in seconds) before updating.
 *
 * This value should be at least 10min(10min = 600sec) in final stages
 */
define('YOUTUBE_DELAY', 0);

/**
 * Configuration for: YouTube
 * Enter CustomersPlaylist ID
 * Do not include "PL" that is usually in the beginning of a Playlist ID
 *
 * LIVE PLAYLIST ID: SwXUlPkaY_FZ7R9AsTo1yJi7wRthcBtx
 */
define('YOUTUBE_PLAYLIST_ID' , 'PLETsGmQ-25bTg_X1BPDyIU_zHPn2dm0XF'); //<- test id!

function isDatabaseComplete(){

	try {
    	$db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';', DB_USER, DB_PASS);
	}catch (PDOException $e) {
	    echo 'Connection failed in isDatabaseComplete(): ' . $e->getMessage();
	    return 'ERROR';
	}

	$query = $db->prepare("SELECT Count(*) FROM INFORMATION_SCHEMA.Columns where TABLE_NAME = 'movies'");
	$query->execute();
	$movieTableCount = $query->fetch()['Count(*)'];

	$query = $db->prepare("SELECT Count(*) FROM INFORMATION_SCHEMA.Columns where TABLE_NAME = 'system'");
	$query->execute();
	$systemTableCount = $query->fetch()['Count(*)'];

	if(!$movieTableCount == 6 || !$systemTableCount ==2){
		return false;
	}
	return true;
}

function fixTablesAndDB(){

	//Temporary fix during development
	//If database is old or missing, create it hassle-free
	
	try {
    	$db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';', DB_USER, DB_PASS);
	}catch (PDOException $e) {
	    echo 'Connection failed in fixTablesAndDB(): ' . $e->getMessage();
	    return 'ERROR';
	}

	$query = $db->prepare("CREATE DATABASE IF NOT EXISTS ". DB_NAME ." DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
							USE ". DB_NAME .";
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
                                ");
	if($query->execute()==true){
		return 'SUCCESS';
	}
	
	return 'FAILED';
}