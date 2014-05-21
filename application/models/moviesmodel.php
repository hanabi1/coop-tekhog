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
            try {
                $this->db = $db;
            }catch (PDOException $e) {
                exit;
            }
        }

    }
    
    //This function gets Selected JSON entries from Youtube API
    //If connection come more oftan then YOUTUBE_DELAY allows then the local DB is queried
    //Returns VALID JSON
    public function getAllMoviesFromAPI(){
       
        //Starts cURL 
        $ch = curl_init();
        
        //Sets up the url to get
        curl_setopt($ch, CURLOPT_URL, 'http://gdata.youtube.com/feeds/api/playlists/' . YOUTUBE_PLAYLIST_ID . '?v=2&alt=json');
        
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
        $moviesData = array(); 
         
        //Get the (specific) relevant entries from the bulk Data
        //To the output variable
        for($i=0;$i<$nVideo;$i++) {

            $moviesData[$i]=array('videoid'=> $data['feed']['entry'][$i]['media$group']['yt$videoid']['$t']);
            $moviesData[$i]+=array('title'=> $data['feed']['entry'][$i]['title']['$t']);
            $moviesData[$i]+=array('author'=> $data['feed']['entry'][$i]['author'][0]['name']['$t']);
            //$moviesData[$i]+=array('description'=> $data['feed']['entry'][$i]['media$group']['media$description']['$t']);
            $moviesData[$i]+=array('link'=> $data['feed']['entry'][$i]['media$group']['yt$videoid']['$t']);
        }
        
        //Shuffle the movies
        shuffle($moviesData);
        
        //Return the relevant data as JSON
        return $moviesData;
    }
}