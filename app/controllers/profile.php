<?php

class Profile extends Controller
{
    private $userModel;
    private $addressModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
        $this->addressModel = $this->model('AddressModel');
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

        if ($searched_user) {
            

            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['user_id'] == $searched_user['user_id']) {
                    $this->viewMyProfile();
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

    public function viewMyProfile()
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
    
    public function edit()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        
        $user_info = $this->userModel->checkIfLoggedIn();
        $artist_categories = $this->userModel->getArtistCategories();
        $regions = $this->addressModel->getAllRegion();
        
        if ($user_info) {
            $this->view('editProfileView', ['user_info' => $user_info, 'artist_categories' => $artist_categories, 'regions' => $regions]);
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
        $address = $_POST['address'];
        
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

        if (empty($address)) {
            if ($user_info['is_artist'] == 'true') {
                $errors['address'] = '- As an artist, an address is required';
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
                $this->userModel->updateUserAsArtistByUserID($user_info['user_id'], $new_file_name, $username, $email, $address, $artist_display_name, $artist_category_id);
            } else{
                $this->userModel->updateUserByUserID($user_info['user_id'], $new_file_name, $username, $email, $address);
            }
            
            // Redirect to a success page or log in
            echo 'success|' . BASEURL . 'profile';
        }

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
    
}