<?php
include "models\user.php";

class UserValidator
{
    public $userType;
    private $data;
    private $users;
    private $errors;
    private static $fields = ['username', 'email', 'password', 'address', 'telNo'];
    private static $Lfields = ['email', 'password'];
    private $lerrors= ['email' => '', 'password' => ''];


    public function __construct($post_data, $users, $userType)
    {
        if ($userType == "seller") {
            $this->errors = ['username' => '', 'email' =>  '', 'password' =>  '', 'telNo' => '', 'address' => '', 'storeName' =>''];
        } else {
            $this->errors = ['username' => '', 'email' => '', 'password' => '', 'telNo' => '', 'address' => ''];
        }
        $this->data = $post_data;
        $this->users = $users;
        $this->userType = $userType;
    }

    public function validateForm($formType)
    {
        if ($formType == 'signup') {
            foreach (self::$fields as $field) {
                if (!array_key_exists($field, $this->data)) {
                    trigger_error("'$field' is not present in the data");
                    return;
                }
            }

            if ($this->userType == "seller") {
                 $this->validateNewStorename();
            }
            $this->validateNewUsername();
            $this->validateNewPassword();
            $this->validateNewEmail();
            $this->validateNewTelNo();
            $this->validateAddress();
            return $this->errors;
        } else if ($formType == 'login') {

            foreach (self::$Lfields as $field) {
                if (!array_key_exists($field, $this->data)) {
                    trigger_error("'$field' is not present in the data");
                    return;
                }
            }


            $this->validateLoginEmail();
            return $this->lerrors;
        }

        
    }
    private function validateNewTelNo()
    {
        $val = trim($this->data['telNo']);


        if (empty($val)) {
            $this->setError('username', 'username cannot be empty');
        } elseif (preg_match('/^[0-9]{10}+$/', $val)) {
            $this->setError('telNo', 'none');
        } else {

            $this->setError('telNo', 'Invalid Telephone number');
        }
    }


    private function validateAddress()
    {
        #I require the text field should contains Alphabets in Upper and lower case, numbers, hyphen, fullstops 
        #forward and back slash and commas and spaces in it
        // $regex = '/[A-Za-z0-9\-\\,.]+/';

        // $strStreet = "123 1/2 S. Main St. Apt. 1";
        #$strRegEx = "/^[a-z0-9 ,#-'\/]{3,50}$/i";
        $RegEx = '/^[a-z0-9 ,#-\'\/.]{3,50}$/i';



        $val = trim($this->data['address']);

        if (empty($val)) {
            $this->setError('address', 'Address cannot be empty');
        } else if (preg_match($RegEx, $val)) {
            $this->setError('address', 'none');
        } else {

            $this->setError('address', 'Invalid Address');
        }
    }

    private function validateNewStorename()
    {

        $val = trim($this->data['storeName']);

        if (empty($val)) {
            $this->setError('storeName', 'storeName cannot be empty');
        } else if (!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)) {
            $this->setError('storeName', 'storeName must be 6-12 chars & alphanumeric');
        } else {
            $this->setError('storeName', 'none');
        }
    }

    private function validateNewUsername()
    {

        $val = trim($this->data['username']);

        if (empty($val)) {
            $this->setError('username', 'username cannot be empty');
        } else if (!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)) {
            $this->setError('username', 'username must be 6-12 chars & alphanumeric');
        } else {
            $this->setError('username', 'none');
        }
    }

    private function validateNewEmail()
    {

        $val = trim($this->data['email']);

        if (empty($val)) {
            $this->setError('email', 'email cannot be empty');
        } else {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->setError('email', 'email must be a valid');
            } else {
                foreach ($this->users as $user) {

                    //  if($user['email'] == $val && $user['verified'] == TRUE){
                    if ($user['email'] == $val) {
                        $this->setError('email', 'email already exists');
                    } else {
                        $this->setError('email', 'none');
                    }
                }
            }
        }
    }

    private function validateNewPassword()
    { //insert hashing

        $val = $this->data['password'];
        $confirm_val = $this->data['confirmPsw'];

        if (empty($val)) {
            $this->setError('password', 'password cannot be empty');
        } else {

            $uppercase = preg_match('@[A-Z]@', $val);
            $lowercase = preg_match('@[a-z]@', $val);
            $number    = preg_match('@[0-9]@', $val);

            if (!$uppercase || !$lowercase || !$number || strlen($val) < 6) {
            }
            if (strlen($val) < 6) {
                $this->setError('password', 'Password must be atleast 6 characters');
            } else if (empty($confirm_val)) {
                $this->setError('password', 'You must confirm the password');
            } else if ($val != $confirm_val) {
                $this->setError('password', 'Password mismatch');
            } else {
                $this->setError('password', 'none');
                //   }
            }
        }
    }
    private function validateLoginEmail()
    {

        $val = trim($this->data['email']);

        if (empty($val)) {
            $this->lsetError('email', 'email cannot be empty');
        } else {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->lsetError('email', 'email must be a valid');
            } else {


                foreach ($this->users as $user) {

                    if ($user['email'] == $val) {
                        $curr_user = $user;
                        //     if($curr_user['verified'] == FALSE){
                        if (0) {
                            $this->setError('email', 'email is not verified');
                        } else {
                           // $this->lsetError('email', 'none');
                        }
                        $check = $this->validateLoginPassword($curr_user);
                        
                        if ($check == true) {
                            $this->lsetError('email', 'none');
                            break;
                        }
                    } else {
                        $this->lsetError('email', 'email is not registered');
                        //  $this->setError('password', 'incorrect password');
                    }
                }
            }
        }
    }

    private function validateLoginPassword($user)
    {

        $val = $this->data['password'];
        //  echo $val."  ";
        //  echo $user['password'];
        if (empty($val)) {
            $this->lsetError('password', 'password cannot be empty');
            return false;
        } else if ($val == $user['password']) { //insert de-hashing
            $this->lsetError('password', 'none');
            return true;
        } else {
            
            return false;
        }
    }



    private function setError($key, $val)
    {
        $this->errors[$key] = $val;
    
    }
    private function lsetError($key, $val)
    {
        $this->lerrors[$key] = $val;
    
    }
}
