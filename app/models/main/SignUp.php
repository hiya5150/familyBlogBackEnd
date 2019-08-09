<?php
class SignUp
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    // Register user
    public function registerBlogger($data) {
        $this->db->query('INSERT INTO bloggers (blogger_name, blogger_username, blogger_password) VALUES(:name, :username, :password)');
        //bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function registerVisitor($data) {
        $this->db->query('INSERT INTO visitors (visitor_name, visitor_username, visitor_password) VALUES(:name, :username, :password)');
        //bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
    //find user by email
    public function findUserByUsername($username, $type) {
     switch ($type){
            case 'blogger':
                $sql = 'SELECT * FROM bloggers WHERE blogger_username = :username';
                break;
            case 'visitor';
                $sql = 'SELECT * FROM visitors WHERE visitor_username = :username';
                break;
            default:
                $sql = '';
        }
        $this->db->query($sql);

        //bind value
        $this->db->bind(':username', $username);

        //check row
        $this->db->execute();
        if($this->db->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }

}

