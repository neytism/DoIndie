<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }
    
    //test
    public function findUserByUsername($username) {
        return $this->db->fetch("SELECT * FROM users WHERE username = :username", ['username' => $username]);
    }
    
    public function findUserByUserID($user_id) {
        return $this->db->fetch("SELECT * FROM users WHERE user_id = :user_id", ['user_id' => $user_id]);
    }
    
    public function checkIfUserExistByUsername($username) {
        $user = $this->db->fetch("SELECT * FROM users WHERE username = :username", ['username' => $username]);
        return $user ? true : false;
    }

    public function checkIfUserExistByEmail($email) {
        $user = $this->db->fetch("SELECT * FROM users WHERE email = :email", ['email' => $email]);
        return $user ? true : false;
    }
    
    public function verifyUserEmailByUserID($user_id, $is_verified_email) {
        $this->db->fetch("UPDATE users SET is_verified_email = :is_verified_email WHERE user_id = :user_id", ['is_verified_email' => $is_verified_email, 'user_id' => $user_id]);
    }

    public function checkIfLoggedIn(){
        if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            return $this->findUserByUserID($user_id);
        } else {
            return false;
        }
    }
    
    public function getArtistCategories(){
        return $this->db->fetchAll("SELECT * FROM artist_categories");
    }

    public function createUser($email, $username, $password) {
        $picture_path = 'default_profile_picture.png'; //remove after implementing upload
        $role = '1';
        
        $this->db->query("INSERT INTO users (email, username, password, first_name, picture_path, role) VALUES (:email, :username, :password, :first_name, :picture_path , :role)", [
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'first_name' => $username,
            'picture_path' => $picture_path ,
            'role' => $role
        ]);

        return $this->db->lastInsertId();
    }

    public function setUserAsArtist($user_id, $artist_name, $artist_category_id) {
        $this->db->query("UPDATE users SET artist_display_name = :artist_name, artist_category_id = :artist_category_id, is_artist = :is_artist WHERE user_id = :user_id", [
            'artist_name' => $artist_name,
            'artist_category_id' => $artist_category_id,
            'is_artist' => 'true',
            'user_id' => $user_id
        ]);
    }
    public function getAllArtist(){
        return $this->db->fetchAll("SELECT u.*, c.artist_category_name FROM users u LEFT JOIN artist_categories c ON u.artist_category_id = c.artist_category_id WHERE u.is_artist = 'true'");
    }
    
    public function updateUserAsArtistByUserID($user_id, $image, $username, $email, $artist_display_name, $artist_category_id){
        $this->db->query("UPDATE users SET picture_path = :image, username = :username, email = :email, artist_display_name = :artist_display_name, artist_category_id = :artist_category_id WHERE user_id = :user_id", [
            'image' => $image,
            'username' => $username,
            'email' => $email,
            'artist_display_name' => $artist_display_name ,
            'artist_category_id' => $artist_category_id,
            'user_id' => $user_id
        ]);
    }

    public function updateUserByUserID($user_id, $image, $username, $email){
        $this->db->query("UPDATE users SET picture_path = :image, username = :username, email = :email, WHERE user_id = :user_id", [
            'image' => $image,
            'username' => $username,
            'email' => $email,
            'user_id' => $user_id
        ]);
    }

    public function searchUsers($keyword, $count){
        return $this->db->fetchAll("SELECT u.*, c.artist_category_name FROM users u LEFT JOIN artist_categories c ON u.artist_category_id = c.artist_category_id WHERE username LIKE :keyword LIMIT $count", [
            'keyword' => '%'.$keyword.'%'
        ]);
    }

    public function searchArtists($keyword, $count){
        return $this->db->fetchAll("SELECT u.*, c.artist_category_name FROM users u LEFT JOIN artist_categories c ON u.artist_category_id = c.artist_category_id WHERE is_artist = 'true' AND artist_display_name LIKE :keyword LIMIT $count", [
            'keyword' => '%'.$keyword.'%'
        ]);
    }

    public function getAllUsers(){
        return $this->db->fetchAll("SELECT user_id, username, email, is_verified_email, picture_path, is_artist, role, date_joined FROM users");

    }
    
}