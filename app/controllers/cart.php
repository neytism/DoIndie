<?php

class Cart extends Controller
{
    private $cartModel;
    private $userModel;
    
    public function __construct()
    {
        $this->cartModel = $this->model('CartModel');
        $this->userModel = $this->model('UserModel');
    }
    
    public function index()
    { 
        $this->viewCart();
    }

    public function viewCart(){
        session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();
       
        if ($user_info) {

            $cart_items = $this->cartModel->getCartItemsByUserID($user_info['user_id']);
            $this->view('cartView', ['user_info' => $user_info,'cart_items' => $cart_items]);
            
        } else {
            $this->view('logInView');
        }
    }

    public function addToCart(){
        session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();

        if ($user_info) {

            $user_id = $user_info['user_id'];
            $product_id = $_POST['product_id'];
            
            $this->cartModel->addToCart($user_id, $product_id);
            
        } else {
            $this->view('logInView');
        }
    }

    public function removeFromCart(){
        session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();

        if ($user_info) {

            $user_id = $user_info['user_id'];
            $product_id = $_POST['product_id'];
            
            $this->cartModel->removeFromCart($user_id, $product_id);
            
        } 
    }

    public function updateQuantity() {
        session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();
    
        if ($user_info) {
            $user_id = $user_info['user_id'];
            $product_id = $_POST['product_id'];
            $action = $_POST['action'];
    
            if ($action === 'increase') {
                $this->cartModel->increaseQuantity($user_id, $product_id);
            } elseif ($action === 'decrease') {
                $this->cartModel->decreaseQuantity($user_id, $product_id);
            }
            
            
        } 
    }


}