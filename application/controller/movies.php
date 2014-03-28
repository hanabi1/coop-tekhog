<?php
class Movies extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        echo $this->dressTemplate('/_templates/head', array('title'=> $this->pageTitle));        
        require 'application/views/_templates/header.php';
        require 'application/views/home/index.php';
        require 'application/views/_templates/footer.php';
    }

    public function title($movieTitle = '')
    {

        $movieModel = $this->loadModel('MoviesModel');
        $result = $movieModel->getMovieFromDB($movieTitle);
        if(!count($result)){
            header('location: ' . URL);
        }
        var_dump($result);
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        echo $this->dressTemplate('/_templates/head', array('title'=> $this->pageTitle));        
        require 'application/views/_templates/header.php';
        require 'application/views/home/index.php';
        require 'application/views/_templates/footer.php';
    }




    public function getallmovies()
    {
        header('Content-Type: application/json; charset=utf-8');        
        $movieModel = $this->loadModel('MoviesModel');   

        //Check if it is time to get new movies from the API
        if($this->isItTimeToCache() === true){
           //Start the Caching rutine that stores all movies from API in database
           $this->updateCache();         
        }
        
        echo json_encode($movieModel->getAllMoviesFromDB(),JSON_UNESCAPED_UNICODE);
    }

    public function getmovie($title)
    {

        header('Content-Type: application/json; charset=utf-8');   
        
        $movieModel = $this->loadModel('MoviesModel');   
        
        //Check if it is time to get new movies from the API
        if($this->isItTimeToCache() === true){
           //Start the Caching rutine that stores all movies from API in database
           $this->updateCache();         
        }

        //Return one movie as JSON
        echo json_encode($movieModel->getMovieFromDB(strtolower($title)),JSON_UNESCAPED_UNICODE); 
    }

    private function isItTimeToCache(){

        $movieModel = $this->loadModel('MoviesModel');   

        //Get the last database update time to prevent spamming of the Youtube API
        $lastRefreshTime = $movieModel->getLastDatabaseRefresh();    
        
        //Get the current UNIX time (all the seconds from around 1970 =)
        $currentUnixTime = time();

        //If the specified amount of time has passes since last update then update all movies
        if($currentUnixTime >= ($lastRefreshTime + YOUTUBE_DELAY)){
            //Database needs an update
            return true;
        }

        //Database was allready updated recently
        return false;
    }

    private function updateCache(){
        $movieModel = $this->loadModel('MoviesModel');   

        //Get fresh movies from the API
        $freshMovies = $movieModel->getAllMoviesFromAPI(); 

        //Generates Machinetitles for the movies.
        //Populates the 'machineTitle' element for each movie in the array.
        //This is needed so we can access the movies though the URL /root/movies/overvag-nu-denna-titel.
        //
        //Example: 'Överväg Nu Denna Titel!' --> 'overvag-nu-denna-titel'
        $freshMovies = $this->addMachineTitles($freshMovies);

        //Cache the fresh movies to DB so we can get them for the next user
        $movieModel->cacheMoviesToDB($freshMovies);  

        //Update the last cache-refresh time
        //So we know when to cache next time
        $movieModel->setNewDatabaseRefreshTime(time()); 
    }

    private function addMachineTitles($movies=''){
        if(!$movies){
            return false;
        }

        //Loops over all movie elements and creates a machinetitle from the title index
        //Here follows a string example with what is happening.
        //
        //Original exampĺe string.
        //'Överväg_Nu    Denna Titel!'
        for($i=0;$i<count($movies);$i++){
           
            //Transform all chars into lowercase
            //String now becomes 'överväg_nu    denna titel!'
            $movies[$i]['machinetitle'] = strtolower($movies[$i]['title']);
            
            //Set the chars set to change
            $charsToChange = array('å' => 'a',
                                   'ä' => 'a',
                                   'ö' => 'o',
                                   ' ' => '-',
                                   '_' => '-');
            //String now becomes 'overvag-nu----denna-titel!'
            $movies[$i]['machinetitle'] = strtr($movies[$i]['machinetitle'],$charsToChange);

            //Removes all special chars not 'a-z' '0-9' and '-'
            //String now becomes  'overvag-nu----denna-titel'
            $movies[$i]['machinetitle'] = preg_replace('/[^a-z0-9\-]/', '', $movies[$i]['machinetitle']);
            
            //Remove multiple dashes with one dash
            //String now becomes  'overvag-nu-denna-titel'
            $movies[$i]['machinetitle'] = preg_replace('/(-)\1+/', '-', $movies[$i]['machinetitle']);

            //Valid MachineTitel for URL purposes!
        }
        //Return movie array with valid Machinenames!
        return $movies;
    }

    private function updateSiteMap(){
        
    }
}

