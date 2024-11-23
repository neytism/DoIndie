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

            $maxResults = 30;

            $artists = $this->userModel->searchArtists($keyword, $maxResults);
            
            $users = $this->userModel->searchUsers($keyword, $maxResults);
            
            $products = $this->productModel->searchProducts($keyword, $maxResults);
            
            
            if (empty(array_filter($artists)) && empty(array_filter($users)) && empty(array_filter($products))) {

                echo 'null|';
                
            } else {
                
                $artists = json_encode($artists);

                $users = json_encode($users);

                $products = json_encode($products);
               
                $results = [
                    'artists' => $artists,
                    'users' => $users,
                    'products' => $products
                ];

                $results = json_encode( $results);
                echo 'notnull|' . $results;
            }

        } else {
            echo 'null|';
        }

    }

}