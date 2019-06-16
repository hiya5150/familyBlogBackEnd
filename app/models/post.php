<?php
class post {

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getPosts() {
        $this->db->query('SELECT posts.*, users.user_id FROM posts INNER JOIN users on users.user_id = posts.user_id');


        return $this->db->resultSet();
    }

    public function createPost($data) {
        $this->db->query('INSERT INTO posts(post_title, post_body, author, user_id) VALUES (:post_title, :post_body, :author, :user_id)');
        $this->db->bind(':post_title', $data['post_title']);
        $this->db->bind(':post_body', $data['post_body']);
        $this->db->bind(':author', $data['author']);
        $this->db->bind(':user_id', $data['user_id']);

        if($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    }
}
// TODO Login returns token
// TODO verify token in the controller before anything else (only authorized users can access the server)