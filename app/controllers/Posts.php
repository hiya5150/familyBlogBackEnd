<?php
/*This is the Posts controller. This page will receive the input and if everything is completed correctly with no errors
it will send the info to the post model*/
class Posts extends Controller {
    public function __construct() {
        $this->currentModel = $this->model('post');
    }

    public function viewPosts() {
        $posts = $this->currentModel->viewPosts();

        $data = [
            'posts' => $posts
        ];
        header('Content-type: application/json');
        echo json_encode($data);
    }

    public function createPost() {
        //this is dummy data, which will be replaced by actual data submitted from the front end
        $data = [
            'user_id' => '1',
            'post_title' => 'Post One',
            'post_body' => 'Post One will be quite long',
            'post_author' => 'Chaya Eigner'
        ];
        if($this->currentModel->createPost($data)) {
            echo 'success';
        } else {
            echo 'something went wrong';
        }

    }
}