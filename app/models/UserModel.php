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
    }

    public function setUserAsArtist($user_id, $artist_name, $address, $artist_category_id) {
        $this->db->query("UPDATE users SET artist_display_name = :artist_name, address = :address, artist_category_id = :artist_category_id, is_artist = :is_artist WHERE user_id = :user_id", [
            'artist_name' => $artist_name,
            'address' => $address,
            'artist_category_id' => $artist_category_id,
            'is_artist' => 'true',
            'user_id' => $user_id
        ]);
    }


    
}