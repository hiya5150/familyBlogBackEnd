<?php
class SignUp
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    // Register user
    public function registerUser($data) {
        $this->db->query('INSERT INTO users (username, password) VALUES(:username, :password)');
        //bind values
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
    public function findUserByUsername($username)
    {
        $sql = 'SELECT * FROM users WHERE username = :username';

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

