<?php
use ReallySimpleJWT\Token;

class SignIn {

    private $db;

    public function __construct()
    {
        $this->db = new Database;

    }

    public function loginInUser($username, $password) {
            $this->db->query('SELECT * from users WHERE username = :username');
            $this->db->bind(':username', $username);
            $row = $this->db->single();
            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)) {
                return $row;
             } else {
                return false;
            }

            }

            public function setToken() {
                $token = Token::create(12, 'Kjtu53kj$', time() + 3600, 'localhost');
            }

            public function validateToken() {


                $result = Token::validate('aaa.b.c', 'Kjtu53kj$');
            }
}

// TODO video re hashing passwords https://www.youtube.com/watch?v=8ZtInClXe1Q