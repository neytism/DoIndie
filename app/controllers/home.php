<?php

class Home extends Controller
{
    private $userModel;
    private $productModel;
    
    public function __construct() {
        $this->userModel = $this->model('UserModel');
        $this->productModel = $this->model('ProductModel');
    }
    
    public function index()
    {
        $this->checkIfLoggedIn();   
    }
    
    public function checkIfLoggedIn(){
        session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();
        $top_artworks = $this->productModel->getTopProducts();
        $new_artists = $this->userModel->getNewArtists();
        $new_artworks = $this->productModel->getNewProducts();
        
        if ($user_info) {
            $this->view('homeView', ['user_info' => $user_info,'top_artworks' => $top_artworks, 'new_artists' => $new_artists, 'new_artworks' => $new_artworks]);
        } else {
            $this->view('homeView', ['top_artworks' => $top_artworks, 'new_artists' => $new_artists, 'new_artworks' => $new_artworks]);
        }
    
    }

    public function aboutUs()
    {
        session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();
        
        if ($user_info) {
            $this->view('aboutUsView', ['user_info' => $user_info]);
        } else {
            $this->view('aboutUsView');
        }
    }
}