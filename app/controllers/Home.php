<?php
class Home extends Controller{

    public function __construct() {
    }

    //if the URL api request is unsuccessful, this will run
    public function notFound() {
        echo json_encode(['error' => '404 - not found']);
    }

    public function index() {

    }


}