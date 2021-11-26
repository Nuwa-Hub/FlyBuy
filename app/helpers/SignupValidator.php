<?php

require_once 'ValidateOperator.php';

class SignupValidator extends ValidateOperator implements IValidator{

    protected $values = [
        'username'   => '',
        'email'      => '',
        'telNo'      => '',
        'address'    => '',
        'password'   => '',
        'confirmPsw' => '',
        'storeName'  => ''
    ];

    protected $classNames = [
        'username'   => '',
        'email'      => '',
        'telNo'      => '',
        'address'    => '',
        'password'   => '',
        'confirmPsw' => '',
        'storeName'  => ''
    ];

    protected $errors = [
        'username'   => '',
        'email'      => '',
        'telNo'      => '',
        'address'    => '',
        'password'   => '',
        'confirmPsw' => '',
        'storeName'  => 'none'
    ];


    public function __construct($post_data, $users, $userType){

        $this->values['username'] = $post_data['username'];
        $this->values['email'] = $post_data['email'];
        $this->values['telNo'] = $post_data['telNo'];
        $this->values['address'] = $post_data['address'];
        $this->values['password'] = $post_data['password'];
        $this->values['confirmPsw'] = $post_data['confirmPsw'];

        if ($this->userType == "seller") {
            $this->values['storeName'] = $post_data['storeName'];
        }

        $this->users = $users;
        $this->userType = $userType;
    }

    public function validateForm(){

        $this->validateNewUsername();
        $this->validateNewPassword();
        $this->validateNewEmail();
        $this->validateNewTelNo();
        $this->validateAddress();

        if ($this->userType === "seller") {
            $this->validateNewStorename();
        }

        $this->setClassNames();

        $this->data['signupClassNames'] = $this->classNames;
        $this->data['signupErrors'] = $this->errors;
        $this->data['signupData'] = $this->values;

        return $this->data;
    }
}

?>