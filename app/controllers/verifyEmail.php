<?php

class VerifyEmail extends Controller
{
    private $emailer;
    private $userModel;
    
    public function __construct() {
        $this->userModel = $this->model('UserModel');
        $this->emailer = new Emailer();
    }
    
    public function index()
    {
        $this->checkIfLoggedIn();   
    }
    
    protected function checkIfLoggedIn(){
        session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();

        if ($user_info) {
            $this->generateVerificationCode($user_info);
            $this->view('verifyEmailView', ['user_info' => $user_info]);
        } else {
            $this->view('homeView');
        }
    }
    
    public function verify(){
        if (session_status() == PHP_SESSION_NONE) session_start();

        $code = $_POST['code'];

        if (isset($_SESSION['code_created_at']) && (time() - $_SESSION['code_created_at'] > 180)) {
            // Code has expired
            unset($_SESSION['verification_code']); 
            unset($_SESSION['code_created_at']); 
            echo 'error: code expired';
        } else {
            if($code == $_SESSION['verification_code']){
                $this->userModel->verifyUserEmailByUserID($_SESSION['user_id'], 'true');
                unset($_SESSION['verification_code']); 
                unset($_SESSION['code_created_at']); 
                echo 'success|'.BASEURL;
                
            } else{
                echo 'error: incorrect code';
            }
            
        }
    
    }

    public function clearStoredCode(){
        if (isset($_SESSION['code_created_at']) && isset($_SESSION['verification_code'])) {
            unset($_SESSION['verification_code']); 
            unset($_SESSION['code_created_at']);
        } 
    }
    
    public function generateVerificationCode($user_info){
        $code = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
        
        if (session_status() == PHP_SESSION_NONE) session_start();
    
        if (!isset($_SESSION['verification_code'])) {
            $_SESSION['verification_code'] = $code;
            $_SESSION['code_created_at'] = time(); 
            
            $message = include 'app/views/verifyEmailTemplate.php';
            
            $this->emailer->sendMail($user_info['email'], 'noreply: Doindie Email Verification Code', $message);
        }
    }
    
    //remove
    public function unverify(){
        session_start();
        $this->userModel->verifyUserEmailByUserID($_SESSION['user_id'], 'false');
    }
}