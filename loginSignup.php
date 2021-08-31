<?php 
include 'templates/customer.php';
include 'templates/seller.php';
include 'database/db_connection.php';





// define variables and set to empty values
$passwordErr = $emailErr =$usernameErr=$confirmPswErr=  "";
$password = $email =$username=$confirmPsw=$userType= "";

if (isset($_POST["submitLogin"])) {
  if (empty($_POST["password"])) {
    $passwordErr = "password is required";
  } else {
    $password = ($_POST["password"]);
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = ($_POST["email"]);
  }
  echo $email;
  echo $password;
 
}

if(isset($_POST["submitSign"])){
    if (empty($_POST["password"])) {
        $passwordErr = "password is required";
      } else {
        $password = ($_POST["password"]);
      }
    
      if (empty($_POST["email"])) {
        $emailErr = "Email is required";
      } else {
        $email = ($_POST["email"]);
      }
      if (empty($_POST["username"])) {
        $usernameErr = "username is required";
      } else {
        $username = ($_POST["username"]);
      }
      if (empty($_POST["confirmPsw"])) {
        $confirmPswErr = "confirm password is required";
      } else {
        $confirmPsw = ($_POST["confirmPsw"]);
      }
      if  ($_POST["userType"]=="seller"){
          $seller=new seller($username,$password,$email);
          $Seller=serialize($seller);
          
      $sql = "INSERT INTO sellers (seller_obj) VALUES ('$Seller')";

      if ($conn->query($sql) === TRUE) {
             echo "New record created successfully";
     } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
      }
          
      }
      else{
          
          $customer=new customer($username,$password,$email);
          $Customer=serialize($customer);
          echo customer::$cus_id;
          echo $customer1->username;
        

      $sql = "INSERT INTO customers (customer_obj) VALUES ('$Customer')";

      if ($conn->query($sql) === TRUE) {
             echo "New record created successfully";
     } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

$conn->close();
    //   echo $email;
    //   echo $password;
    //   echo $confirmPsw;
    //   echo $username;
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link 
        rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" 
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" 
        crossorigin="anonymous" 
    />
    
    <title>SignIn and SignUp</title>
</head>
<body>

    <main>
        
        <div class="column-left">

            <div class="container">

                <div class="forms-container">
        
                    <div class="signin-signup sign-in">

                        <form class="sign-in-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                            <h2 class="title">Sign in</h2>

                            <div class="input-field">
                                <i class="fas fa-envelope"></i>
                                <input name="email" type="text" placeholder="Email" class="email">
                                <i class="fas fa-exclamation-circle tooltip">
                                <span class="error"><?php echo $emailErr;?></span>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input name="password" type="password" placeholder="Password" class="psw">
                                <a href="#"><small class="forgotPsw">forgotten password?</small></a>
                                <i class="fas fa-eye togglePassword"></i>
                                <i class="fas fa-exclamation-circle tooltip">
                                <span class="error"><?php echo $passwordErr;?></span>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>
                          
                             <button class="btn solid login" name="submitLogin">
                                <span class="buttonText">Login</span>
                            </button> 
                            
                        </form>

                    </div>
        
                    <div class="signin-signup sign-up">

                        <form class="sign-up-form"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                            <h2 class="title">Sign up</h2>

                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <input name="username" type="text" placeholder="Username" class="username">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $usernameErr;?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field">
                                <i class="fas fa-envelope"></i>
                                <input name="email" type="email" placeholder="Email" class="email">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $emailErr;?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input name="password" type="password" placeholder="Password" class="psw">
                                <i class="fas fa-eye togglePassword"></i>
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $passwordErr;?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input name="confirmPsw" type="password" placeholder="Confirm Password" class="confirm-psw">
                                <i class="fas fa-eye togglePassword"></i>
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $confirmPswErr;?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field">
                                <input type="radio" class="radio" name="userType" value="buyer" checked>
                                <label for="radio">Buyer</label>
                                <input type="radio" class="radio" name="userType" value="seller">
                                <label for="radio">Seller</label>
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text">Error Message</small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <button class="btn solid signup" name="submitSign">
                                <span class="buttonText">Sign Up</span>
                            </button>

                        </form>

                    </div>
        
                </div>
        
                <div class="panels-container">
        
                    <div class="panel upper-panel">
                        <div class="content">
                            <h3>One of Us?</h3>
                            <p>
                                Sign in to your account from here
                            </p>
                            <button class="btn transparent" id="sign-in-button">
                                <span class="buttonText">Sign in</span>
                            </button>
                        </div>
                    </div>
        
                    <div class="panel lower-panel">
                        <div class="content">
                            <h3>New Here?</h3>
                            <p>
                                Join us and enjoy the services
                            </p>
                            <button class="btn transparent" id="sign-up-button" name="submitign">
                                <span class="buttonText">Sign up</span>
                            </button>
                        </div>
                    </div>
        
                </div>
        
            </div>

        </div>

    </main>
    
</body>
</html>