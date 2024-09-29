<?php 

class SignUp extends Controller{
    
    private $userModel;
    
    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }

    public function index()
    {
        $this->view('signUpView'); 
    }

    public function checkSignUp()
    {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repeat_password = $_POST['repeat_password'];
        
        $username = strtolower($username);
        
        $errors = array(
            'email' => '',
            'username' => '',
            'password' => '',
            'repeat_password' => ''
        );
        
        //email validation
        $email = strtolower($email);

        if(empty($email)){
            $errors['email'] = '-An email is required';
        } else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = '-Email must be a valid email address';
            } elseif ($this->userModel->checkIfUserExistByEmail($email)) {
                $errors['email'] = '- Email used by other account.';
            }
        }

        //username validation
        if (empty($username)) {
            $errors['username'] = '- username is required.';
        } else{
            
            if (strlen($username) < 8) {
                $errors['username'] = '- Must be atleast 8 characters.';
            } elseif ($this -> HasSpecialCharacters($username)) {
                $errors['username'] = '- Invalid username.';
            } elseif (strlen($username) < 8 && $this -> HasSpecialCharacters($username)) {
                $errors['username'] = '- Invalid username.';
            } elseif ($this->userModel->checkIfUserExistByUsername($username)) {
                $errors['username'] = '- Username Taken.';
            }
        
        }
        
        //password validation
        if (empty($password)) {
            $errors['password'] = '- Password is required.';
        } else {
            if (strlen($password) < 8) {
                $errors['password'] = '- Password must be atleast 8 characters.';
            }
        }
        
        //repeat password validation
        if (!empty($password) && $repeat_password != $password) {
            $errors['repeat_password'] = '- Password did not match';
        }
        
        if (array_filter($errors)) {
            //has errors
            echo 'error/s: <br>'. implode("<br>", array_filter($errors));
        } else{
            //no errors
            $hashedPassword = $this->hashPassword($password);
            $password = $hashedPassword['hash'] . "::" . $hashedPassword['salt'];
            
            $this->userModel->createUser($email, $username, $password);

            // Redirect to a success page or log in
            echo 'success|'.BASEURL.'login';
        }
    }


    function HasSpecialCharacters($str)
    {
        return preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $str);
    }

    function hashPassword($password)
    {
        // Generate a random salt
        $salt = bin2hex(random_bytes(16));

        // Hash the password with the salt
        $hashedPassword = password_hash($password . $salt, PASSWORD_DEFAULT);

        return array(
            'hash' => $hashedPassword,
            'salt' => $salt
        );
    }

    
}