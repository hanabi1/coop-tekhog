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

    public function getmovie($title)
    {

        header('Content-Type: application/json; charset=utf-8');   
        
        $movieModel = $this->loadModel('MoviesModel');   

        //Return one movie as JSON
        echo json_encode($movieModel->getMovieFromDB(strtolower($title))); 
    }

    public function getallmovies()
    {
        header('Content-Type: application/json; charset=utf-8');        
        $movieModel = $this->loadModel('MoviesModel');   
        
        $freshMovies = array();
        $freshMovies = $movieModel->getAllMoviesFromAPI();

        //Generates Machinetitles for the movies.
        //Populates the 'machineTitle' element for each movie in the array.
        //This is needed so we can access the movies though the URL /root/movies/overvag-nu-denna-titel.
        //
        //Example: 'Överväg Nu Denna Titel!' --> 'overvag-nu-denna-titel'
        $freshMovies = $this->addMachineTitles($freshMovies);

        //Cache the fresh movies to DB so we can get them for the next user
        $movieModel->cacheMoviesToDB($freshMovies);  

        echo json_encode($freshMovies);
    }
    
    public function getMovieEvents()
    {
        header('Content-Type: application/json; charset=utf-8');        
        $movieModel = $this->loadModel('MoviesModel');   
        
        //requiring FB PHP SDK
        require_once('application/tools/facebook-sdk/src/facebook.php');

        //initializing keys
        $facebook = new Facebook(array(
            'appId'  => FB_APP_ID,
            'secret' => FB_SECRET_KEY,
            'cookie' => true
        ));

        $response = $facebook->api(
            "/1380611578866107/events"
        );

       
        //looping through retrieved data
        for($i=0; $i < count($response['data']); $i++) { 

            setlocale( LC_ALL, 'sv_SE.utf8' );

            //If there is a start time THEN add a end time too. (we dont want just an end time =)
            //Convert both if they are valid
            if(isset($response['data'][$i]['start_time']) && $response['data'][$i]['start_time']){
                $response['data'][$i]['start_date'] = strftime('Den %e %B', date("U",strtotime($response['data'][$i]['start_time'])));
                $response['data'][$i]['start_time'] = strftime('%H:%M', date("U",strtotime($response['data'][$i]['start_time'])));
                    
                if(isset($response['data'][$i]['end_time']) && $response['data'][$i]['end_time']){                     
                    $response['data'][$i]['end_date'] = strftime('Den %e %B', date("U",strtotime($response['data'][$i]['end_time'])));
                    $response['data'][$i]['end_time'] = strftime('%H:%M', date("U",strtotime($response['data'][$i]['end_time'])));
                }
            }
            $events[$i]=array();

            foreach ($response['data'][$i] as $key => $value) {
                //If the events properties are valid and plays nice add it to the event array
                if(isset($value) && !trim($value) == '' && !is_nan(intval($value)) && !is_null($value) ){
                    $events[$i][$key] = ucfirst($value);
                }else{
                    $events[$i][$key] = '';
                }
            }
        }

        //Print out the movies as JSON so the client can recieve them
         echo json_encode($events);
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

