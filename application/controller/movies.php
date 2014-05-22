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

    public function getMovie($machineTitle = '')
    {
        if(!$machineTitle){
            echo 'No title sent to getMovie...';
            return false;
        }
        $movieModel = $this->loadModel('MoviesModel');
        $result = $movieModel->getMovieFromDB($machineTitle);
        
        echo json_encode($result);

    }

    public function getallmovies()
    {
        header('Content-Type: application/json; charset=utf-8');        
        $movieModel = $this->loadModel('MoviesModel');   
        
        //Get the movies from the API
        $freshMovies = $movieModel->getAllMoviesFromAPI();
               
        //Add machinereadable titles
        $freshMovies = $this->addMachineTitles($freshMovies);

        //Cache the movies to DB so we can get info from them later
        //without having to download them all again.
        $movieModel->cacheMoviesToDB($freshMovies);


        //Print out the movies as JSON so the client can recieve them
        echo json_encode($freshMovies);
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
}

