<?php 

abstract class User {

    // Properties
    private $id;
    private $username;
    private $email;
    private $password;
    private $telNo;
    private $address;
    private $verified;
    private $vkey;

    public function __construct($username,$password, $email, $telNo, $address, $verified, $vkey) {

        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->telNo = $telNo;
        $this->address = $address;
        $this->verified = $verified;
        $this->vkey = $vkey;
        
        return true;
    }

    public function setVerified($verified){
        $this->verified = $verified;
    }

    public abstract function saveUser();

    public abstract function getAllUsers($conn);
}

?>