<?php
class post {

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

       public function createPost($data) {
        $this->db->query('INSERT INTO posts (post_title, post_body, created_on, blogger_id) VALUES (:post_title, :post_body, :created_on, :blogger_id)');
        $this->db->bind(':post_title', $data['post_title']);
        $this->db->bind(':post_body', $data['post_body']);
        $this->db->bind(':created_on', $data['created_on']);
        $this->db->bind(':blogger_id', $data['blogger_id']);


           if($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    }

    //this function returns all posts from the database
    public function loadPosts() {
        $this->db->query('SELECT posts.*, bloggers.blogger_name FROM posts INNER JOIN bloggers ON bloggers.blogger_id = posts.blogger_id ORDER BY created_on DESC');
        $results = $this->db->resultSet();

        return $results;

    }

}


