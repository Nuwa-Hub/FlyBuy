<?php

include '../database/db_connection.php';
require_once('user.php');

class buyer extends user{

  function __construct($username,$password, $email, $telNo, $address, $verified, $vkey) {
    parent::__construct($username,$password, $email, $telNo, $address, $verified, $vkey);
    return true;
  }

  public function saveUser(){
    $sql = "INSERT INTO  buyers  (username,email,password,telNo,address,verified,vkey) VALUES ('$this->username','$this->email','$this->password','$this->telNo','$this->address','$this->verified','$this->vkey')";
    return $sql;
  }

  public function getAllUsers($conn){
    return mysqli_fetch_all( mysqli_query($conn, "SELECT * FROM  buyers"), MYSQLI_ASSOC);
  }

}

?>