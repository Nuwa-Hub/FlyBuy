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

  public function saveUser(){
    $sql = "INSERT INTO  sellers (username,email,password,telNo,address,storeName,verified,vkey) VALUES ('$this->username','$this->email','$this->password','$this->telNo','$this->address','$this->storeName','$this->verified','$this->vkey')";
    return $sql;
  }

  public function getAllUsers($conn){
    return mysqli_fetch_all( mysqli_query($conn, "SELECT * FROM  sellers"), MYSQLI_ASSOC);
  }
  
}

?>