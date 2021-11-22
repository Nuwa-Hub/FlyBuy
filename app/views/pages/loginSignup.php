<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="../../../public/css/styles_signinLogin.css">

    <title>SignIn and SignUp</title>
</head>

<body>

    <main>

        <div class="column">

            <div class="container">

                <div class="forms-container">

                    <div class="signin-signup sign-in">

                        <form class="sign-in-form" method="post" action=<?php echo URLROOT . "/pages/loginSignup"; ?>>

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
                            <img src="../../../public/img/resources/user.png" alt="user">
                        </div>
                    </div>

                    <div class="panel right-panel">
                        <div class="content">
                            <img src="../../../public/img/resources/user.png" alt="user">
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

    <script src="../../../public/javascript/form.js"></script>

</body>

</html>