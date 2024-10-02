<?php

class CheckOut extends Controller
{
    private $cartModel;
    private $userModel;
    private $voucherModel;
    private $transactionModel;

    private $emailer;
    
    public function __construct()
    {
        $this->cartModel = $this->model('CartModel');
        $this->userModel = $this->model('UserModel');
        $this->voucherModel = $this->model('VoucherModel');
        $this->transactionModel = $this->model('TransactionModel');
        $this->emailer = new Emailer();
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

            $_SESSION['checkout_data'] = [
                'user_info' => $user_info, 
                'selected_carts' => $selected_carts, 
                'subtotal' => $subtotal, 
                'total' => $total,
                'mode_of_payment' => $mode_of_payment,
                'voucher_code' => $voucher_code,
                'voucher_desc' => $voucher_desc
            ];
            
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

    public function confirmOrder(){

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user_info = $this->userModel->checkIfLoggedIn();

        //add error handling if not logged in

        $checkout_data = $_SESSION['checkout_data'];
        
        $selected_carts = $checkout_data['selected_carts'];
        
        //add here lines for using voucher, removing to cart, adding to transaction history
        
        // adding data to transaction table
        $transaction_id = $this->transactionModel->createTransaction(
            $user_info['user_id'],
            $checkout_data['total'],
            $checkout_data['voucher_code'],
            $checkout_data['voucher_desc'],
            $checkout_data['mode_of_payment'],
            $user_info['address'],
            $selected_carts  
        );

        $order_id = $transaction_id;
        
        $padded_order_id = str_pad($order_id, 12, '0', STR_PAD_LEFT);
        
        $formatted_order_id = substr($padded_order_id, 0, 4) . '-' . substr($padded_order_id, 4, 4) . '-' . substr($padded_order_id, 8, 4);
        
        //removing from cart
        
        foreach($selected_carts as $cart){
            $this->cartModel->removeFromCart($cart['cart_id']);
        }

        //using voucher
        $this->voucherModel->useVoucherByVoucherCode($checkout_data['voucher_code']);

        //sending email
        if ($user_info) {
            
            $message = include 'app/views/orderConfirmationEmailTemplate.php';

            $this->emailer->sendMail($user_info['email'], 'noreply: Doindie Order Confirmation', $message);
            
            $this->view('homeView', ['user_info' => $user_info]);
        }

    }


}