<?php

//base class for all controllers

abstract class Controller
{

    public abstract function index();
    
    public function model($model){
        require_once 'app/models/'.$model.'.php';
        return new $model();
    }

    public function view($view, $data = []){
        if (session_status() == PHP_SESSION_NONE) session_start();
        
        $is_logged_in = false;
        if(isset($_SESSION['user_id'])){
            $is_logged_in = true;
        }

        require_once 'app/views/'.$view.'.php';
    }

}