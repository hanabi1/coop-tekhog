<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
class Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;
    protected $pageTitle = '';
    protected $movieModel;
    /**
     * Whenever a controller is created, open a database connection too. The idea behind is to have ONE connection
     * that can be used by multiple models (there are frameworks that open one connection per model).
     */
    function __construct($pageTitleIn)
    {
        $this->openDatabaseConnection();
        $this->pageTitle=$pageTitleIn;
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        
        //Also added FETCH_ASSOC so we get sensible arrays to loop over...
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        
        try {
            $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
        }catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage() . '<br>';
            echo 'Repairing missing database...' . fixTablesAndDB() . '!' . '<br>';
            echo 'Trying connection again...';
            try {
                $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
            }catch (PDOException $e) {
                echo 'FAILED';
                exit;
            }
            echo 'SUCCESS!';
        }    

    }

    /**
     * Load the model with the given name.
     * loadModel("SongModel") would include models/songmodel.php and create the object in the controller, like this:
     * $songs_model = $this->loadModel('SongsModel');
     * Note that the model class name is written in "CamelCase", the model's filename is the same in lowercase letters
     * @param string $model_name The name of the model
     * @return object model
     */
    public function loadModel($model_name)
    {
        require_once 'application/models/' . strtolower($model_name) . '.php';
        // return new model (and pass the database connection to the model)
        return new $model_name($this->db);
    }
    //array($this->pageTitle => 'title')
    public function dressTemplate($templateName, array $data = array()){
        // takes first array level of data and generates variables with that key name
        extract($data);
        // capture all templating output using a buffer
        ob_start();
        require('application/views' . $templateName . '.php');
        $htmlString = ob_get_clean();
        return $htmlString;
    }
}
