<?php 

class Test extends Controller{
    
    private $userModel;
    
    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }
    
    public function index()
    {
        $user_info = $this->userModel->findUserByUsername('admin000');
        $this->view('testView', ['user_info' => $user_info]); 
    }

    public function goTo($newView){
        $this->view($newView); 
    }
    
    public function directUrl(){
        $voucher_code = $_POST['voucher_code'];

        echo $voucher_code;
    }

    
}