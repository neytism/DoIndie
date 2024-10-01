<?php

class CheckOut extends Controller
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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $selected_cart_ids = $_POST['selected_carts'];
        
        $selected_cart_ids = json_decode($selected_cart_ids);

        $selected_carts = array();
        
        foreach($selected_cart_ids as $id){
            $cartItem = $this->cartModel->getCartItemByCartID($id);
            if ($cartItem) {
                array_push($selected_carts, $cartItem);
            }
        }
        
        $user_info = $this->userModel->checkIfLoggedIn();
           
        if ($user_info) {
            
            $this->view('checkOutView', ['user_info' => $user_info, 'selected_carts' => $selected_carts]);
            
        }
        
    }
    

}