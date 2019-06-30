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

//    public function index() {
//        $posts = $this->postModel->getPosts();
//        $data = [
//            'title' => 'Welcome',
//            'posts' => $posts
//        ];
//    }


}