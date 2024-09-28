<?php

class Login extends Controller {

    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');  
    }
    
    public function index() {
        
    }
    
    public function popUp() {
        include 'app/views/logInView.php';
    }
    
    public function checkLogIn() {
        $username = $_POST['username'];
        $password = $_POST['password'];  
           
        if($username == null || empty($username)){
            echo 'username required';
            return;
        }
        
        if($password == null || empty($password)){
            echo 'password required';
            return;
        }

        $user_info = $this->userModel->findUserByUsername($username);

        if (!$user_info) {
            echo 'username or password incorrect';
            return;
        }
        
        $storedPassword = $user_info['password'];
        list($hashedPassword, $salt) = explode("::", $storedPassword);
        
        if ($user_info && password_verify( $password.$salt, $hashedPassword )) {
            session_start();
            $_SESSION['user_id'] = $user_info['user_id'];
            echo 'success:'.BASEURL;
            exit();
        } else {
            echo 'error:Username or password is incorrect';
        }
    }
    
    public function logout() {
        session_start();
        session_destroy();
        header('Location: ' . BASEURL);
    }
    
    function hashPassword($password) {
        // Generate a random salt
        $salt = bin2hex(random_bytes(16));
        
        // Hash the password with the salt
        $hashedPassword = password_hash($password . $salt, PASSWORD_DEFAULT);
        
        return array(
          'hash' => $hashedPassword,
          'salt' => $salt
        );
      }
}