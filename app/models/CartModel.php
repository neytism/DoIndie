<?php

class CartModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    public function checkIfExistingInCart($user_id, $product_id){
        $user = $this->db->fetch("SELECT * FROM carts WHERE product_id = :product_id AND user_id = :user_id", ['product_id' => $product_id, 'user_id' => $user_id]);
        return $user ? true : false;
    }
    
    public function addToCart($user_id, $product_id) {
        if($this->checkIfExistingInCart($user_id, $product_id)){
            //update
            $this->db->query("UPDATE carts SET quantity = quantity + 1, date_added_to_cart = NOW() WHERE product_id = :product_id AND user_id = :user_id", [
                'product_id' => $product_id, 
                'user_id' => $user_id
            ]);
            
        } else{
            //insert
            $this->db->query("INSERT INTO carts (product_id, quantity, user_id) VALUES (:product_id, 1, :user_id)", [
                'product_id' => $product_id, 
                'user_id' => $user_id
            ]);
        }
        
    }
    
    public function removeFromCart($cart_id)
    {
        $this->db->query("DELETE FROM carts WHERE cart_id = :cart_id", [
            'cart_id' => $cart_id
        ]);
    
    }
    
    public function getCartItemsByUserID($user_id){
        return $this->db->fetchAll("SELECT c.*, p.* FROM carts c LEFT JOIN products p ON c.product_id = p.product_id WHERE c.user_id = :user_id ORDER BY c.date_added_to_cart DESC", ['user_id' => $user_id]);
    }

    public function getCartItemsByCartID($cart_id){
        return $this->db->fetchAll("SELECT c.*, p.* FROM carts c LEFT JOIN products p ON c.product_id = p.product_id WHERE c.cart_id = :cart_id ORDER BY c.date_added_to_cart DESC", ['cart_id' => $cart_id]);
    }
    
    public function getCartItemByCartID($cart_id){
        return $this->db->fetch("SELECT c.*, p.* , u.artist_display_name, u.username FROM carts c LEFT JOIN products p ON c.product_id = p.product_id LEFT JOIN users u ON p.artist_id = u.user_id WHERE c.cart_id = :cart_id ORDER BY c.date_added_to_cart DESC", ['cart_id' => $cart_id]);
    }
    
    public function increaseQuantity($cart_id) {
        $this->db->query("UPDATE carts SET quantity = quantity + 1 WHERE cart_id = :cart_id", [
            'cart_id' => $cart_id
        ]);        
    }
    
    public function decreaseQuantity($cart_id) {
        
        $current_quantity = $this->db->fetch("SELECT quantity FROM carts WHERE cart_id = :cart_id", ['cart_id' => $cart_id]);
        
        if ((int)$current_quantity['quantity'] > 1){
        
            $this->db->query("UPDATE carts SET quantity = quantity - 1 WHERE cart_id = :cart_id", [
                'cart_id' => $cart_id
            ]);
        
        } else{
            
            $this->removeFromCart($cart_id);
        
        }
    
        
    }

    
    
    
}