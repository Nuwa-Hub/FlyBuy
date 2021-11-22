<?php

class SignupValidator extends LoginValidator implements IValidator{

    public $userType;
    private $data;
    private $users;
    private $errors;
    private $return_data;
    private $classNames;


    public function __construct($post_data, $users, $userType){

        $this->data = $post_data;
        $this->users = $users;
        $this->userType = $userType;
        $this->errors = [];
        $this->classNames = [];
        $this->return_data = ['errors' => [], 'classNames' => [], 'vkey' => ''];
    }

    public function validateForm(){

        $this->errors = ['username' => '', 'email' => '', 'telNo' => '', 'address' => '', 'password' =>  '', 'confirmPsw' => ''];
        $this->classNames = ['username' => '', 'email' => '', 'telNo' => '', 'address' => '', 'password' =>  '', 'confirmPsw' => ''];

        if ($this->userType == "seller") {
            $this->errors += ['storeName' => ''];
            $this->classNames += ['storeName' => ''];
        }

        $this->validateNewUsername();
        $this->validateNewPassword();
        $this->validateNewEmail();
        $this->validateNewTelNo();
        $this->validateAddress();

        if ($this->userType === "seller") {
            $this->validateNewStorename();
        }

        $this->setClassNames();

        $this->return_data['errors'] = $this->errors;
        $this->return_data['classNames'] = $this->classNames;

        unset($this->return_data['vkey']);

        return $this->return_data;
    }
}

?>