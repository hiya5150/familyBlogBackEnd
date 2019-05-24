<?php
//base controller loads models and views
class Controller {
    //load model
    public function model($model) {
        //require model file
        require_once '../app/models/' . $model . ' .php';

        //Instantiate model
        return new $model();

    }
}