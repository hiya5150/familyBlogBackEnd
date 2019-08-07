<?php

class Login extends Controller
{


    private $currentModel;

    public function __construct()
    {
        $this->currentModel = $this->model('SignIn');
    }

    public function bloggerLogin(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password'])
                ////trim re spaces
            ];

            //verifies username and password, returns user details true or false
            if ($user = $this->currentModel->logInBlogger($data['username'], $data['password'])) {
                //this will return a token string on success
                if ($token = $this->currentModel->setToken($user->blogger_id, 'blogger', $_SERVER['REMOTE_ADDR'])) {
                    echo json_encode(['token' => $token]);

                } else {
                    echo json_encode(['error' => "login denied"]);

                }
                } else {
                    echo json_encode(['error' => "login failed"]);
                    echo "hello2";
                }
        } else {
            echo json_encode(['error' => "denied"]);
            echo "hello";
        }
    }

    public function visitorLogin(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password'])
                ////trim re spaces
            ];

            //verifies username and password, returns user details true or false
            if ($user = $this->currentModel->logInVisitor($data['username'], $data['password'])) {
                //this will return a token string on success
                if ($token = $this->currentModel->setToken($user->visitor_id, 'visitor', $_SERVER['REMOTE_ADDR'])) {
                    echo json_encode(['token' => $token]);

                } else {
                    echo json_encode(['error' => "login denied"]);

                }
            } else {
                echo json_encode(['error' => "login failed"]);
                echo "hello2";
            }
        } else {
            echo json_encode(['error' => "denied"]);
            echo "hello";
        }


    }


}


