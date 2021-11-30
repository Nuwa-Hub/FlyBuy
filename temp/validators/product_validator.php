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

            $this->errors = ['itemName' => '', 'amount' => '', 'price' => '', 'discription' => 'none'];
            $this->classNames = ['itemName' => '', 'amount' => '', 'price' => '', 'discription' => ''];

            $this->validateItemName();
            $this->validateAmount();
            $this->validatePrice();
        }

        $this->setClassNames();

        $this->return_data['errors'] = $this->errors;
        $this->return_data['classNames'] = $this->classNames;

        return $this->return_data;
    }
    
    private function validateItemName(){

        $val = trim($this->data['itemName']);
        $RegEx = '/^[a-z0-9 ,#-\'\/.]$/i';

        if (empty($val)) {
            $this->setError('itemName', 'Item name cannot be empty');
        }
        else if (preg_match($RegEx, $val)) {
            $this->setError('itemName', 'none');
        }
        else {
            $this->setError('itemName', 'Invalid itemName');
        }
    }

    private function validateAmount(){

        $val = $this->data['amount'];

        if (empty($val)) {
            $this->setError('amount', 'Amount cannot be empty');
        }
        else {
            $this->setError('amount', 'none');
        }
    }

    private function validatePrice(){

        $val = $this->data['price'];

        if (empty($val)) {
            $this->setError('price', 'Price cannot be empty');
        }
        else {
            $this->setError('price', 'none');
        }
    }

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