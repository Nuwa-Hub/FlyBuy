<?php

class EditProfileValidator extends ValidateOperator implements IValidator{

    protected $values = [
        'username'   => '',
        'telNo'      => '',
        'address'    => '',
        'password'   => '',
        'confirmPsw' => '',
        'storeName'  => ''
    ];

    protected $classNames = [
        'username'   => '',
        'telNo'      => '',
        'address'    => '',
        'password'   => '',
        'confirmPsw' => '',
        'storeName'  => ''
    ];

    protected $errors = [
        'username'   => '',
        'telNo'      => '',
        'address'    => '',
        'password'   => '',
        'confirmPsw' => '',
        'storeName'  => ''
    ];


    public function __construct($post_data, $userType){

        $this->values['username'] = $post_data['username'];
        $this->values['telNo'] = $post_data['telNo'];
        $this->values['address'] = $post_data['address'];
        $this->values['password'] = $post_data['password'];
        $this->values['confirmPsw'] = $post_data['confirmPsw'];

        if ($userType == "seller") {
            $this->values['storeName'] = $post_data['storeName'];
        }

        // $this->userType = $userType;
    }

    public function validateForm($userType=null){

        $fields = array_keys($this->values);
        
        foreach($fields as $field){
            
            if(!empty($this->values[$field])){

                if($field === 'username'){
                    $this->validateNewUsername();
                }
                else if($field === 'storeName'){
                    $this->validateNewStorename();
                }
                else if($field === 'telNo'){
                    $this->validateNewTelNo();
                }
                else if($field === 'address'){
                    $this->validateAddress();
                }
                else if($field === 'password'){
                    $this->validateNewPassword();
                }
            }
        }
        
        $this->setClassNames();

        $this->data['editProfileClassNames'] = $this->classNames;
        $this->data['editProfileErrors'] = $this->errors;
        $this->data['editProfileData'] = $this->values;

        // vkey is set in validateNewEmail() method

        return $this->data;
    }
}

?>