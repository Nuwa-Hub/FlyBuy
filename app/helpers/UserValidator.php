<?php

class UserValidator{

    private $validator;

    public function __construct($validator){
        $this->validator = $validator;
    }

    public function setValidator($validator){
        $this->validator = $validator;
    }

    public function validate(){
        return $this->validator->validateForm();
    }
}

?>