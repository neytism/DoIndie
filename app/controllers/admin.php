<?php

class Admin extends Controller
{
    private $userModel;
    
    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }
    
    public function index()
    {
        $this->dashboard();
        //$this->checkIfLoggedIn();   
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

    public function dashboard(){
        $this->view('admin/adminDashBoardView');
    }
    
    public function users()
    {
        $all_users = $this->userModel->getAllUsers();
        $this->view('admin/adminUsersListView',['all_users' => $all_users]);
    }

    public function artists()
    {
        $all_artists = $this->userModel->getAllArtist();
        $this->view('admin/adminArtistsListView',['all_artists' => $all_artists]);
    }
}