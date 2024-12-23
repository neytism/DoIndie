<?php

class TransactionModel {
    private $db;

    public function __construct() {
        $this->db = new Database();  
    }

    public function createTransaction($user_id, $total, $voucher_code, $voucher_desc, $payment_method, $address, $selected_carts) {
        // Serialize the selected cart items into a JSON string
        $cart_items = array_map(function($cart) {
            return [
                'product_id' => $cart['product_id'],
                'current_price' => $cart['price'],
                'quantity' => $cart['quantity']
            ];
        }, $selected_carts);
        
        $serialized_cart = json_encode($cart_items);
        
        $sql = "INSERT INTO transactions (buyer_id, total, voucher_code, voucher_desc, payment_method, address, selected_cart_items)
                VALUES (:user_id, :total, :voucher_code, :voucher_desc, :payment_method, :address, :selected_cart_items)";
        
        $this->db->query($sql, [
            ':user_id' => $user_id,
            ':total' => $total,
            ':voucher_code' => $voucher_code,
            ':voucher_desc' => $voucher_desc,
            ':payment_method' => $payment_method,
            ':address' => $address,
            ':selected_cart_items' => $serialized_cart  
        ]);
        
        return $this->db->lastInsertId();
    }
    
    public function getCreatedAtByID($id){
        return $this->db->fetch('SELECT created_at FROM transactions WHERE transaction_id = :id', ['id' => $id]);
    }

    public function getAllTransactions() {
        return $this->db->fetchAll('SELECT t.*, u.user_id, u.username FROM transactions t LEFT JOIN users u ON t.buyer_id = u.user_id');
    }
}
