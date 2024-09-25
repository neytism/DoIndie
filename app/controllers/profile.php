<?php

class Profile extends Controller
{
    private $userModel;
    
    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }
    
    public function index()
    {
        $this->checkIfLoggedIn();   
    }

    public function user($username){
     echo $username;
    }
    
    public function checkIfLoggedIn(){
        session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();
        
        if ($user_info) {    
            $this->view('userProfileView', ['is_logged_in' => true, 'user_info' => $user_info, 'current_view' => 'userProfileView']);
        } else {
            $this->view('homeView', ['is_logged_in' => false]);
        }
    
    }

    public function about()
    {
        $this->view('aboutView');
    }
}