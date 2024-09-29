<?php

class Artist extends Controller
{
    private $userModel;
    
    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }
    
    public function index()
    {
        $this->checkIfLoggedIn();   
    }
    
    public function checkIfLoggedIn(){
        session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();

        if ($user_info) {
            $this->view('homeView', ['user_info' => $user_info]);
        } else {
            $this->view('homeView');
        }
    
    }

    public function checkRegister(){
        session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();
        
        if ($user_info) {
            $this->view('homeView', ['user_info' => $user_info]);
        } else {
            $this->view('homeView');
        }
    
    }
    
}