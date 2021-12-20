<?php

class Controller{

    //load the model
    public function model($model){

        //require model file
        require_once '../app/models/' . $model . '.php';

        //instantiate model
        return $model::getInstance();
    }

    //checks for the view file and load
    public function view($view, $data = []){
        
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        }
        else{
            die("View does not exists.");
        }
    }
}

?>