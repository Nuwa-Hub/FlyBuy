<?php

include '../database/db_connection.php';
require_once('user.php');

class seller extends user{

  // Properties
  public $storeName;

  function __construct($username,$password, $email, $telNo, $address, $storeName, $verified, $vkey) {
    parent::__construct($username,$password, $email, $telNo, $address, $verified, $vkey);
    $this->storeName = $storeName;
  }

  public function saveUser($conn){

    // $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
    $hashed_password = $this->password;
    // $hashed_password = md5($this->password);

    $sql = "INSERT INTO  sellers (username,email,password,telNo,address,storeName,verified,vkey) VALUES ('$this->username','$this->email','$this->password','$this->telNo','$this->address','$this->storeName','$this->verified','$this->vkey')";
    
    $errors = [];

    if ($conn->query($sql) === TRUE) {

        echo "New record created successfully";

        $additionalData  = ['vkey' => $this->vkey, 'table' => 'seller'];
        $email = $_POST['email'];

        sendMail($email, 'signup', $additionalData);
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

?>