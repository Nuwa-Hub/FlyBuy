<?php

class changePswValidator extends ValidateOperator implements IValidator{

    protected $values = [
        'password'   => '',
        'confirmPsw' => ''
    ];

    protected $classNames = [
        'password'   => '',
        'confirmPsw' => ''
    ];

    protected $errors = [
        'password'   => '',
        'confirmPsw' => ''
    ];

    protected $data = [
        'vkeyBuyer'     => '',
        'vkeySeller'    => ''
    ];


    public function __construct($password, $confirmPsw, $vkeyBuyer, $vkeySeller){
        $this->values['password'] = $password;
        $this->values['confirmPsw'] = $confirmPsw;
        $this->data['vkeyBuyer'] = $vkeyBuyer;
        $this->data['vkeySeller'] = $vkeySeller;
    }

    public function validateForm(){
        
        $this->validateNewPassword();

        $this->setClassNames();

        $this->data['classNames'] = $this->classNames;
        $this->data['errors'] = $this->errors;
        $this->data['values'] = $this->values;

        return $this->data;
    }
}

?>