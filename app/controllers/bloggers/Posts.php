<?php
/*This is the Posts controller. This page will receive the input and if everything is completed correctly with no errors
it will send the info to the post model*/
class Posts extends Controller {
    public function __construct() {
        $this->currentModel = $this->model('bloggers', 'post');
    }

    public function loadPosts() {
        if (isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])) {
                $posts = $this->currentModel->loadPosts();
                if ($posts) {
                    echo json_encode($posts);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false, 'error' => "invalid token"]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => "undefined token"]);
        }
    }

       public function createPost() {
        if(isset($GLOBALS['headers'] ['Authorization'])) {
            if($id = $this->verifyToken($GLOBALS['headers'] ['Authorization'], $_SERVER['REMOTE_ADDR'])) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [


                    'post_title' => trim($_POST['postTitle']),
                    'post_body' => trim($_POST['postBody']),
                    'created_on' => trim($_POST['createdOn']),
                    'blogger_id' => $id,

                ];
                if($this->currentModel->createPost($data)) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
            }
        } else {
                echo json_encode(['success' => false, 'error' => "invalid token"]);
        }
       } else {
            echo json_encode(['success' => false, 'error' => "token undefined"]);
}
                }


}