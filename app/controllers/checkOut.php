<?php

class CheckOut extends Controller
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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $subtotal = 0;
        $total = 0;
        $mode_of_payment = '';
        $mode_of_payment_code = $_POST['mode_of_payment'];
        $voucher_code = $_POST['voucher_code'];
        $voucher_desc = '';
        
        $selected_cart_ids = $_POST['selected_carts'];
        
        $selected_cart_ids = json_decode($selected_cart_ids);
        
        $selected_carts = array();

        switch ($mode_of_payment_code) {
            case 'cod':
                $mode_of_payment = 'Cash on Delivery';
              break;
            case 'gcash':
                $mode_of_payment = 'GCash';
              break;
        }
        
        
        foreach($selected_cart_ids as $id){
            $cartItem = $this->cartModel->getCartItemByCartID($id);
            if ($cartItem) {
                array_push($selected_carts, $cartItem);
            }
        }
        
        foreach($selected_carts as $product){
           $price = (float)$product['price'];
           $quantity = (int)$product['quantity'];
        
           $subtotal = $subtotal + ($price * $quantity);

        }

        $total = $subtotal;

        if(empty($voucher_code)){
            $voucher_code = 'None';
        } else{
            $voucher = $this->voucherModel->checkIfValidVoucher($voucher_code);

            if($voucher){
                $voucher_code = $voucher['voucher_code'];

                $voucher_type = $voucher['discount_type'];

                if($voucher_type == 'fixed'){
                    $total = $total - (float)$voucher['discount_value'];
                    $voucher_desc = 'LESS ₱ ' . $voucher['discount_value'];
                } else{
                    $total = $total * ((float)$voucher['discount_value'] * 0.01);
                    $voucher_desc = $voucher['discount_value'] . '% OFF';
                }
            }else{
                $voucher_code = 'None';
            }
        }
        
        $user_info = $this->userModel->checkIfLoggedIn();
           
        if ($user_info) {
            
            $this->view('checkOutView', [
                'user_info' => $user_info, 
                'selected_carts' => $selected_carts, 
                'subtotal' => number_format($subtotal, 2, '.', ','), 
                'total' => number_format($total, 2, '.', ','),
                'mode_of_payment' => $mode_of_payment,
                'voucher_code' => $voucher_code,
                'voucher_desc' => $voucher_desc
            ]);
            
        }
        
    }
    

}