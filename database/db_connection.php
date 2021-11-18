<?php

  $servername   = "localhost";
  $username     = "root";
  $password     = "";
  $db           = "flybuy";

  // Create connection
<<<<<<< HEAD
   $conn         = mysqli_connect($servername, $username, $password, $db);
  //$conn = mysqli_connect('127.0.0.1:3310', 'Kalana', '0000', 'flybuy');
=======
  $conn         = mysqli_connect($servername, $username, $password, $db);
  // $conn = mysqli_connect('127.0.0.1:3310', 'Kalana', '0000', 'flybuy');
>>>>>>> 44ab5016a491c806f07004ded56c2704a7caa24d

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // echo "Connected successfully";

?>