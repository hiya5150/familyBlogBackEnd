<?php

class Register extends Controller
{

    private $currentModel;

    public function __construct()
    {
        $this->currentModel = $this->model('SignUp');
    }

    public function register()
    {
        //check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => password_hash(trim($_POST['password']), PASSWORD_DEFAULT)
            ];
            // checks if username exists, has to be unique
            if (!$this->currentModel->findUserByUsername($data['username'])) {
                // registers to database, returns true on success or false on failure
                if ($this->currentModel->registerUser($data)) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['error' => 'username taken']);
            }
        }
    }
}