<?php

enum Test {
    case Normal;
}

class ProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }
    
    //test
    public function findProducts($count = null) {
        if($count != null){
            return $this->db->fetch("SELECT * FROM products JOIN users ON products.artist_id = users.user_id LIMIT :count", ['count' => $count]);
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



    
}