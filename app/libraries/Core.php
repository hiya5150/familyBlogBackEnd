<?php
//create URL's and load core controllers
class Core {
    protected $currentDirectory = 'SignIn';
    protected $currentController = 'Home';
    protected $currentMethod = 'notFound';
    protected $params = [];

    public function __construct() {
//        print_r($this->getUrl());

        $url = $this->getUrl();

        //look in controllers for first value
        if(file_exists('../app/controllers/' . ucwords($url[0]).
        '.php')) {
        //if exists, set as controller
            $this->currentController = ucwords($url[0]);
        //unset 0 index
            unset($url[0]);
        }

        //require the controller
        require_once '../app/controllers/'. $this->currentController . '.php';

        //instantiate controller class
        $this->currentController = new $this->currentController;

        //check for second part of URL
        if(isset($url[1])) {
        //check to see if method exists in controller
            if(method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];

            }
        }
        //Get params
        $this->params = $url ? array_values($url) : [];

        //call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl() {
        if(isset($_GET['url'])) {
            // if the url is set
            $url = rtrim($_GET['url'], '/'); //strip any ending slash
            $url = filter_var($url, FILTER_SANITIZE_URL); //sanitize - remove any character that don't belong in url
            $url = explode('/', $url); //break into array
            return $url;
        }
    }
}
