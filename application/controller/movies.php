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

        echo $this->dressTemplate('/_templates/head', array('title'=> $this->pageTitle));        
        require 'application/views/_templates/header.php';
        require 'application/views/home/index.php';
        require 'application/views/_templates/footer.php';
    }

    public function getallmovies()
    {
        header('Content-Type: application/json; charset=utf-8');        
        $movieModel = $this->loadModel('MoviesModel');   
       
        echo json_encode($movieModel->getAllMoviesFromAPI(),JSON_UNESCAPED_UNICODE);
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

        /*
         *-Query the events
         *
         *-We will select:
         *  -name, start_time, end_time, location, description
         *  -but there are other data that you can get on the event table
         *      -https://developers.facebook.com/docs/reference/fql/event/
         * 
         *-As you will notice, we have TWO select statements here because
         *-We can't just do "WHERE creator = your_fan_page_id".
         *-Only eid is indexable in the event table
         *  -So we have to retrieve list of events by eids
         *      -And this was achieved by selecting all eid from
         *          event_member table where the uid is the id of your fanpage.
         *
         *-Yes, you fanpage automatically becomes an event_member once it creates an event
         *-start_time >= now() is used to show upcoming events only
         */
        $fql = "SELECT
                    eid, name, pic, start_time, end_time, location, description
                FROM
                    event
                WHERE
                    eid IN ( SELECT eid FROM event_member WHERE uid = " . FB_PAGE_UID .")
                AND
                    start_time >= now()
                ORDER BY
                    start_time desc";
         
        $param  =   array(
            'method'    => 'fql.query',
            'query'     => $fql,
            'callback'  => ''
        );
         
        $fqlResult   =   $facebook->api($param);
        $events = array();
        
        //looping through retrieved data
        for($i=0; $i < count($fqlResult); $i++) { 

            setlocale( LC_ALL, 'sv_SE.utf8' );

            //If there is a start time THEN add a end time too. (we dont want just an end time =)
            //Convert both if they are valid
            if(isset($fqlResult[$i]['start_time']) && $fqlResult[$i]['start_time']){
                $fqlResult[$i]['start_date'] = strftime('Den %e %B', date("U",strtotime($fqlResult[$i]['start_time'])));
                $fqlResult[$i]['start_time'] = strftime('%H:%M', date("U",strtotime($fqlResult[$i]['start_time'])));
                    
                if(isset($fqlResult[$i]['end_time']) && $fqlResult[$i]['end_time']){                     
                    $fqlResult[$i]['end_date'] = strftime('Den %e %B', date("U",strtotime($fqlResult[$i]['end_time'])));
                    $fqlResult[$i]['end_time'] = strftime('%H:%M', date("U",strtotime($fqlResult[$i]['end_time'])));
                }
            }
            $events[$i]=array();

            foreach ($fqlResult[$i] as $key => $value) {
                //If the events properties are valid and plays nice add it to the event array
                if(isset($value) && !trim($value) == '' && !is_nan($value) && !is_null($value) ){
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

