<?php

include '../database/db_connection.php';
require_once('user.php');

class buyer extends user{

  function __construct($username,$password, $email, $telNo, $address, $verified, $vkey) {
    parent::__construct($username,$password, $email, $telNo, $address, $verified, $vkey);
    return true;
  }

  public function saveUser($conn){

    // $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
    $hashed_password = $this->password;
    // $hashed_password = md5($this->password);

    $sql = "INSERT INTO  buyers  (username,email,password,telNo,address,verified,vkey) VALUES ('$this->username','$this->email','$hashed_password','$this->telNo','$this->address','$this->verified','$this->vkey')";
    
    $errors = [];

    if ($conn->query($sql) === TRUE) {

        echo "New record created successfully";

        $additionalData  = ['vkey' => $this->vkey, 'table' => 'buyer'];
        $email = $_POST['email'];

        sendMail($email, 'signup', $additionalData);
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

?>