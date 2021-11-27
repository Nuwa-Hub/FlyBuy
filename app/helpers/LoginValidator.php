<?php

require_once 'ValidateOperator.php';

class LoginValidator extends ValidateOperator implements IValidator{

    protected $values = [
        'email'      => '',
        'password'   => ''
    ];

    protected $classNames = [
        'email'      => '',
        'password'   => ''
    ];

    protected $errors = [
        'email'      => '',
        'password'   => ''
    ];


    public function __construct($post_data, $users, $userType = null){

        $this->values['email'] = $post_data['email'];
        $this->values['password'] = $post_data['password'];

        // if ($this->userType == "seller") {
        //     $this->values['storeName'] = $post_data['storeName'];
        // }

        $this->users = $users;
        // $this->userType = $userType;
    }

    public function validateForm(){

        $this->validateLoginEmail();

        $this->setClassNames();

        $this->data['loginClassNames'] = $this->classNames;
        $this->data['loginErrors'] = $this->errors;
        $this->data['loginData'] = $this->values;

        // vkey is set in validateNewEmail() method

        return $this->data;
    }
}

?>