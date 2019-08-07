<?php

class Register extends Controller
{

    private $currentModel;

    public function __construct()
    {
        $this->currentModel = $this->model('SignUp');
    }
    // register blogger
    public function bloggerRegister()
    {
        //check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'username' => trim($_POST['username']),
                'password' => password_hash(trim($_POST['password']), PASSWORD_DEFAULT)
            ];
            // checks if username exists, has to be unique
            if (!$this->currentModel->findUserByUsername($data['username'], 'blogger')) {
                // registers to database, returns true on success or false on failure
                if ($this->currentModel->registerBlogger($data)) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['error' => 'username taken']);
            }
        }
    }

    // register visitor
    public function visitorRegister()
    {
        //check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'username' => trim($_POST['username']),
                'password' => password_hash(trim($_POST['password']), PASSWORD_DEFAULT)
            ];
            // checks if username exists, has to be unique
            if (!$this->currentModel->findUserByUsername($data['username'], 'visitor')) {
                // registers to database, returns true on success or false on failure
                if ($this->currentModel->registerVisitor($data)) {
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