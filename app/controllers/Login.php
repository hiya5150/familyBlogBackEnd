<?php
use ReallySimpleJWT\Token;

class Login {

private $token;
private $currentModel;
public function __construct()
{
    $this->currentModel = $this->model('SignIn');
}

public function login() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'username' => trim($_POST['username']),
            'password' => trim($_POST['password'])
        ];

        //verifies username and password, returns user details true or false
        if($user = $this->currentModel->logInUser($data['username'], $data['password'])){
        //this will return a token string on success
            if ($token = $this->currentModel->setToken()) {
                echo json_encode(['token' => $token]);

            }  else {
                echo json_encode(['error' => "login failed"]);
            }
        } else {
            echo json_encode(['error' => "login denied"]);

            }
        } else {
        echo json_encode(['error' => "denied"]);
    }
    }


    }
//TODO I'm stuck. getting error that call to undefined method Login::model()

