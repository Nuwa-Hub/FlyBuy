<?php
class seller {
  // Properties
  public $username;
  public $password;
  static $sel_id;
  public $email;

   


  function __construct( $username,$password, $email) {
    $this->username = $username;
    $this->password = $password;
    $this->email = $email;
    static ::$sel_id++;

  }

}
?>