<?php

class AddProduct extends Controller
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
        http_response_code(400); 
    }
    
    public function checkProduct(){
        session_start();

        $user_info = $this->userModel->checkIfLoggedIn();
        
        $title = $_POST['title'];
        $price = $_POST['price'];
        $category_id = $_POST['product_category_id'];
        $tags = $_POST['tags'];
        
        $errors = array(
            'title' => '',
            'price' => '',
            'category_id' => '',
            'tags' => ''
        );
        

        if (array_filter($errors)) {
            //has errors
            echo 'error/s: <br>'. implode("<br>", array_filter($errors));
        } else{

            $this->productModel->createProduct($title, '', $user_info['user_id'], $price, $price, $tags );

            
            // Redirect to a success page or log in
            echo 'success|'.BASEURL.'products/artist/'.$user_info['username'];
        }
        
    }
    
}