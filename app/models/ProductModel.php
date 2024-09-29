<?php

class ProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    // SQL Queries as constants for better organization
    const SQL_FIND_PRODUCTS = "
        SELECT * 
        FROM products 
        JOIN users ON products.artist_id = users.user_id 
        LIMIT :count
    ";

    const SQL_CREATE_PRODUCT = "
        INSERT INTO products (
            title, 
            product_category_id, 
            product_picture_path, 
            artist_id, 
            price, 
            sale_price, 
            tags
            ) 
        VALUES (
            :title, 
            :product_category_id, 
            :product_picture_path, 
            :artist_id, 
            :price, 
            :sale_price ,
            :tags
            )";

    const SQL_FIND_ALL_PRODUCTS = "
        SELECT p.*, u.artist_display_name, u.username, c.product_category_name 
        FROM products p 
        JOIN users u ON p.artist_id = u.user_id 
        LEFT JOIN product_categories c ON p.product_category_id = c.product_category_id
    ";

    const SQL_FIND_PRODUCTS_BY_USERNAME = "
        SELECT p.*, u.artist_display_name, u.username, c.product_category_name 
        FROM products p 
        JOIN users u ON p.artist_id = u.user_id 
        LEFT JOIN product_categories c ON p.product_category_id = c.product_category_id 
        WHERE u.username = :username
    ";

    const SQL_GET_PRODUCT_CATEGORIES = "
        SELECT * 
        FROM product_categories
    ";

   //Find products with an optional limit.
    public function findProducts($count = null) {
        if ($count !== null) {
            return $this->db->fetchAll(self::SQL_FIND_PRODUCTS, ['count' => $count]);
        } else {
            return $this->db->fetchAll(self::SQL_FIND_ALL_PRODUCTS);
        }
    }

    //Create a new product in the database.
    public function createProduct($title, $product_category_id, $product_picture_path, $artist_id, $price, $sale_price = null, $tags = null) {
        $this->db->query(self::SQL_CREATE_PRODUCT, [
                'title' => $title,
                'product_category_id' => $product_category_id,
                'product_picture_path' => $product_picture_path,
                'artist_id' => $artist_id,
                'price' => $price,
                'sale_price' => $sale_price,
                'tags' => $tags,
            ]
        );
    }

    //Get all products with their associated artist and category information.
    public function getAllProducts() {
        return $this->db->fetchAll(self::SQL_FIND_ALL_PRODUCTS);
    }

    //Get all products for a specific user identified by their username.
    public function getAllProductsOfUserByUsername($username) {
        return $this->db->fetchAll(self::SQL_FIND_PRODUCTS_BY_USERNAME, ['username' => $username]);
    }

    //Get all product categories from the database.
    public function getProductCategories() {
        return $this->db->fetchAll(self::SQL_GET_PRODUCT_CATEGORIES);
    }
}