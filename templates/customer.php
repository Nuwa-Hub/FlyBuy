<?php
class customer {
  // Properties
  public $username;
  public $password;
  static $cus_id;
  public $email;

   


  function __construct( $username,$password, $email) {
    $this->username = $username;
    $this->password = $password;
    $this->email = $email;
    static ::$cus_id++;
  }

}
?>