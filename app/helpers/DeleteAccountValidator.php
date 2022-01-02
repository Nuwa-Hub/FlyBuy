<?php

class DeleteAccountValidator extends ValidateOperator implements IValidator{

    protected $values = [
        'password'   => ''
    ];

    protected $classNames = [
        'password'   => ''
    ];

    protected $errors = [
        'password'   => ''
    ];


    public function __construct($post_data, $users = null, $userType = null){
        
        $this->values['password'] = $post_data['password'];
        $this->user = $users;
    }

    public function validateForm($userType=null){

        $this->validateLoginPassword($this->user);

        $this->setClassNames();

        $this->data['deleteAccountClassNames'] = $this->classNames;
        $this->data['deleteAccountErrors'] = $this->errors;

        return $this->data;
    }
}

?>