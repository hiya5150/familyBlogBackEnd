<?php
//base controller loads models and views
class Controller {
    //load model
    public function model($model) {
        //require model file
        require_once '../app/models/' . $model . '.php';

        //Instantiate model
        return new $model();

    }

    public function verifyToken($token, $ip) {
        $db = new Database();

        $db->query('SELECT * FROM auth WHERE token = :token AND expiry > now()');
        $db->bind(':token', $token);
        // check database if token exists and not expired
        if($res = $db->single()) {
            // checks if token matches to ip address
            // returns blogger or visitor id if verified else returns false
            if($res->token === $token && $res->ip === $ip) {
                $this->cleanTokens();
                return ($res->visitor_id > 0) ? $res->visitor_id : $res->blogger_id;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // clean expired tokens
    private function cleanTokens() {
        $db = new Database();
        $db->query('DELETE FROM auth WHERE expiry < now()');
        $db->execute();
        unset($db);
    }

    // @param token from http request header ($GLOBALS['headers'])
    // @param ip from address requested from ($_SERVER['REMOTE_ADDR'])
    public static function verifyTokenUserType($token, $ip){
        $db = new Database();

        $db->query('SELECT * FROM auth WHERE token = :token AND expiry > now()');
        $db->bind(':token', $token);
        // check database if token exists and not expired
        if ($res = $db->single()){
            // checks if token matches to ip address
            // returns student or teachers id if verified else returns false
            if($res->token === $token && $res->ip === $ip){
                return ($res->visitor_id > 0) ? 'visitor' : 'blogger';
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

}