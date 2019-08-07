<?php


class SignIn
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;

    }
    // login blogger
    public function logInBlogger($username, $password)
    {
        $this->db->query('SELECT * FROM bloggers WHERE blogger_username = :username');
        $this->db->bind(':username', $username);

        // tries to get info from db
        if ($row = $this->db->single()){
            $hashed_password = $row->blogger_password;
            // verifies password with encrypted pass from database
            if(password_verify($password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // login visitor
    public function logInVisitor($username, $password)
    {
        $this->db->query('SELECT * FROM visitors WHERE visitor_username = :username');
        $this->db->bind(':username', $username);

        // tries to get info from db
        if ($row = $this->db->single()){
            $hashed_password = $row->visitor_password;
            // verifies password with encrypted pass from database
            if(password_verify($password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //call this function if user successfully logged in
    public function setToken($id, $type, $ip)
    {
        try {
            //try creating random token else throw error
            if ($token = bin2hex(random_bytes(60))) {
                //hashing password
                $this->db->query('INSERT INTO auth(token, ip, expiry, visitor_id, blogger_id) VALUES (:token, :ip, NOW() + INTERVAL 1 HOUR, :visitorId, :teacherId)');
                $this->db->bind(':token', $token);
                $this->db->bind(':ip', $ip);

                switch ($type){
                    case 'blogger':
                        $this->db->bind(':visitorId', null);
                        $this->db->bind(':bloggerId', $id);
                        break;
                    case 'student':
                        $this->db->bind(':visitorId', $id);
                        $this->db->bind(':bloggerId', null);
                }

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




