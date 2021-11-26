<?php
class UserController extends Controller {

    public function __construct(){

    }

    public function register() {
        $signupData = [
            'username'              => '',
            'email'                 => '',
            'password'              => '',
            'confirmPassword'       => '',
            'usernameError'         => '',
            'emailError'            => '',
            'passwordError'         => '',
            'confirmPasswordError'  => '',
            'storeName'             => ''
        ];

        $signupClassNames = [
            'username'              => '',
            'email'                 => '',
            'password'              => '',
            'confirmPassword'       => '',
            'usernameError'         => '',
            'emailError'            => '',
            'passwordError'         => '',
            'confirmPasswordError'  => '',
            'storeName'             => ''
        ];

        $signupErrors = [
            'username'              => '',
            'email'                 => '',
            'password'              => '',
            'confirmPassword'       => '',
            'usernameError'         => '',
            'emailError'            => '',
            'passwordError'         => '',
            'confirmPasswordError'  => '',
            'storeName'             => ''
        ];

        $data = [
            'signupData'        => $signupData,
            'signupClassNames'  => $signupClassNames,
            'signupErrors'      => $signupErrors
        ];

      if(isset($_POST['submitLoginBuyer'])){
          print("here");
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

              $data = [
                'username'              => trim($_POST['username']),
                'email'                 => trim($_POST['email']),
                'password'              => trim($_POST['password']),
                'confirmPassword'       => trim($_POST['confirmPassword']),
                'usernameError'         => '',
                'emailError'            => '',
                'passwordError'         => '',
                'confirmPasswordError'  => ''
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            //Validate username on letters/numbers
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username.';
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Name can only contain letters and numbers.';
            }

            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email address.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Please enter the correct format.';
            } else {
                //Check if email exists.
                if ($this->userModel->findUserByEmail($data['email'])) {
                $data['emailError'] = 'Email is already taken.';
                }
            }

           // Validate password on length, numeric values,
            if(empty($data['password'])){
              $data['passwordError'] = 'Please enter password.';
            } elseif(strlen($data['password']) < 6){
              $data['passwordError'] = 'Password must be at least 8 characters';
            } elseif (preg_match($passwordValidation, $data['password'])) {
              $data['passwordError'] = 'Password must be have at least one numeric value.';
            }

            //Validate confirm password
             if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
                }
            }

            // Make sure that errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register user from model function
                if ($this->userModel->register($data)) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die('Something went wrong.');
                }
            }
        }
        $this->view('pages/loginSignup');
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