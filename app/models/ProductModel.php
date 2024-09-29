<?php

class ProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }
    
    //test
    public function findProducts($count = null) {
        if($count != null){
            return $this->db->fetchAll("SELECT * FROM products JOIN users ON products.artist_id = users.user_id LIMIT :count", ['count' => $count]);
        } else{
            return $this->db->fetch("SELECT * FROM products JOIN users ON products.artist_id = users.user_id");
        }
    }
    
    public function createProduct($title, $product_picture_path, $artist_id, $price, $sale_price, $tags) {
        $product_picture_path = 'default_product_picture.png'; //remove after implementing uploading
        $this->db->query("INSERT INTO products (title, product_picture_path, artist_id, price, sale_price, tags) VALUES (:title, :product_picture_path, :artist_id, :price, :sale_price ,:tags)", [
            'title' => $title,
            'product_picture_path' => $product_picture_path,
            'artist_id' => $artist_id,
            'price' => $price,
            'sale_price' => $sale_price,
            'tags' => $tags,
        ]);
    }

    public function getAllProducts(){
        return $this->db->fetchAll("SELECT p.*, u.artist_display_name, u.username FROM products p JOIN users u ON p.artist_id = u.user_id");
    }

    public function getAllProductsOfUserByUsername($username){
        return $this->db->fetchAll("SELECT p.*, u.artist_display_name, u.username FROM products p JOIN users u ON p.artist_id = u.user_id WHERE u.username = :username", ['username' => $username]);
    }
    
    public function getProductCategories(){
        return $this->db->fetchAll("SELECT * FROM product_categories");
    }


    
}