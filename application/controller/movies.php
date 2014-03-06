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
        $movieModel = $this->loadModel('MoviesModel');   
        header('Content-Type: application/json');
        echo json_encode($movieModel->getAllMoviesFromDB()); 
    }
    public function getmovie($title)
    {
        $movieModel = $this->loadModel('MoviesModel');   
        header('Content-Type: application/json');
        echo json_encode($movieModel->getMovieFromDB($title)); 
    }      
    public function getMoviesFromAPI(){
        $movieModel = $this->loadModel('MoviesModel');   
        header('Content-type: application/json; charset=utf-8');
        echo $movieModel->getAllMoviesFromAPI(); 
    }
}

