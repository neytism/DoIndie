<?php

class Profile extends Controller
{
    private $userModel;
    private $addressModel;
    private $productModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
        $this->addressModel = $this->model('AddressModel');
        $this->productModel = $this->model('ProductModel');
    }

    public function index()
    {
        $this->viewMyProfile();
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
        $searched_user_products = $this->productModel->getTopProductsByUsername($username);
        if($user_info){
            $user_products = $this->productModel->getTopProductsByUsername($user_info['username']);
        }
       
        
        
        if ($searched_user) {
            

            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['user_id'] == $searched_user['user_id']) {
                    $this->viewMyProfile();
                } else {
                    $this->view('userProfileView', ['user_info' => $user_info, 'searched_user' => $searched_user, 'is_self' => false, 'searched_user_products' => $searched_user_products, 'user_products' => $user_products  ]);
                }
            
            } else {
                $this->view('userProfileView', ['user_info' => $user_info, 'searched_user' => $searched_user, 'is_self' => false, 'searched_user_products' => $searched_user_products]);
            }

        } else {
            //user not found
            http_response_code(400);
        }

    }
    
    public function viewMyProfile()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();
        $user_products = $this->productModel->getTopProductsByUsername($user_info['username']);

        if ($user_info) {
            $this->view('userProfileView', ['user_info' => $user_info, 'is_self' => true, 'user_products' => $user_products]);
        } else {
            $this->view('homeView');
        }
    
    }
    
    public function edit()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();
        $user_address = $this->addressModel->getAddressOfUserByUserID($user_info['user_id']);
        $artist_categories = $this->userModel->getArtistCategories();
        $regions = $this->addressModel->getAllRegion();
        $provinces = $this->addressModel->getAllProvinceByRegionCode($this->addressModel->getRegionCodeByRegionID($user_address['region_id']));
        $cities = $this->addressModel->getAllCityByProvinceCode($this->addressModel->getProvinceCodeByProvinceID($user_address['province_id']));
        $brgys = $this->addressModel->getAllBrgyByCityCode($this->addressModel->getCityMunCodeByCityMunID($user_address['city_id']));
        
        if ($user_info) {
            $this->view('editProfileView', ['user_info' => $user_info,  'user_address' => $user_address , 'artist_categories' => $artist_categories, 'regions' => $regions, 'provinces' => $provinces, 'cities' => $cities, 'brgys' => $brgys]);
        } 
    
    }
    
    public function verifyProfileEdit()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();
        $new_file_name = '';
        
        $errors = array(
            'image' => '',
            'username' => '',
            'email' => '',
            'address' => '',
            'artist_display_name' => '',
            'artist_category_id' => '',
        );
        
        $username = $_POST['username'];
        
        
        if($user_info['is_verified_email'] != 'true'){
            $email = $_POST['email'];
        }
        
        if ($user_info['is_artist'] == 'true') {
            $artist_display_name = $_POST['artist_display_name'];
            $artist_category_id = $_POST['artist_category_id'];
        }
        
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {

            $image = $_FILES['image'];
        
            $move_to_path = 'uploads/images/profile_pictures/';
            $image_file_type = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
        
            // New file name based on user ID
            $new_file_name = $user_info['user_id'] . "." . $image_file_type;
            $new_file_path = $move_to_path . $new_file_name;
        
            // Check for existing files with the same user ID (regardless of extension)
            $existing_files = glob($move_to_path . $user_info['user_id'] . ".*");
        
            // Remove any existing files
            foreach ($existing_files as $existing_file) {
                if (file_exists($existing_file)) {
                    unlink($existing_file); // Deletes the file
                }
            }
        
            $mb = 5; // size in mb
            $max_file_size = $mb * 1024 * 1024; // convert mb to bytes
        
            if ($image["size"] > $max_file_size) {
                $errors['image'] = '- File is too large. Max ' . $mb . 'MB.';
            }
        
            if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif") {
                $errors['image'] = '- Only JPG, JPEG, PNG & GIF files are allowed.';
            }
        
            if (!array_filter($errors)) {
                if (move_uploaded_file($image["tmp_name"], $new_file_path)) {
                    $image = $new_file_name; // Set the new file name
                } else {
                    $errors['image'] = '- There was an error uploading your file.';
                }
            }
        } else{
            $new_file_name = $user_info['picture_path'];
        }
        

        //username validation
        if (empty($username)) {
            $errors['username'] = '- username is required.';
        } else {

            if ($user_info['username'] != $username) {
                
                if (strlen($username) < 8) {
                    $errors['username'] = '- Must be atleast 8 characters.';
                } elseif ($this->HasSpecialCharacters($username)) {
                    $errors['username'] = '- Invalid username.';
                } elseif (strlen($username) < 8 && $this->HasSpecialCharacters($username)) {
                    $errors['username'] = '- Invalid username.';
                } elseif ($this->userModel->checkIfUserExistByUsername($username)) {
                    $errors['username'] = '- Username Taken.';
                }

            }

        }
        
        //email validation, cant change if verified
        if($user_info['is_verified_email'] != 'true'){
            
            $email = strtolower($email);

            if (empty($email)) {
                $errors['email'] = '-An email is required';
            } else {
                if ($user_info['email'] != $email) {

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors['email'] = '- Email must be a valid email address';
                    } elseif ($this->userModel->checkIfUserExistByEmail($email)) {
                        $errors['email'] = '- Email used by other account.';
                    }

                }

            }
        } else{
            $email = $user_info['email'];
        }
        
        $region_code = $_POST['region_id'];
        $province_code = $_POST['province_id'];
        $city_code = $_POST['city_id'];
        $brgy_code = $_POST['brgy_id'];
        $detailed_address = $_POST['detailed_address'];
        $landmark = $_POST['landmark'];

        if (empty($region_code) || empty($province_code) || empty($city_code) || empty($brgy_code) || empty($detailed_address)) {
            if ($user_info['is_artist'] == 'true') {
                $errors['address'] = '- As an artist, a valid address is required';
            }
        }
        
        if ($user_info['is_artist'] == 'true') {
            
            if (empty($artist_display_name)) {
                $errors['artist_display_name'] = '- Artist display name is required.';
            }
            
            if (empty($artist_category_id)) {
                $errors['artist_category_id'] = '- Artist category is required.';
            }
        
        }
        
        
        if (array_filter($errors)) {
            //has errors
            echo 'error/s: <br>' . implode("<br>", array_filter($errors));
        } else {
            
            if ($user_info['is_artist'] == 'true') {
                $this->userModel->updateUserAsArtistByUserID($user_info['user_id'], $new_file_name, $username, $email, $artist_display_name, $artist_category_id, $_POST['full_name'], $_POST['phone_number']);
            } else{
                $this->userModel->updateUserByUserID($user_info['user_id'], $new_file_name, $username, $email, $_POST['full_name'], $_POST['phone_number']);
            }
            
            $region_id = $this->addressModel->getRegionIDByRegCode($region_code);
            $province_id = $this->addressModel->getProvinceIDByProvCode($province_code);
            $city_id = $this->addressModel->getCityMunIDByCityMunCode($city_code);
            $brgy_id = $this->addressModel->getBrgyIDByBrgyCode($brgy_code);
            
            $this->addressModel->updateUserAddressByUserID($user_info['user_id'], $brgy_id, $city_id, $province_id, $region_id, $detailed_address, $landmark);
            
            // Redirect to a success page or log in
            echo 'success|' . BASEURL . 'profile';
        }
    
    }

    function updateOnCheckout(){
        if (session_status() == PHP_SESSION_NONE)
            session_start();

        $user_info = $this->userModel->checkIfLoggedIn();

        $region_code = $_POST['region_id'];
        $province_code = $_POST['province_id'];
        $city_code = $_POST['city_id'];
        $brgy_code = $_POST['brgy_id'];
        $detailed_address = $_POST['detailed_address'];
        $landmark = $_POST['landmark'];
        $full_name = $_POST['full_name'];
        $phone_number = $_POST['phone_number'];

        $this->userModel->updateUserOnCheckout($user_info['user_id'], $full_name, $phone_number);

        $region_id = $this->addressModel->getRegionIDByRegCode($region_code);
        $province_id = $this->addressModel->getProvinceIDByProvCode($province_code);
        $city_id = $this->addressModel->getCityMunIDByCityMunCode($city_code);
        $brgy_id = $this->addressModel->getBrgyIDByBrgyCode($brgy_code);
        
        $this->addressModel->updateUserAddressByUserID($user_info['user_id'], $brgy_id, $city_id, $province_id, $region_id, $detailed_address, $landmark);
        
        // Redirect to a success page or log in
        echo 'success|' . '';
        
    }
    
    function HasSpecialCharacters($str)
    {
        return preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $str);
    }

    //should be somwhere else

    function checkRegion($region_code){
        
        $provinces = $this->addressModel->getAllProvinceByRegionCode($region_code);

        if (empty(array_filter($provinces))) {

            echo 'null|';
            
        } else {
            
            $results = json_encode( $provinces);
            echo 'notnull|' . $results;
        }

    }

    function checkProvince($province_code){
        
        $cities = $this->addressModel->getAllCityByProvinceCode($province_code);

        if (empty(array_filter($cities))) {

            echo 'null|';
            
        } else {
            
            $cities = $this->convertEncoding($cities);

            $results = json_encode($cities);

                if ($results === false) {
                    echo 'error|' . json_last_error_msg(); 
                } else {
                    echo 'notnull|' . $results;
                }
        }

    }

    function checkCity($city_code){
        
        $brgys = $this->addressModel->getAllBrgyByCityCode($city_code);

        if (empty(array_filter($brgys))) {

            echo 'null|';
            
        } else {

            $brgys = $this->convertEncoding($brgys);
            
            $results = json_encode($brgys, JSON_UNESCAPED_UNICODE);
            echo 'notnull|' . $results;
        }

    }
    
    public function convertEncoding($arrays){

        return array_map(function($array) {
            return array_map(function($value) {
                return mb_convert_encoding($value, 'UTF-8', 'ISO-8859-1');
            }, $array);
        }, $arrays);

    }

    
    
}