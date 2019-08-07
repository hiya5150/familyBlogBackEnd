<?php
class Home extends Controller{

        private $currentModel;

        public function __construct() {
        $this->currentModel = $this->model('Main');

    }

    //this function returns all posts from the database
        public function loadPosts() {
            if($posts = $this->currentModel->getPosts()) {
                echo json_encode($posts);
            } else {
                echo json_encode(['success'=>false]);
            }

}

    //if the URL api request is unsuccessful, this will run
    public function notFound() {
        echo json_encode(['error' => '404 - not found']);
    }
    // every time a function is called from one of the blogger controllers it will first test this to make sure it is actually a blogger trying to use the function

    public function verifyBloggerToken() {
            if(isset($GLOBALS['headers'] ['Authorization'])) {
                if(parent::verifyTokenUserType($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR']) === 'blogger') {
                    echo json_encode(true);
             } else {
                echo json_encode(false);
                }
            } else {
                echo json_encode(false);
            }
    }

    // every time a function is called from one of the visitors controllers it will first test this to make sure it is actually a blogger trying to use the function

    public function verifyVisitorToken() {
        if(isset($GLOBALS['headers'] ['Authorization'])) {
            if(parent::verifyTokenUserType($GLOBALS['headers'] ['Authorization'], $_SERVER['REMOTE_ADDR']) === 'visitor') {
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        } else {
            echo json_encode(false);
        }
    }
}