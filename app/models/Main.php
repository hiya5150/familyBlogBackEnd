<?php

class Main
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

//    public function viewPosts() {
//        $posts = $this->currentModel->viewPosts();
//
//        $data = [
//            'posts' => $posts
//        ];
//        header('Content-type: application/json');
//        echo json_encode($data);
//    }

    public function getPosts() {
        $this->db->query('SELECT posts.*, users.user_id FROM posts INNER JOIN users on users.user_id = posts.user_id');


        return $this->db->resultSet();
    }

}