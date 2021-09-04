<?php

include 'database/db_connection.php';

if(isset($_GET['vkey'])){
    
    $vkey = $_GET['vkey'];
    $table = $_GET['table'];

    // $sql = "SELECT * FROM $table WHERE verified = 0 AND vkey = $vkey LIMIT 1";
    // $resultSet = mysqli_query($conn, $sql);
    // print_r($resultSet);

    $resultSet = $conn->query("SELECT * FROM $table WHERE verified = 0 AND vkey = $vkey LIMIT 1");

    if($resultSet){

        $update = $conn->query("UPDATE $table SET verified = 1 WHERE vkey = '$vkey' LIMIT 1");
        
        if($update){
            echo 'verification success..';
        }
        else{
            echo $conn->error;
        }
    }
    else{
        echo "This account is already verified";
    }
    // mysqli_free_result($resultSet);
}
else{
    die('verification error');
}

?>



<!DOCTYPE html>
<html>
    <head>
        <title>Email Verified</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/styles_verifyEmail.css" />
    </head>

    <body>
        <div class="container">
            <!-- <img class="mail-icon" src=""> -->
            <h2>Verification Successful!</h2>
            <a class="loginLink" href="./loginSignup.php">Login To Your Account</a>
        </div>
    </body>
</html>