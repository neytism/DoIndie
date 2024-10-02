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

        $user_info = $this->userModel->checkIfLoggedIn();

        if(!isset($_POST['selected_carts'])){
            
            if($user_info){
                $this->view('homeView', ['user_info' => $user_info]);
            }else{
                $this->view('homeView');
            }
            
            return;
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
        
        if(!array_filter($selected_carts)){
            
            if($user_info){
                $this->view('homeView', ['user_info' => $user_info]);
            }else{
                $this->view('homeView');
            }
            
            return;
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
                    $total = $total - ($total * ((float)$voucher['discount_value'] * 0.01));
                    $voucher_desc = $voucher['discount_value'] . '% OFF';
                }
            }else{
                $voucher_code = 'None';
            }
        }
        
        
           
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

        unset($_POST);
        $_POST = array();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $user_info = $this->userModel->checkIfLoggedIn();
        
        if(!isset($_SESSION['checkout_data'])) {
            $this->showReceipt();
            return;
        }
        

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

        $dop = $this->transactionModel->getCreatedAtByID($order_id);
        
        $dop = $dop['created_at'];

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
            
            $_SESSION['receipt_data'] = [
                'user_info' => $user_info,
                'order_id' => $padded_order_id,
                'dop' => $dop,
                'formatted_order_id' => $formatted_order_id,
                'selected_carts' => $selected_carts, 
                'subtotal' => number_format( $checkout_data['subtotal'], 2, '.', ','), 
                'total' => number_format($checkout_data['total'], 2, '.', ','),
                'mode_of_payment' => $checkout_data['mode_of_payment'],
                'voucher_code' => $checkout_data['voucher_code'],
                'voucher_desc' => $checkout_data['voucher_desc'],
                'timestamp' => time()
            ];

            unset($_SESSION['checkout_data']);
            
            $this->showReceipt();
            
            
        }
    
    }
    
    public function showReceipt() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $user_info = $this->userModel->checkIfLoggedIn();
        
        if (!isset($_SESSION['receipt_data'])) {
            if($user_info){
                $this->view('homeView', ['user_info' => $user_info]);
            }else{
                $this->view('homeView');
            }
            return;
        }
    
        $receipt_data = $_SESSION['receipt_data'];
    
        if (time() - $receipt_data['timestamp'] > 300) { // 300 seconds = 5 minutes

            unset($_SESSION['receipt_data']);
            
           

            if($user_info){
                $this->view('homeView', ['user_info' => $user_info]);
            }else{
                $this->view('homeView');
            }
            
            return;
        }
    
        $this->view('receiptView', [
            'user_info' => $receipt_data['user_info'],
            'order_id' => $receipt_data['order_id'],
            'dop' => $receipt_data['dop'],
            'formatted_order_id' => $receipt_data['formatted_order_id'],
            'selected_carts' => $receipt_data['selected_carts'], 
            'subtotal' => $receipt_data['subtotal'], 
            'total' => $receipt_data['total'],
            'mode_of_payment' => $receipt_data['mode_of_payment'],
            'voucher_code' => $receipt_data['voucher_code'],
            'voucher_desc' => $receipt_data['voucher_desc']
        ]);
    }


}