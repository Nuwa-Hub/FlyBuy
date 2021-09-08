<?php

include '../models/buyer.php';
include '../models/seller.php';
include '../database/db_connection.php';

require('../validators/user_validator.php');

$errors = [];

$username = '';
$email = '';
$password = '';
$confirmPsw = '';
$telNo = '';
$address = '';
$storeName = '';

function checknone($arr){

    foreach ($arr as $ele) {
        if ($ele != 'none') {
            return false;
        }
    }
    return true;
}

if (isset($_POST['submitSignup'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPsw = mysqli_real_escape_string($conn, $_POST['confirmPsw']);
    $telNo = mysqli_real_escape_string($conn, $_POST['telNo']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    //fetch the resulting rows as an array
    if($_POST['userType'] === "buyer"){
        $users = mysqli_fetch_all( mysqli_query($conn, "SELECT * FROM  buyers"), MYSQLI_ASSOC);
    }
    else{

        $storeName = mysqli_real_escape_string($conn, $_POST['storeName']);//store name is specific to sellers

        $users = mysqli_fetch_all( mysqli_query($conn, "SELECT * FROM  sellers"), MYSQLI_ASSOC);
    }

    // validate entries
    $validation = new UserValidator($_POST, $users, $_POST['userType'] );
    $return_data = $validation->validateForm('signup');

    $errors = $return_data['errors'];
    $classNames = $return_data['classNames'];
    $vkey = $return_data['vkey'];

    array_filter($errors);

    if (checknone($errors)) {

        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $hashed_password = $password;
        // $hashed_password = md5($password);

        if  ($_POST['userType'] === "buyer") {
            $sql = "INSERT INTO  buyers  (username,email,password,telNo,address,verified,vkey) VALUES ('$username','$email','$hashed_password','$telNo','$address','false','$vkey')";
        }
        else{
            $sql = "INSERT INTO  sellers (username,email,password,telNo,address,storeName,verified,vkey) VALUES ('$username','$email','$hashed_password','$telNo','$address','$storeName','false','$vkey')";
        }

        $errors = [];

        if ($conn->query($sql) === TRUE) {

            echo "New record created successfully";

            $additionalData  = ['vkey' => $vkey, 'table' =>  $_POST['userType']];
            $email = $_POST['email'];

            sendMail($email, 'signup', $additionalData);
            header('location:verifyEmail.php');
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else {
        print_r(array_values($errors));
    }
}

if (isset($_POST['userLog'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //fetch the resulting rows as an array
    if($_POST['userLog'] === 'buyer'){
        $users = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM buyers"), MYSQLI_ASSOC);
    }
    else{
        $users = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM sellers"), MYSQLI_ASSOC);
    }
    
    // validate entries
    $validation = new UserValidator($_POST, $users,$_POST['userLog']);
    $return_data = $validation->validateForm('login');

    $errors = $return_data['errors'];
    $classNames = $return_data['classNames'];

    // array_filter($data);

    if (checknone($errors)) {
        echo "c";
        header('Location: homepage.php');
    }
    else {
        print_r(array_values($errors));
        print_r(array_values($classNames));
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/styles_signinLogin.css">

    <title>SignIn and SignUp</title>
</head>

<body>

    <main>

        <div class="column">

            <div class="container">

                <div class="forms-container">

                    <div class="signin-signup sign-in">

                        <form class="sign-in-form" method="post" action="loginSignup.php">

                            <h2 class="title">Sign in</h2>

                            <div class="input-field">
                                <i class="fas fa-envelope"></i>
                                <input name="email" type="text" placeholder="Email" class="email" value="<?php echo htmlspecialchars($email);?>">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <span class="tooltip-text"><?php echo $errors['email']; ?></span>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input name="password" type="password" placeholder="Password" class="psw" value="<?php echo htmlspecialchars($password);?>">
                                <a href="forgotPsw.php"><small class="forgotPsw">forgotten password?</small></a>
                                <i class="fas fa-eye togglePassword"></i>
                                <i class="fas fa-exclamation-circle tooltip">
                                    <span class="tooltip-text"><?php echo $errors['password']; ?></span>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <button class="btn solid login buyer" name="userLog" value="buyer">
                                <span class="buttonText">Login as a cutomer</span>
                            </button>

                            <button class="btn solid login seller" name="userLog" value="seller">
                                <span class="buttonText">Login as a seller</span>
                            </button>

                        </form>

                    </div>

                    <div class="signin-signup sign-up">

                        <form class="sign-up-form" method="post" action="loginSignup.php">

                            <h2 class="title">Sign up</h2>

                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <input name="username" type="text" placeholder="Username" class="username" value="<?php echo htmlspecialchars($username)?>">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $errors['username']; ?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field">
                                <i class="fas fa-envelope"></i>
                                <input name="email" type="email" placeholder="Email" class="email" value="<?php echo htmlspecialchars($email)?>">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $errors['email']; ?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field">
                                <i class="fas fa-mobile-alt"></i>
                                <input name="telNo" type="tel" placeholder="Phone Number" class="phone" value="<?php echo htmlspecialchars($telNo)?>">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $errors['telNo']; ?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field">
                                <i class="fas fa-map-marked-alt"></i>
                                <input name="address" type="text" placeholder="Address Ex:- No.20,city,county" class="address" value="<?php echo htmlspecialchars($address)?>">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $errors['address']; ?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input name="password" type="password" placeholder="Password" class="psw" value="<?php echo htmlspecialchars($password)?>">
                                <i class="fas fa-eye togglePassword"></i>
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $errors['password']; ?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input name="confirmPsw" type="password" placeholder="Confirm Password" class="confirm-psw" value="<?php echo htmlspecialchars($confirmPsw)?>">
                                <i class="fas fa-eye togglePassword"></i>
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $errors['confirmPsw']; ?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field store remove">
                                <i class="fas fa-store"></i>
                                <input name="storeName" type="text" placeholder="Store Name" class="store" value="<?php echo htmlspecialchars($storeName)?>">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $errors['storeName']; ?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field radio">
                                <input type="radio" class="radioBtn buyer" name="userType" value="buyer" onchange="removeField()" checked>
                                <label for="radio">Buyer</label>
                                <input type="radio" class="radioBtn seller" name="userType" value="seller" onchange="addField()">
                                <label for="radio">Seller</label>
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text">Error Message</small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <button class="btn solid signup" name="submitSignup">
                                <span class="buttonText">Sign Up</span>
                            </button>

                        </form>

                    </div>

                </div>

                <div class="panels-container">

                    <div class="panel left-panel">
                        <div class="content">
                            <h3>One of Us?</h3>
                            <p>
                                Sign in to your account from here
                            </p>
                            <button class="btn transparent" id="sign-in-button">
                                <span class="buttonText">Sign in</span>
                            </button>
                            <img src="../resources/user.png" alt="user">
                        </div>
                    </div>

                    <div class="panel right-panel">
                        <div class="content">
                            <img src="../resources/user.png" alt="user">
                            <h3>New Here?</h3>
                            <p>
                                Join us and enjoy the services
                            </p>
                            <button class="btn transparent" id="sign-up-button">
                                <span class="buttonText">Sign up</span>
                            </button>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </main>

    <script src="../javaScript/form.js"></script>

</body>

</html>