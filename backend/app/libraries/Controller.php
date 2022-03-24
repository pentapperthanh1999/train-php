<?php
//load the model and the view
class Controller {
    //load the model
    public function model($model)
    {
        //require model file
        require_once '../app/models/' . $model . '.php';
        //Instantiate model
        return new $model();
    }
    //load the view
    public function view($view, $data = [])
    {   //check view exists
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die("View does not exists");
        }
    }
}
