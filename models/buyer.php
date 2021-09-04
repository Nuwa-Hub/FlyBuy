<?php
class buyer {
  // Properties
  public $username;
  public $password;
  public static $cus_id=12;
  public $email;

  function __construct( $username,$password, $email) {
    $this->username = $username;
    $this->password = $password;
    $this->email = $email;
    static ::$cus_id++;
    return true;
  }

}
?>