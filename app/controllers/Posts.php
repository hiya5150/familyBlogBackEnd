<?php
/*This is the Posts controller. This page will receive the input and if everything is completed correctly with no errors
it will send the info to the post model*/
class Posts extends Controller {
    public function __construct() {
        $this->currentModel = $this->model('post');
    }

       public function createPost() {
        //json object to be submitted

        $data = [

            'post_title' => $_POST['post_title'],
            'post_body' => $_POST['post_body'],
            'post_author' => $_POST['post_author'],
            'user_id' => $_POST['user_id'],
        ];
        if($this->currentModel->createPost($data)) {
            echo json_encode($data);
        }

    }
}