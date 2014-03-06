<?php

class MoviesModel
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
    public function getAllMoviesFromDB()
    {
        $sql = "SELECT * FROM movies";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    public function getMovieFromDB($title)
    {
        $sql = "SELECT * FROM movies where :title = title";
        $query = $this->db->prepare($sql);
        $query->execute(array('title' => $title));

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    //This function gets Selected JSON entries from  Youtube API
    //Returns VALID JSON
    public function getAllMoviesFromAPI(){
        //IMPORTANT!! 
        //Enter CustomersPlaylist ID
        //do not include "PL" that is usually in the beginning of a Playlist ID
        $playlistID = 'ZPHv5MPkrmSOpM_-EH8NJrfZivJcduha'; // <- test id!
        
        //Starts cURL 
        $ch = curl_init();
        
        //Sets up the url to get
        curl_setopt($ch, CURLOPT_URL, 'http://gdata.youtube.com/feeds/api/playlists/' . $playlistID . '?v=2&alt=json');
        
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //Enables ÅÄÖ
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        
        //If server is slow, only wait 10 sec
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        
        //Variable that recieves RAW data from connection
        $output = curl_exec($ch);
        
        //Close connection, cleaning up...
        curl_close($ch);
         
        //Take all the raw JSON data and decode it
        $data = json_decode($output,true);
        
        //Count the number of movies in the JSON data
        $nVideo = count($data['feed']['entry']);
        
        //The output variable
        $moviesData = []; 
         
        //Get the (specific) relevant entries from the bulk Data
        //To the output variable
        for($i=0;$i<$nVideo;$i++) {

            $moviesData[]=$data['feed']['entry'][$i]['title']['$t'];
            $moviesData[]=$data['feed']['entry'][$i]['author'];
            $moviesData[]=$data['feed']['entry'][$i]['media$group']['media$description'];
            $moviesData[]=$data['feed']['entry'][$i]['media$group']['media$content'];
            $moviesData[]=$data['feed']['entry'][$i]['media$group']['media$credit'];
            $moviesData[]=$data['feed']['entry'][$i]['media$group']['media$keywords'];
        }
        //Return the relevant data as JSON
        return json_encode($moviesData);
    }
}
