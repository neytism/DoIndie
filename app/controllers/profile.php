<?php

class Profile extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }

    public function index()
    {
        $this->myProfile();
    }

    public function user($username = '')
    {
        if (empty($username)) {
            http_response_code(400);
        }

        //something is wrong with this code

        session_start();
        
        $searched_user = $this->userModel->findUserByUsername(strtolower($username));
        $user_info = $this->userModel->checkIfLoggedIn();

        if ($searched_user) {
            

            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['user_id'] == $searched_user['user_id']) {
                    $this->myProfile();
                } else {
                    $this->view('userProfileView', ['user_info' => $user_info, 'searched_user' => $searched_user, 'is_self' => false]);
                }
            
            } else {
                $this->view('userProfileView', ['user_info' => $user_info, 'searched_user' => $searched_user, 'is_self' => false]);
            }

        } else {
            //user not found
            http_response_code(400);
        }

    }

    public function myProfile()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();

        if ($user_info) {
            $this->view('userProfileView', ['user_info' => $user_info, 'is_self' => true]);
        } else {
            $this->view('homeView');
        }

    }
    
}