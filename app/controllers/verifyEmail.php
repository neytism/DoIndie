<?php

class VerifyEmail extends Controller
{
    private $userModel;
    
    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }
    
    public function index()
    {
        http_response_code(400);
    }
    
    public function verifyEmail(){
    
    }
    
    public function generateverificationCode(){
        return substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    }
}