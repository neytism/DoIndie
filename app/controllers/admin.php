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
            $all_users = $this->userModel->getAllUsersByNewest();
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

    public function artistCategories()
    {
        $user_info = $this->checkUserAccess("0");
        
        if ($user_info) {
            $artist_categories = $this->userModel->getArtistCategories();
            $this->view('admin/adminArtistCategoriesListView', ['artist_categories' => $artist_categories, 'user_info' => $user_info]);
        }
    }

    public function productCategories()
    {
        $user_info = $this->checkUserAccess("0");
        
        if ($user_info) {
            $product_categories = $this->productModel->getProductCategories();
            $this->view('admin/adminProductCategoriesListView', ['product_categories' => $product_categories, 'user_info' => $user_info]);
        }
    }
    
    public function products()
    {
        $user_info = $this->checkUserAccess("0");
        
        if ($user_info) {
            $all_products = $this->productModel->getAllProductsByNewest();
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

    public function makeAdmin($id){
        $user_info = $this->checkUserAccess("0");

        if ($user_info) {
            $this->userModel->makeUserAdminByIdD($id);
        }
    }

    public function removeAdmin($id){
        $user_info = $this->checkUserAccess("0");

        if ($user_info) {
            $this->userModel->removeUserAdminByIdD($id);
        }
    }

    public function deleteUser($id){
        $user_info = $this->checkUserAccess("0");

        if ($user_info) {
            $this->userModel->deleteUserDataByID($id);
        }
    }

    public function addNewArtistCategory(){
        $user_info = $this->checkUserAccess("0");
        
        if ($user_info) {
            $artist_category_name = $_POST['artist_category_name'];
        
            $this->userModel->addArtistCategory($artist_category_name);
        }
    }

    public function updateArtistCategoryName(){
        $user_info = $this->checkUserAccess("0");
        
        if ($user_info) {
            $artist_category_name = $_POST['artist_category_name'];
            $artist_category_id = $_POST['artist_category_id'];
        
            $this->userModel->updateCategoryNameByID($artist_category_id, $artist_category_name);
        }
    }

    public function updateProductCategoryName(){
        $user_info = $this->checkUserAccess("0");
        
        if ($user_info) {
            $product_category_name = $_POST['product_category_name'];
            $product_category_id = $_POST['product_category_id'];
        
            $this->productModel->updateCategoryNameByID($product_category_id, $product_category_name);
        }
    }
}