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

    public function getallmovies()
    {
        header('Content-Type: application/json; charset=utf-8');        
        $movieModel = $this->loadModel('MoviesModel');   

        //Start the Caching rutine
        $this->updateCache();
        
        echo json_encode($movieModel->getAllMoviesFromDB(),JSON_UNESCAPED_UNICODE);
    }

    public function getmovie($title)
    {
        $movieModel = $this->loadModel('MoviesModel');   
        header('Content-Type: application/json; charset=utf-8');
        
        //Start the Caching rutine
        $this->updateCache();

        echo json_encode($movieModel->getMovieFromDB($title)); 
    }

    public function getMoviesFromAPI(){
        $movieModel = $this->loadModel('MoviesModel');   
        header('Content-type: application/json; charset=utf-8');
        echo $movieModel->getAllMoviesFromAPI(); 
    }

    private function updateCache(){
        $movieModel = $this->loadModel('MoviesModel');   

        //Get the last database update time to prevent spamming of the Youtube API
        $lastRefreshTime = $movieModel->getLastDatabaseRefresh();    
        
        //Get the current UNIX time (all the seconds from around 1970)
        $currentUnixTime = time();

        //If the database was updated before the defined YOUTUBE_DELAY then 
        //just return the cached values from the database instead of getting new data from youtube
        if($currentUnixTime >= ($lastRefreshTime + YOUTUBE_DELAY)){
            //Time To Cache!
            
            //Get fresh movies from the API
            $freshMovies = $movieModel->getAllMoviesFromAPI(); 

            //Cache the fresh movies to DB so we can get them for the next user
            $movieModel->cacheMoviesToDB($freshMovies);  

            //Update the last cache-refresh time
            //So we know when to cache next time
            $movieModel->setNewDatabaseRefreshTime($currentUnixTime); 

            return true;
        }
        //Database was allready updated recently
        return false;
    }
}

