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
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $user_info = $this->userModel->findUserByUserID($user_id);
            $this->view('homeView', ['is_logged_in' => true, 'user_info' => $user_info]);
        } else {
            $this->view('homeView', ['is_logged_in' => false]);
        }
    
    }

    public function about()
    {
        $this->view('aboutView');
    }
}