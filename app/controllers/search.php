<?php

class Search extends Controller
{
    private $userModel;
    private $productModel;
    

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
        $this->productModel = $this->model('ProductModel');
    }

    
    public function index()
    {
        $this->view('searchSample');
    }

    public function keyword()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();

        if (isset($_POST['keyword'])) {
            
            $keyword = trim($_POST['keyword']);

            $maxResults = 5;

            $artists = $this->userModel->searchArtists($keyword, $maxResults);

            $artists = json_encode($artists);
            
            $users = $this->userModel->searchUsers($keyword, $maxResults);

            $users = json_encode($users);
            
            $products = $this->productModel->searchProducts($keyword, $maxResults);

            $products = json_encode($products);
            
            $results = [
                'artists' => $artists,
                'users' => $users,
                'products' => $products
            ];

            $results = json_encode( $results);
            
            if (!empty($users)) {
                echo 'notnull|' . $results;
            } else {
                echo 'null|';
            }

        } else {
            echo 'null|';
        }

    }

}