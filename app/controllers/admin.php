<?php

class Admin extends Controller
{
    private $userModel;
    private $productModel;
    private $transactionModel;
    
    public function __construct() {
        $this->userModel = $this->model('UserModel');
        $this->productModel = $this->model('ProductModel');
        $this->transactionModel = $this->model('TransactionModel');
    }
    
    public function index()
    {
        $this->dashboard();
    }
    
    private function checkUserAccess($requiredRole)
    {
        $user_info = $this->checkIfLoggedIn();

        if (!$user_info) {
            // Not logged in
            $this->view('homeView');
            return null;
        }

        if ($user_info['role'] != $requiredRole) {
            // Logged in but not an admin
            $this->view('homeView', ['user_info' => $user_info]);
            return null;
        }

        return $user_info; // Logged in as admin
    }

    public function checkIfLoggedIn()
    {
        session_start();
        return $this->userModel->checkIfLoggedIn();
    }

    public function dashboard()
    {
        $user_info = $this->checkUserAccess("0");
        
        if ($user_info) {
            $this->view('admin/adminDashBoardView', ['user_info' => $user_info]);
        }
    }
    
    public function users()
    {
        $user_info = $this->checkUserAccess("0");
        
        if ($user_info) {
            $all_users = $this->userModel->getAllUsers();
            $this->view('admin/adminUsersListView', ['all_users' => $all_users, 'user_info' => $user_info]);
        }
    }

    public function artists()
    {
        $user_info = $this->checkUserAccess("0");
        
        if ($user_info) {
            $all_artists = $this->userModel->getAllArtist();
            $this->view('admin/adminArtistsListView', ['all_artists' => $all_artists, 'user_info' => $user_info]);
        }
    }

    public function admins()
    {
        $user_info = $this->checkUserAccess("0");
        
        if ($user_info) {
            $all_admins = $this->userModel->getAllAdmins();
            $this->view('admin/adminAdminsListView', ['all_admins' => $all_admins, 'user_info' => $user_info]);
        }
    }
    
    public function products()
    {
        $user_info = $this->checkUserAccess("0");
        
        if ($user_info) {
            $all_products = $this->productModel->getAllProducts();
            $this->view('admin/adminProductsListView', ['all_products' => $all_products, 'user_info' => $user_info]);
        }
    }

    public function transactions()
    {
        $user_info = $this->checkUserAccess("0");
        
        if ($user_info) {
            $all_transactions = $this->transactionModel->getAllTransactions();
            $this->view('admin/adminTransactionsListView', ['all_transactions' => $all_transactions, 'user_info' => $user_info]);
        }
    }
}