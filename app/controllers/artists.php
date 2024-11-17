<?php

class Artists extends Controller
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
        $all_artists = $this->userModel->getAllArtist();

        if ($user_info) {
            $this->view('artistsView', ['all_artists' => $all_artists, 'user_info' => $user_info]);
        } else {
            $this->view('artistsView', ['all_artists' => $all_artists]);
        }
    
    }
    
    
}