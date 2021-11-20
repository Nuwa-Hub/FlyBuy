<?php

include '../models/buyer.php';
include '../models/seller.php';
include '../database/db_connection.php';

require('../validators/user_validator.php');

// relevent paths for admins :)
$path_akash     = 'http://127.0.0.1/Project/FlyBuy/view/emailVerified.php';
$path_kalana    = 'http://127.0.0.1/FlyBuy/view/emailVerified.php';
$path_Ransika   = 'http://127.0.0.1/test/FlyBuy/view/emailVerified.php';

$errors = [];

function checknone($arr){
    foreach ($arr as $ele) {
        if ($ele != 'none') {
            return false;
        }
    }
    return true;
}

$signup_username   = '';
$signup_email      = '';
$signup_password   = '';
$signup_confirmPsw = '';
$signup_telNo      = '';
$signup_address    = '';
$signup_storeName  = '';

if (isset($_POST['submitSignup'])){

    $signup_username   = mysqli_real_escape_string($conn, $_POST['username']);
    $signup_email      = mysqli_real_escape_string($conn, $_POST['email']);
    $signup_password   = mysqli_real_escape_string($conn, $_POST['password']);
    $signup_confirmPsw = mysqli_real_escape_string($conn, $_POST['confirmPsw']);
    $signup_telNo      = mysqli_real_escape_string($conn, $_POST['telNo']);
    $signup_address    = mysqli_real_escape_string($conn, $_POST['address']);

    //fetch the resulting rows as an array
    if($_POST['userType'] === "buyer"){
        $users = mysqli_fetch_all( mysqli_query($conn, "SELECT * FROM  buyers"), MYSQLI_ASSOC);
    }
    else{
        //store name is specific to sellers
        $signup_storeName  = mysqli_real_escape_string($conn, $_POST['storeName']);

        $users      = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM  sellers"), MYSQLI_ASSOC);
    }

    // validate entries
    $validation     = new UserValidator($_POST, $users, $_POST['userType'] );
    $return_data    = $validation->validateForm('signup');

    $signupErrors       = $return_data['errors'];
    $signupClassNames   = $return_data['classNames'];
    $vkey               = $return_data['vkey'];

    if (checknone($signupErrors)) {
        $hashed_password = password_hash($signup_password, PASSWORD_DEFAULT);

        if  ($_POST['userType'] === "buyer") {
            $sql = "INSERT INTO  buyers  (username, email, password, telNo, address, verified, vkey) VALUES ('$signup_username', '$signup_email', '$hashed_password', '$signup_telNo', '$signup_address', 'false', '$vkey')";
        }
        else{
            $sql = "INSERT INTO  sellers (username, email, password, telNo, address, storeName, verified, vkey, rating) VALUES ('$signup_username', '$signup_email', '$hashed_password', '$signup_telNo', '$signup_address', '$signup_storeName', 'false', '$vkey', '0')";
        }

        $errors = [];

        if ($conn->query($sql) === TRUE) {

            echo "New record created successfully";

            $table = $_POST['userType'];

            $additionalData  = ['vkey' => $vkey, 'table' => $table];
            $email = $_POST['email'];

            sendMail($email, 'signup', $additionalData, $path_akash);
            header('location:verifyEmail.php?vkey='.$vkey.'&table='.$table);
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else {
        // print_r(array_values($errors));
    }
}

$login_email      = '';
$login_password   = '';

if (isset($_POST['submitLogin'])) {

    $login_email      = mysqli_real_escape_string($conn, $_POST['email']);
    $login_password   = mysqli_real_escape_string($conn, $_POST['password']);

    //fetch the resulting rows as an array
    if($_POST['submitLogin'] === 'buyer'){
        $users  = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM buyers"), MYSQLI_ASSOC);
    }
    else{
        $users  = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM sellers"), MYSQLI_ASSOC);
    }
    
    // validate entries
    $validation     = new UserValidator($_POST, $users, $_POST['submitLogin']);
    $return_data    = $validation->validateForm('login');

    $loginErrors         = $return_data['errors'];
    $loginClassNames     = $return_data['classNames'];

    if (checknone($loginErrors)) {

        $curr_email = $_POST['email'];

        foreach ($users as $user) {
            if ($user['email'] === $curr_email) {
                $curr_user = $user;
                break;
            }
        }

        setcookie('user_login', $curr_email, time() + 86400, "/");

        if($_POST['submitLogin'] == 'buyer'){
            header('Location: homepage.php?buyer_id='.$curr_user['buy_id']);
        }
        else{
            header('Location: sellerAccount.php?seller_id='.$curr_user['seller_id']);
        }
    }
    else {
        // print_r(array_values($errors));
        // print_r(array_values($classNames));
    }
}

?>

<!DOCTYPE html>
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

                            <div class="input-field <?php echo $loginClassNames['email']; ?>">
                                <i class="fas fa-envelope"></i>
                                <input name="email" type="text" placeholder="Email" class="email" value="<?php echo htmlspecialchars($login_email);?>">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <span class="tooltip-text"><?php echo $loginErrors['email']; ?></span>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field <?php echo $loginClassNames['password']; ?>">
                                <i class="fas fa-lock"></i>
                                <input name="password" type="password" placeholder="Password" class="psw" value="<?php echo htmlspecialchars($login_password);?>">
                                <a href="forgotPsw.php"><small class="forgotPsw">forgotten password?</small></a>
                                <i class="fas fa-eye togglePassword"></i>
                                <i class="fas fa-exclamation-circle tooltip">
                                    <span class="tooltip-text"><?php echo $loginErrors['password']; ?></span>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <button class="btn solid login buyer" name="submitLogin" value="buyer">
                                <span class="buttonText">Login as a cutomer</span>
                            </button>

                            <button class="btn solid login seller" name="submitLogin" value="seller">
                                <span class="buttonText">Login as a seller</span>
                            </button>

                        </form>

                    </div>

                    <div class="signin-signup sign-up">

                        <form class="sign-up-form" method="post" action="loginSignup.php">

                            <h2 class="title">Sign up</h2>

                            <div class="input-field <?php echo $signupClassNames['username']; ?>">
                                <i class="fas fa-user"></i>
                                <input name="username" type="text" placeholder="Username" class="username" value="<?php echo htmlspecialchars($signup_username)?>">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $signupErrors['username']; ?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field <?php echo $signupClassNames['email']; ?>">
                                <i class="fas fa-envelope"></i>
                                <input name="email" type="email" placeholder="Email" class="email" value="<?php echo htmlspecialchars($signup_email)?>">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $signupErrors['email']; ?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field <?php echo $signupClassNames['telNo']; ?>">
                                <i class="fas fa-mobile-alt"></i>
                                <input name="telNo" type="tel" placeholder="Phone Number" class="phone" value="<?php echo htmlspecialchars($signup_telNo)?>">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $signupErrors['telNo']; ?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field <?php echo $signupClassNames['address']; ?>">
                                <i class="fas fa-map-marked-alt"></i>
                                <input name="address" type="text" placeholder="Address Ex:- No.20,city,county" class="address" value="<?php echo htmlspecialchars($signup_address)?>">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $signupErrors['address']; ?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field <?php echo $signupClassNames['password']; ?>">
                                <i class="fas fa-lock"></i>
                                <input name="password" type="password" placeholder="Password" class="psw" value="<?php echo htmlspecialchars($signup_password)?>">
                                <i class="fas fa-eye togglePassword"></i>
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $signupErrors['password']; ?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field <?php echo $signupClassNames['confirmPsw']; ?>">
                                <i class="fas fa-lock"></i>
                                <input name="confirmPsw" type="password" placeholder="Confirm Password" class="confirm-psw" value="<?php echo htmlspecialchars($signup_confirmPsw)?>">
                                <i class="fas fa-eye togglePassword"></i>
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $signupErrors['confirmPsw']; ?></small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field store remove <?php echo $signupClassNames['storeName']; ?>">
                                <i class="fas fa-store"></i>
                                <input name="storeName" type="text" placeholder="Store Name" class="store" value="<?php echo htmlspecialchars($signup_storeName)?>">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text"><?php echo $signupErrors['storeName']; ?></small>
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