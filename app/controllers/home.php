<?php

class Home extends Controller
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
            $this->view('homeView', ['is_logged_in' => true, 'user_info' => $user_info]);
        } else {
            $this->view('homeView', ['is_logged_in' => false]);
        }
    
    }

    public function aboutUs()
    {
        session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();
        
        if ($user_info) {
            $this->view('aboutUsView', ['is_logged_in' => true, 'user_info' => $user_info]);
        } else {
            $this->view('aboutUsView', ['is_logged_in' => false]);
        }
    }
}