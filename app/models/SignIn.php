<?php


class SignIn
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;

    }

    public function logInUser($username, $password)
    {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);

        $row = $this->db->single();

              $hashed_password = $row->password;
      if(password_verify($password, $hashed_password)){
          return $row;
      } else {
          return false;
      }
    }

    //call this function if user successfully logged in
    public function setToken($auth_userid,$ip)
    {
        try {
            //try creating random token else throw error
            if ($token = bin2hex(random_bytes(32))) {
                //hashing password
                $this->db->query('INSERT INTO auth(token, ip, expiry, auth_userid) VALUES (:token, :ip, NOW() + INTERVAL 1 HOUR, :auth_userid)');
                $this->db->bind(':token', $token);
                $this->db->bind(':ip', $ip);
                $this->db->bind(':auth_userid', $auth_userid);


                //inserts token with expiry and ip to database, return token on success or false on failure
                if ($this->db->execute()) {
                    return $token;
                } else {
                    return false;
                }
            } else {
                throw new Exception('Sorry, something went wrong! Please try again');
            }
        } catch (Exception $error) {
            echo json_encode(['error' => $error->getMessage()]);
        }
    }
}




