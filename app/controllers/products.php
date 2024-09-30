<?php

class Products extends Controller
{
    private $userModel;
    private $productModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
        $this->productModel = $this->model('ProductModel');
    }

    public function index()
    {
        $this->allProducts();
    }

    public function artist($username = '')
    {
        if (empty($username)) {
            http_response_code(400);
        }

        //something is wrong with this code

        session_start();

        $searched_user = $this->userModel->findUserByUsername(strtolower($username));
        $user_info = $this->userModel->checkIfLoggedIn();
        $searched_user_products = $this->productModel->getAllProductsOfUserByUsername($username);

        if ($searched_user) {
            if ($searched_user['is_artist'] == 'true') {
                if (isset($_SESSION['user_id'])) {
                    if ($_SESSION['user_id'] == $searched_user['user_id']) {
                        $this->view('userProductsView', ['user_info' => $user_info, 'searched_user' => $searched_user, 'searched_user_products' => $searched_user_products, 'is_self' => true]);
                    } else {
                        $this->view('userProductsView', ['user_info' => $user_info, 'searched_user' => $searched_user, 'searched_user_products' => $searched_user_products, 'is_self' => false]);
                    }

                } else {
                    $this->view('userProductsView', ['searched_user' => $searched_user, 'searched_user_products' => $searched_user_products, 'is_self' => false]);
                }

            } else {
                http_response_code(400);
            }

        } else {
            //user not found
            http_response_code(400);
        }

    }

    public function allProducts(){
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();
        $all_products = $this->productModel->getAllProducts();
        
        if ($user_info) {
            $this->view('productsView', ['user_info' => $user_info, 'all_products' => $all_products]);
        } else {
            $this->view('productsView', ['all_products' => $all_products]);
        }
    }

    public function upload(){
        $product_categories = $this->productModel->getProductCategories();
        $this->view('addNewProductView', ['product_categories' => $product_categories]);
    }

    public function increaseViewCount(){
        $product_id = $_POST['product_id'];
            
        $this->productModel->increaseViewCount($product_id);
    }
    
}