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
        return $this->db->fetch("SELECT * FROM users WHERE id = :user_id", ['user_id' => $user_id]);
    }

    public function checkIfUserExistByUsername($username) {
        $user = $this->db->fetch("SELECT * FROM users WHERE username = :username", ['username' => $username]);
        return $user ? true : false;
    }

    public function checkIfUserExistByEmail($email) {
        $user = $this->db->fetch("SELECT * FROM users WHERE email = :email", ['email' => $email]);
        return $user ? true : false;
    }

    public function createUser($email, $username, $password) {
        $this->db->query("INSERT INTO users (email, username, password, first_name, picture_path, role) VALUES (:email, :username, :password, :first_name, 'default_profile_picture.png' , '1')", [
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'first_name' => $username
        ]);
    }


    
}