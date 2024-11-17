<?php

class RegisterAsArtist extends Controller
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
        $artist_categories = $this->userModel->getArtistCategories();
        
        
        if ($user_info) {
            $this->view('registerAsArtistView', ['user_info' => $user_info, 'artist_categories' => $artist_categories]);
        } else {
            $this->view('homeView');
        }
    
    }

    public function checkRegister(){
        $artist_name = $_POST['artist_name'];
        $artist_category_id = $_POST['artist_category_id'];
        
        session_start();
        $user_info = $this->userModel->checkIfLoggedIn();
        
        if ($user_info) {
            $this->userModel->setUserAsArtist($user_info['user_id'], $artist_name, $artist_category_id);
            echo 'success|'.BASEURL.'profile';
        } else {
           echo 'error you are not logged in.';
        }
        
    }
}