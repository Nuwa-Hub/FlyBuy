<?php

require('../modules/sendMail.php');

class UserValidator{

    public $userType;
    private $data;
    private $users;
    private $errors;
    private $return_data;
    private $classNames;
    private static $fields = ['username', 'email', 'password', 'address', 'telNo'];
    private static $Lfields = ['email', 'password'];

    public function __construct($post_data, $users, $userType){

        $this->data = $post_data;
        $this->users = $users;
        $this->userType = $userType;
        $this->errors = [];
        $this->classNames = [];
        $this->return_data = ['errors' => [], 'classNames' => [], 'vkey' => ''];
    }

    public function validateForm($formType){
        
        if ($formType === 'signup') {

            foreach (self::$fields as $field) {
                if (!array_key_exists($field, $this->data)) {
                    trigger_error("'$field' is not present in the data");
                    return;
                }
            }

            if ($this->userType == "seller") {
                $this->errors = ['username' => '', 'email' =>  '', 'telNo' => '', 'address' => '', 'password' =>  '', 'confirmPsw' => '', 'storeName' => ''];
                $this->classNames = ['username' => '', 'email' =>  '', 'telNo' => '', 'address' => '', 'password' =>  '', 'confirmPsw' => '', 'storeName' => ''];
            } else {
                $this->errors = ['username' => '', 'email' => '', 'telNo' => '', 'address' => '', 'password' =>  '', 'confirmPsw' => ''];
                $this->classNames = ['username' => '', 'email' => '', 'telNo' => '', 'address' => '', 'password' =>  '', 'confirmPsw' => ''];
            }

            $this->validateNewUsername();
            $this->validateNewPassword();
            $this->validateNewEmail();
            $this->validateNewTelNo();
            $this->validateAddress();

            if ($this->userType === "seller") {
               $this->validateNewStorename();
            }
        }
        else if ($formType === 'login') {
            
            foreach (self::$Lfields as $field) {
                if (!array_key_exists($field, $this->data)) {
                    trigger_error("'$field' is not present in the data");
                    return;
                }
            }

            $this->errors= ['email' => '', 'password' => ''];
            $this->classNames= ['email' => '', 'password' => ''];

            $this->validateLoginEmail();
        }

        $this->setClassNames();

        $this->return_data['errors'] = $this->errors;
        $this->return_data['classNames'] = $this->classNames;

        return $this->return_data;
    }

    //signup data validation
    private function validateNewTelNo(){

        $val = trim($this->data['telNo']);

        if (empty($val)) {
            $this->setError('telNo', 'telephone number cannot be empty');
        }
        else if (preg_match('/^[0-9]{10}+$/', $val)) {
            $this->setError('telNo', 'none');
        }
        else {
            $this->setError('telNo', 'Invalid Telephone number');
        }
    }


    private function validateAddress(){

        #I require the text field should contains Alphabets in Upper and lower case, numbers, hyphen, fullstops 
        #forward and back slash and commas and spaces in it
        // $regex = '/[A-Za-z0-9\-\\,.]+/';

        // $strStreet = "123 1/2 S. Main St. Apt. 1";
        #$strRegEx = "/^[a-z0-9 ,#-'\/]{3,50}$/i";

        $RegEx = '/^[a-z0-9 ,#-\'\/.]{3,50}$/i';

        $val = trim($this->data['address']);

        if (empty($val)) {
            $this->setError('address', 'Address cannot be empty');
        }
        else if (preg_match($RegEx, $val)) {
            $this->setError('address', 'none');
        }
        else {
            $this->setError('address', 'Invalid Address');
        }
    }

    private function validateNewStorename(){

        $val = trim($this->data['storeName']);

        if (empty($val)) {
            $this->setError('storeName', 'storeName cannot be empty');
        }
        else if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)){
            $this->setError('storeName','storeName must be 6-12 chars & alphanumeric');
        }
        else {
            $this->setError('storeName', 'none');
        }
    }

    private function validateNewUsername(){

        $val = trim($this->data['username']);

        if (empty($val)) {
            $this->setError('username', 'username cannot be empty');
        }
        else if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)){
            $this->setError('username','username must be 6-12 chars & alphanumeric');
        }
        else {
            $this->setError('username', 'none');
        }
    }

    private function validateNewEmail(){
        
        $val = trim($this->data['email']);

        if (empty($val)) {
            $this->setError('email', 'email cannot be empty');
        }
        else {

            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->setError('email', 'email must be a valid');
            }
            else {

                $this->setError('email', 'none');

                foreach ($this->users as $user) {
                    
                    if ($user['email'] === $val) {
                        $this->setError('email', 'email already exists');
                        break;
                    }
                }

               if($this->errors['email'] === 'none'){

                   $vkey = md5(time() . $val);
                   $this->return_data['vkey'] = $vkey;
               }
            }
        }
    }

    private function validateNewPassword(){

        $val = $this->data['password'];
        $confirm_val = $this->data['confirmPsw'];

        if (empty($val)) {
            $this->setError('password', 'password cannot be empty');
        }
        else {

            // $uppercase = preg_match('@[A-Z]@', $val);
            // $lowercase = preg_match('@[a-z]@', $val);
            // $number    = preg_match('@[0-9]@', $val);

            // if(!$uppercase || !$lowercase || !$number || strlen($val) < 6) {
            //     $this->setError('password', 'Password must contain atleast one from a-z, A-Z, 0-9');
            // }

            if(strlen($val) < 6){
                $this->setError('password', 'Password must be atleast 6 characters');
            }
            else if(empty($confirm_val)){
                $this->setError('password', 'none');
                $this->setError('confirmPsw', 'You must confirm the password');
            }
            else if($val !== $confirm_val){
                $this->setError('confirmPsw', 'Password mismatch');
            }
            else{
                $this->setError('confirmPsw', 'none');
            }
        }
    }

    //login data validation
    private function validateLoginEmail(){
        
        $val = trim($this->data['email']);

        if (empty($val)) {

            $this->setError('email', 'email cannot be empty');

            // if(empty($this->data['password'])){
            //     $this->setError('password', 'password cannot be empty');
            // }
            // else{
            //     $this->setError('password', 'account not found');
            // }
        }
        else {

            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->setError('email', 'email must be a valid');
            }
            else {
                $curr_user = NULL;
                foreach ($this->users as $user) {
                    if ($user['email'] === $val) {
                        $this->setError('email', 'none');
                        $curr_user = $user;
                        break;
                    }
                }

                if($curr_user == NULL){
                    $this->setError('email', 'email is not registered');
                    $this->setError('password', 'incorrect password');
                }
                else{
                    
                    if(!$curr_user['verified']){
                        $this->setError('email', 'email is not verified');
                    }
                    else{
                        $this->setError('email', 'none');
                    }
                    // $this->setError('email', 'none');
                    $this->validateLoginPassword($curr_user);
                }
            }
        }
    }

    private function validateLoginPassword($user){
        
        $val = $this->data['password'];
        
        if (empty($val)) {
            $this->setError('password', 'password cannot be empty');
        }
        // else if (password_verify($val, $user['password'])) { //insert de-hashing
        //     $this->setError('password', 'none');
        // }
        else if($val === $user['password']){
            $this->setError('password', 'none');
        }
        // else if(md5($val) == $user['password']){
        //     $this->setError('password', 'none');
        // }
        else{
            $this->setError('password', 'Incorrect password');
        }
    }

    private function setError($key, $val){
        $this->errors[$key] = $val;
    }

    private function setClassNames(){
        foreach ($this->errors as $field => $error) {
            if($error === 'none'){
                $this->classNames[$field] = 'success';
            }
            else if($error != ''){
                $this->classNames[$field] = 'error';
            }
        }
    }
}
