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
    
    public function createProduct($title, $product_category_id, $product_picture_path, $artist_id, $price, $sale_price, $tags) {
        $this->db->query("INSERT INTO products (title, product_category_id, product_picture_path, artist_id, price, sale_price, tags) VALUES (:title, :product_category_id, :product_picture_path, :artist_id, :price, :sale_price ,:tags)", [
            'title' => $title,
            'product_category_id' => $product_category_id,
            'product_picture_path' => $product_picture_path,
            'artist_id' => $artist_id,
            'price' => $price,
            'sale_price' => $sale_price,
            'tags' => $tags,
        ]);
    }

    public function getAllProducts(){
        return $this->db->fetchAll("SELECT p.*, u.artist_display_name, u.username, c.product_category_name FROM products p JOIN users u ON p.artist_id = u.user_id LEFT JOIN product_categories c ON p.product_category_id = c.product_category_id");
    }
    
    public function getAllProductsOfUserByUsername($username){
        return $this->db->fetchAll("SELECT p.*, u.artist_display_name, u.username, c.product_category_name FROM products p JOIN users u ON p.artist_id = u.user_id LEFT JOIN product_categories c ON p.product_category_id = c.product_category_id WHERE u.username = :username", ['username' => $username]);
    }
    
    public function getProductCategories(){
        return $this->db->fetchAll("SELECT * FROM product_categories");
    }


    
}