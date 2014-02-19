<?php

class AdminModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get all songs from database
     */
    public function getAllMovies()
    {
        return array('title' => 'moderaterna - inside story',
                     'json' => 'www.youtube.com/XjnxjhX5');
    }

}
