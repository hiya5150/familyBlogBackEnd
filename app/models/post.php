<?php
class post {

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

       public function createPost($data) {
        $this->db->query('INSERT INTO posts(post_title, post_body, post_author, user_id) VALUES (:post_title, :post_body, :post_author, :user_id)');
        $this->db->bind(':post_title', $data['post_title']);
        $this->db->bind(':post_body', $data['post_body']);
        $this->db->bind(':post_author', $data['post_author']);
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
// TODO password should be validated when user tries to create post or other action like that