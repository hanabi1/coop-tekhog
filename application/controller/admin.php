<?php

/**
 * Class Admin
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Admin extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // debug message to show where you are, just for the demo
        echo 'Message from Controller: You are in the controller Admin, using the method index()';

        $admin_model = $this->loadModel('AdminModel');
        $movies = $admin_model->getAllMovies();

        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/header.php';
        require 'application/views/admin/index.php';
        require 'application/views/_templates/footer.php';
    }

    public function login()
    {
        // debug message to show where you are, just for the demo
        echo 'this is login page in admin controller';

        // load views. 
        require 'application/views/_templates/header.php';
        require 'application/views/admin/login.php';
        require 'application/views/_templates/footer.php';
    }
}
