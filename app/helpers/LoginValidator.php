<?php

class LoginValidator extends ValidateOperator implements IValidator{


    public function __construct($post_data, $users){

        $this->data = $post_data;
        $this->users = $users;
        $this->errors = [];
        $this->classNames = [];
        $this->return_data = ['errors' => [], 'classNames' => []];
    }

    public function validateForm(){

        $this->errors = ['email' => 'none', 'password' => ''];
        $this->classNames = ['email' => '', 'password' => ''];

        $this->validateLoginEmail();
        

        $this->setClassNames();

        $this->return_data['errors'] = $this->errors;
        $this->return_data['classNames'] = $this->classNames;

        return $this->return_data;
    }
}

?>