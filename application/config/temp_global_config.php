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
 * TEST PLAYLIST ID: ETsGmQ-25bTg_X1BPDyIU_zHPn2dm0XF
 * LIVE PLAYLIST ID: SwXUlPkaY_FZ7R9AsTo1yJi7wRthcBtx
 */
define('YOUTUBE_PLAYLIST_ID' , 'SwXUlPkaY_FZ7R9AsTo1yJi7wRthcBtx'); //<- test id!