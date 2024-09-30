<?php

class AddProduct extends Controller
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
        http_response_code(400); 
    }
    
    public function checkProduct(){
        session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();
        $new_file_name = '';

        $errors = array(
            'image' => '',
            'title' => '',
            'price' => '',
            'category_id' => '',
            'tags' => ''
        );
        
        $title = $_POST['title'];
        $price = $_POST['price'];
        $category_id = $_POST['product_category_id'];
        $product_description = $_POST['product_description'];
        $tags = $_POST['tags'];
        
        if (empty($category_id)) {
            $errors['category_id'] = '-Category is required';
        }

        if (empty($price)) {
            $errors['price'] = '-Price is required';
        }

        if (empty($product_description)) {
            $product_description = 'No description.';
        }
    
        
        if (isset($_FILES['image'])) {
            
            $image = $_FILES['image'];
            
            $move_to_path = 'uploads/images/product_pictures/';
            $target_file = $move_to_path . basename($image["name"]);
            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            $format_title = strtolower($title);
            $format_title = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $format_title);
            $format_title = preg_replace('/_+/', '_', $format_title);
            $format_title = trim($format_title, '_');
            $new_file_name = $user_info['user_id'] . "_" . $format_title . "." . $image_file_type;
            $new_file_path = $move_to_path . $new_file_name;

            if (file_exists($new_file_path)) {
                $errors['image'] = '-File already exists';
            }
            
            $mb = 5; // size in mb
            $max_file_size = $mb * 1024 * 1024; // convert mb to bytes
        
            if ($image["size"] > $max_file_size) {
                $errors['image'] = '- File is too large. Max '. $mb .'MB.';
            }

            if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif") {
                $errors['image'] = '-Only JPG, JPEG, PNG & GIF files are allowed';
            }

            if(!array_filter($errors)){

                if (move_uploaded_file($image["tmp_name"], $new_file_path)) {
                    $image = $new_file_name;
                } else {
                    $errors['image'] = '-There was an error uploading your file';
                }
            }
        
        } else{
            $errors['image'] = '-Image is required';
        }
        
        
        
        if (array_filter($errors)) {
            //has errors
            echo 'error/s: <br>'. implode("<br>", array_filter($errors));
        } else{
            
            $this->productModel->createProduct($title, $category_id, $new_file_name , $user_info['user_id'], $price, $price, $product_description, $tags );
            // Redirect to a success page or log in
            echo 'success|'.BASEURL.'products/artist/'.$user_info['username'];
        }
        
    }

}