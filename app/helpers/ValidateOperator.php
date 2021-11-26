<?php

class ValidateOperator{

    protected $values;
    protected $users;
    protected $errors;
    protected $classNames;
    protected $data;
    protected $userType;

    private function __construct(){}

    //signup and edit profile data validation

    protected function validateNewUsername(){

        $val = trim($this->values['username']);

        if (empty($val)) {
            $this->setError('username', 'username cannot be empty');
        }
        else if (!preg_match('/^[a-zA-Z0-9 ]{6,30}$/', $val)) {
            $this->setError('username', 'username must be 6-30 chars & alphanumeric');
        }
        else {
            $this->setError('username', 'none');
        }
    }

    protected function validateNewEmail(){

        $val = trim($this->values['email']);

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

                    if ($user->email === $val) {
                        $this->setError('email', 'email already exists');
                        break;
                    }
                }

                if ($this->errors['email'] === 'none') {
                    $vkey = md5(time() . $val);
                    $this->data['vkey'] = $vkey;
                }
            }
        }
    }

    protected function validateNewTelNo(){

        $val = trim($this->values['telNo']);

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

    protected function validateAddress(){

        #I require the text field should contains Alphabets in Upper and lower case, numbers, hyphen, fullstops 
        #forward and back slash and commas and spaces in it

        $RegEx = '/^[a-z0-9 ,#-\'\/.]{3,100}$/i';

        $val = trim($this->values['address']);

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

    protected function validateNewStorename(){
        
        $val = trim($this->values['storeName']);
        
        if (empty($val)) {
            $this->setError('storeName', 'storeName cannot be empty');
        }
        else if (!preg_match('/^[a-zA-Z0-9 ]{6,30}$/', $val)) {
            $this->setError('storeName', 'storeName must be of 6-30 chars & alphanumeric');
        }
        else {
            $this->setError('storeName', 'none');
        }
    }

    protected function validateNewPassword(){

        $val = $this->values['password'];
        $confirm_val = $this->values['confirmPsw'];

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

            $this->setError('password', 'none');
            
            if (strlen($val) < 6) {
                $this->setError('password', 'Password must be atleast 6 characters');
            }
            else if (empty($confirm_val)) {
                $this->setError('password', 'none');
                $this->setError('confirmPsw', 'You must confirm the password');
            }
            else if ($val != $confirm_val) {
                $this->setError('confirmPsw', 'Password mismatch');
            }
            else {
                $this->setError('confirmPsw', 'none');
            }
        }
    }


    //login data validation

    protected function validateLoginEmail(){

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

                if ($curr_user == NULL) {
                    $this->setError('email', 'email is not registered');
                    // $this->setError('password', 'incorrect password');
                }
                else {

                    if (!$curr_user['verified']) {
                        $this->setError('email', 'email is not verified');
                    }
                    else {
                        $this->setError('email', 'none');
                    }
                    // $this->setError('email', 'none');
                    $this->validateLoginPassword($curr_user);
                }
            }
        }
    }

    protected function validateLoginPassword($user){

        $val = $this->data['password'];

        if (empty($val)) {
            $this->setError('password', 'password cannot be empty');
        }
        else if (password_verify($val, $user['password'])) { //insert de-hashing
          $this->setError('password', 'none');
        }
        else {
            $this->setError('password', 'Incorrect password');
        }
    }



    protected function setError($key, $val){
        $this->errors[$key] = $val;
    }

    protected function setClassNames(){

        foreach ($this->errors as $field => $error) {
            
            if ($error === 'none') {
                $this->classNames[$field] = 'success';
            }
            else if($error != ''){
                $this->classNames[$field] = 'error';
            }
        }
    }
}

?>