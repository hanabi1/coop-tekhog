<?php

/**
 * A simple PHP MVC skeleton
 *
 * @package php-mvc
 * @author Panique
 * @link http://www.php-mvc.net
 * @link https://github.com/panique/php-mvc/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// load the (optional) Composer auto-loader
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
}


// load application config (error reporting etc.)
require 'application/config/config.php';
// Include Youtube Delay, Youtube Pĺaylist ID etc
// After the project moves from git merge this into config.php
require 'application/config/temp_global_config.php';

// load application class
require 'application/libs/application.php';
require 'application/libs/controller.php';

// start the application
$app = new Application();
