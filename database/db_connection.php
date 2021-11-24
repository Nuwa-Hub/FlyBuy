<?php

  $servername   = "localhost";
  $username     = "root";
  $password     = "";
  $db           = "flybuy";

  // Create connection

<<<<<<< HEAD
  $conn         = mysqli_connect($servername, $username, $password, $db);
=======
     $conn         = mysqli_connect($servername, $username, $password, $db);
>>>>>>> efb1d50f9dfb010bf6aab446cbdd3c7ee00d04dd

  //$conn = mysqli_connect('127.0.0.1:3310', 'Kalana', '0000', 'flybuy');

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // echo "Connected successfully";

?>