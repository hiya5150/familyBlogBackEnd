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
        $this->db->query('SELECT posts.*, bloggers.blogger_id FROM posts INNER JOIN bloggers on bloggers.blogger_id = posts.blogger_id');


        return $this->db->resultSet();
    }

}