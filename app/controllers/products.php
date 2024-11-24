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
        $product_categories = $this->productModel->getProductCategories();

        if ($searched_user) {
            if ($searched_user['is_artist'] == 'true') {
                if (isset($_SESSION['user_id'])) {
                    if ($_SESSION['user_id'] == $searched_user['user_id']) {
                        $this->view('userProductsView', ['user_info' => $user_info, 'searched_user' => $searched_user, 'searched_user_products' => $searched_user_products, 'is_self' => true, 'product_categories' => $product_categories]);
                    } else {
                        $this->view('userProductsView', ['user_info' => $user_info, 'searched_user' => $searched_user, 'searched_user_products' => $searched_user_products, 'is_self' => false, 'product_categories' => $product_categories]);
                    }

                } else {
                    $this->view('userProductsView', ['searched_user' => $searched_user, 'searched_user_products' => $searched_user_products, 'is_self' => false, 'product_categories' => $product_categories]);
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
        $product_categories = $this->productModel->getProductCategories();
        
        if ($user_info) {
            $this->view('productsView', ['user_info' => $user_info, 'all_products' => $all_products, 'product_categories' => $product_categories]);
        } else {
            $this->view('productsView', ['all_products' => $all_products, 'product_categories' => $product_categories]);
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
    
    public function edit($id)
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();
        $product_info = $this->productModel->getProductById($id);
        //add defensive code if not the artist
        $product_categories = $this->productModel->getProductCategories();
        
        if ($user_info) {
            $this->view('editProductView', ['user_info' => $user_info,  'product_categories' => $product_categories , 'product_info' => $product_info]);
        } 
    
    }

    public function verifyProductEdit($id)
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();
        $product_info = $this->productModel->getProductById($id);
        $new_file_name = '';
        
        $errors = array(
            'image' => '',
            'title' => '',
            'description' => '',
            'tags' => '',
            'product_category_id' => '',
            'price' => '',
        );
        
        $title = $_POST['title'];
        $product_description = $_POST['product_description'];
        $tags = $_POST['tags'];
        $product_category_id = $_POST['product_category_id'];
        $price = $_POST['price'];
    
        
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $image = $_FILES['image'];
            
            $move_to_path = 'uploads/images/product_pictures/';
            $image_file_type = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));

            $existing_files = glob($move_to_path . $product_info['product_picture_path'] . ".*");
        
            // Remove any existing files from old title
            foreach ($existing_files as $existing_file) {
                if (file_exists($existing_file)) {
                    unlink($existing_file); // Deletes the file
                }
            }
            
            // Format title for the new file name
            $format_title = strtolower($title); // Assuming $title is defined and contains the product title
            $format_title = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $format_title);
            $format_title = preg_replace('/_+/', '_', $format_title);
            $format_title = trim($format_title, '_');
            
            // New file name based on user ID and formatted title
            $new_file_name_no_ext = $user_info['user_id'] . "_" . $format_title;
            $new_file_name = $user_info['user_id'] . "_" . $format_title . "." . $image_file_type;
            $new_file_path = $move_to_path . $new_file_name;
        
            $existing_files = glob($move_to_path . $new_file_name_no_ext . ".*");
        
            // Remove any existing files
            foreach ($existing_files as $existing_file) {
                if (file_exists($existing_file)) {
                    unlink($existing_file); // Deletes the file
                }
            }
        
            // Set maximum file size (5 MB)
            $mb = 5; 
            $max_file_size = $mb * 1024 * 1024; // Convert MB to bytes
        
            // Validate file size
            if ($image["size"] > $max_file_size) {
                $errors['image'] = '- File is too large. Max ' . $mb . 'MB.';
            }
        
            // Validate file type
            if ($image_file_type != "jpg" && $image_file_type != "png" && 
                $image_file_type != "jpeg" && $image_file_type != "gif") {
                $errors['image'] = '- Only JPG, JPEG, PNG & GIF files are allowed.';
            }
        
            // If there are no errors, move the uploaded file
            if (!array_filter($errors)) {
                if (move_uploaded_file($image["tmp_name"], $new_file_path)) {
                    // Successfully uploaded
                    $image = $new_file_name; // Set the new file name
                } else {
                    // Error during upload
                    $errors['image'] = '- There was an error uploading your file.';
                }
            }
        } else {
            // Handle case where no image was uploaded
            $new_file_name = $product_info['product_picture_path'];
        }
               
        
        if (array_filter($errors)) {
            //has errors
            echo 'error/s: <br>' . implode("<br>", array_filter($errors));
        } else {
            
            $this->productModel->updateProductByID($id, $new_file_name, $title, $product_description, $tags, $product_category_id, $price);
            
            // Redirect to a success page or log in
            echo 'success|' . BASEURL . 'products';
        }
    
    }

    public function delete($id)
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        
        $product_info = $this->productModel->getProductById($id);

        if($product_info['product_picture_path'] != 'default_product_picture.png'){

            $move_to_path = 'uploads/images/product_pictures/';

            $filename_without_extension = pathinfo($product_info['product_picture_path'], PATHINFO_FILENAME);
        
            $existing_files = glob($move_to_path . $filename_without_extension . ".*");
        
            // Remove any existing files from old title
            foreach ($existing_files as $existing_file) {
                if (file_exists($existing_file)) {
                    unlink($existing_file); // Deletes the file
                }
            }

        }
            
        $this->productModel->deleteProductByID($id);
            
        // Redirect to a success page or log in
        echo 'success|' . BASEURL . 'products';
    
    }
    
}