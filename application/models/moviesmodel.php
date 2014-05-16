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
            fixTablesAndDB();
            try {
                $this->db = $db;
            }catch (PDOException $e) {
                echo 'FAIL <br>' . $e;
                exit;
            }
        }
    
        if(!isDatabaseComplete()){
            fixTablesAndDB();
        }

    }

    /**
     * Get all songs from database
     */
    public function getAllMoviesFromDB()
    {
        $sql = "SELECT * FROM movies ORDER BY RAND()";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    public function getMovieFromDB($machineTitle)
    {
        $sql = "SELECT * FROM movies where :machinetitle = machinetitle ";
        $query = $this->db->prepare($sql);
        $query->execute(array('machinetitle' => $machineTitle));

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
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
        $moviesData = []; 
         
        //Get the (specific) relevant entries from the bulk Data
        //To the output variable
        for($i=0;$i<$nVideo;$i++) {

            $moviesData[$i]=array('videoid'=> $data['feed']['entry'][$i]['media$group']['yt$videoid']['$t']);
            $moviesData[$i]+=array('title'=> $data['feed']['entry'][$i]['title']['$t']);
            $moviesData[$i]+=array('author'=> $data['feed']['entry'][$i]['author'][0]['name']['$t']);
            $moviesData[$i]+=array('description'=> 'temp description');
            $moviesData[$i]+=array('link'=> $data['feed']['entry'][$i]['media$group']['yt$videoid']['$t'] . '?modestbranding=1');
        }
        //Return the relevant data as JSON
        return $moviesData;
    }

    public function cacheMoviesToDB($freshMovies){
        if(!isset($freshMovies)){
            return false;
        }
        
        //Clear table
        //TRUNCATE is faster than DELETE
        $sql = "TRUNCATE TABLE movies";
        $query = $this->db->prepare($sql);
        $query->execute();


        //Insert all the freshmovies into DB
        //We use placeholders :example that we populate before execution
        $sql = "INSERT INTO movies (title,machinetitle,description,link,author)
               VALUES (:title,:machinetitle,:description,:link,:author)";

        //Load up the statement we just used
        $query = $this->db->prepare($sql);

        //Here we tell PDO we will do a lot of queries after one another
        //so PDO will give us Top Speed!
        $this->db->beginTransaction();

        //Loop over all the movies in the variable $freshMovies
        //Send them off one by one in the transaction
        foreach ($freshMovies as $movie) {
            $query->execute(array('title'=>$movie['title'],
                                  'machinetitle'=>$movie['machinetitle'],
                                  'description'=>$movie['description'],
                                  'link'=>$movie['link'],
                                  'author'=>$movie['author']
                            ));
        }

        //return the status of the transaction
        return $this->db->commit();
    }

    public function getLastDatabaseRefresh(){
        $sql = "SELECT lastupdate FROM system where id = 0";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch()['lastupdate'];
    }
    public function setNewDatabaseRefreshTime($currentTimeStamp){
        $sql = "UPDATE system
                SET lastupdate = :currentTimeStamp
                WHERE id=0";
        $query = $this->db->prepare($sql);

        return $query->execute(array('currentTimeStamp'=>$currentTimeStamp));
    }
}