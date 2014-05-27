<?php

//////////////////////////IMPORTANT\\\\\\\\\\\\\\\\\\\\\\\\\


//  		MERGE THIS FILE INTO CONFIG.PHP AT DEPLOYMENT \\


//////////////////////////IMPORTANT\\\\\\\\\\\\\\\\\\\\\\\\\


// Test FB Page --- 570407576409153
// Live FB Page --- 1380611578866107
define('FB_PAGE_UID','570407576409153');

//The App ID and Secret key below is the test apps id
//251234321726333  ---  a793d6f12a3f87f0029e432be8dd3bec
define('FB_APP_ID','251234321726333');
define('FB_SECRET_KEY','a793d6f12a3f87f0029e432be8dd3bec');

/**
 * Configuration for: YouTube
 * Enter CustomersPlaylist ID
 * Do not include "PL" that is usually in the beginning of a Playlist ID
 *
 * TEST PLAYLIST ID: ETsGmQ-25bTg_X1BPDyIU_zHPn2dm0XF
 * LIVE PLAYLIST ID: SwXUlPkaY_FZ7R9AsTo1yJi7wRthcBtx
 */
define('YOUTUBE_PLAYLIST_ID' , 'SwXUlPkaY_FZ7R9AsTo1yJi7wRthcBtx'); //<- test id!

//If constant is false then countdown timer is visible and everything else hidden.
define('IS_SITE_LAUNCHED',TRUE);