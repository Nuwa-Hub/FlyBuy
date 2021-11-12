<?php

class ProductValidator{

    private $data;
    private $errors;
    private $classNames;
    private $return_data;

    public function __construct($post_data){

        $this->data = $post_data;
        $this->errors = [];
        $this->classNames = [];
        $this->return_data = ['errors' => [], 'classNames' => []];
    }

    public function validateForm($formType){

        if($formType === 'addItem'){

            $this->errors = ['itemName' => 'none', 'amount' => 'none', 'price' => 'none', 'discription' => 'none'];
            $this->classNames = ['itemName' => '', 'amount' => '', 'price' => '', 'discription' => ''];

            $this->validateItemName();
            $this->validateAmount();
            $this->validatePrice();
            $this->validateDiscription();
        }

        $this->setClassNames();

        $this->return_data['errors'] = $this->errors;
        $this->return_data['classNames'] = $this->classNames;

        return $this->return_data;
    }
    
    private function validateItemName(){}

    private function validateAmount(){}

    private function validatePrice(){}

    private function validateDiscription(){}

    private function setError($key, $val){
        $this->errors[$key] = $val;
    }

    private function setClassNames(){

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