<?php
/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
 */
class Core {
    protected $currentDirectory = 'main';
    protected $currentController = 'Home';
    protected $currentMethod = 'notFound';
    protected $params = [];

    public function __construct(){
        //print_r($this->getUrl());

        $url = $this->getUrl();

        // Look in controllers for first value
        if(file_exists('../app/controllers/'. $url[0] .'/'. ucfirst($url[1]). '.php')){
            // If exists, set as directory
            $this->currentDirectory = $url[0];
            // If exists, set as controller
            $this->currentController = ucwords($url[1]);
            // Unset 0 Main
            unset($url[0]);
            unset($url[1]);
        }

        // Require the controller
        require_once '../app/controllers/'. $this->currentDirectory .'/'. $this->currentController . '.php';

        // Instantiate controller class
        $this->currentController = new $this->currentController;

        // Check for second part of url
        if(isset($url[2])){
            // Check to see if method exists in controller
            if(method_exists($this->currentController, $url[2])){
                $this->currentMethod = $url[2];
                // Unset 1 index
                unset($url[2]);
            }else{
                $this->currentDirectory = 'main';
                $this->currentController = 'Home';
                require_once '../app/controllers/'. $this->currentDirectory .'/'. $this->currentController . '.php';
                $this->currentController = new $this->currentController;
            }
        }

        // Get params
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return null;
    }
}

