<?php

class UserController extends Controller {

    private $isValid = true;

    public function __construct(){
        
    }

    public function register() {
        

        if(isset($_POST['submitSignup'])){
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $userType = $_POST['userType'];

            if ($userType == 'buyer'){
                $this->userModel = $this->model('Buyer');
            }
            else{
                $this->userModel = $this->model('Seller');
            }

            $emailExists = $this->userModel->checkEmailExistence($_POST['email']);

            $signupValidator = new SignupValidator($_POST, $emailExists, $userType);

            $data = $signupValidator->validateForm();

            foreach ($data['signupErrors'] as $field => $errorValue) {
                if ($errorValue != 'none' and $errorValue != ''){
                    $this->isValid = false;
                    break;
                }
            }

            if ($this->isValid){
                //Register user from model function
                if ($this->userModel->register($data)) {

                    $additionalData  = ['vkey' => $data['vkey'], 'table' => $userType];
                    $email = $_POST['email'];

                    $path_akash = URLROOT . '/PageController/emailVerified';
                    sendMail($email, 'signup', $additionalData, $path_akash);

                    //Redirect to the login page
                    header('location: ' . URLROOT . '/PageController/verifyEmail/' . $userType . '/' . $data['vkey']);
                } else {
                    die('Something went wrong.');
                }
            }
            else{
                $this->view('pages/loginSignup', $data);
            }


        }

    }

    public function login() {
        $loginData = [
            'email'     => '',
            'password'  => ''
        ];

        $loginClassNames = [
            'email'     => '',
            'password'  => ''
        ];

        $loginErrors = [
            'email'     => '',
            'password'  => ''
        ];

        $data = [
            'loginData'         => $loginData,
            'loginClassNames'   => $loginClassNames,
            'loginErrors'       => $loginErrors
        ];

        //Check for post
        if(isset($_POST['submitLogin'])) {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // $data = [
            //     'email' => trim($_POST['email']),
            //     'password' => trim($_POST['password']),
            //     'emailError' => '',
            //     'passwordError' => '',
            // ];

            // $this->db->query("SELECT * FROM buyers");
            // $users = $this->db->resultSet();

            // $userValidator = new UserValidator(new LoginValidator($_POST, $users));
            //protected static methods in a non intantatable class
            // $returnData = $userValidator->validate();
            // //Validate username
            // if (empty($data['username'])) {
            //     $data['usernameError'] = 'Please enter a username.';
            // }

            // //Validate password
            // if (empty($data['password'])) {
            //     $data['passwordError'] = 'Please enter a password.';
            // }

            // //Check if all errors are empty
            // if (empty($data['usernameError']) && empty($data['passwordError'])) {
            //     $loggedInUser = $this->userModel->login($data['username'], $data['password']);

            //     if ($loggedInUser) {
            //         $this->createUserSession($loggedInUser);
            //     } else {
            //         $data['passwordError'] = 'Password or username is incorrect. Please try again.';

            //         $this->view('users/login', $data);
            //     }
            // }

        }

        $this->view('pages/loginSignup', $data);
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;
        header('location:' . URLROOT . '/pages/index');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        header('location:' . URLROOT . '/users/login');
    }
}