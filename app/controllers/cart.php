<?php

class Cart extends Controller
{
    private $cartModel;
    private $userModel;
    private $voucherModel;
    
    public function __construct()
    {
        $this->cartModel = $this->model('CartModel');
        $this->userModel = $this->model('UserModel');
        $this->voucherModel = $this->model('VoucherModel');
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
        $cart_id = $_POST['cart_id'];
            
        $this->cartModel->removeFromCart($cart_id);
    }

    public function updateQuantity() {
    
        $cart_id = $_POST['cart_id'];
        $action = $_POST['action'];

        if ($action === 'increase') {
            $this->cartModel->increaseQuantity($cart_id);
        } elseif ($action === 'decrease') {
            $this->cartModel->decreaseQuantity($cart_id);
        }
    }

    public function checkVoucher($voucher_code){
        $voucher = $this->voucherModel->checkIfValidVoucher($voucher_code);
        
        if(!$voucher){
            echo 'invalid|Voucher is invalid.';
        } else{
            echo 'valid|Voucher is valid.|'.$voucher['discount_value'].'|'.$voucher['discount_type'];
           
        }
    }


}