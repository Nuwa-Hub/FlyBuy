<?php 
    $doc = new DOMDocument;

    $signinBtn = $doc->getElementById('sign-in-button');

    
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

    <link rel="stylesheet" href="./css/styles_signinLogin.css">
    
    <title>SignIn and SignUp</title>
</head>
<body>

    <main>
        
        <div class="column">

            <div class="container">

                <div class="forms-container">
        
                    <div class="signin-signup sign-in">

                        <form class="sign-in-form">

                            <h2 class="title">Sign in</h2>

                            <div class="input-field">
                                <i class="fas fa-envelope"></i>
                                <input name="email" type="text" placeholder="Email" class="email">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text">Error Message</small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input name="Psw" type="password" placeholder="Password" class="psw">
                                <a href="#"><small class="forgotPsw">forgotten password?</small></a>
                                <i class="fas fa-eye togglePassword"></i>
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text">Error Message</small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <button class="btn solid login">
                                <span class="buttonText">Login</span>
                            </button>
                            
                        </form>

                    </div>
        
                    <div class="signin-signup sign-up">

                        <form class="sign-up-form">

                            <h2 class="title">Sign up</h2>

                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <input name="username" type="text" placeholder="Username" class="username">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text">Error Message</small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field">
                                <i class="fas fa-envelope"></i>
                                <input name="email" type="email" placeholder="Email" class="email">
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text">Error Message</small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input name="password" type="password" placeholder="Password" class="psw">
                                <i class="fas fa-eye togglePassword"></i>
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text">Error Message</small>
                                </i>
                                <i class="fas fa-check-circle"></i>
                            </div>

                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input name="confirmPsw" type="password" placeholder="Confirm Password" class="confirm-psw">
                                <i class="fas fa-eye togglePassword"></i>
                                <i class="fas fa-exclamation-circle tooltip">
                                    <small class="tooltip-text">Error Message</small>
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

                            <button class="btn solid signup">
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
                            <button class="btn transparent" id="sign-up-button">
                                <span class="buttonText">Sign up</span>
                            </button>
                        </div>
                    </div>
        
                </div>
        
            </div>

        </div>

    </main>
    
</body>

<script>
    // toggle login and signup animation
    const sign_in_btn = document.querySelector('#sign-in-button');
    const sign_up_btn = document.querySelector('#sign-up-button');
    const container = document.querySelector('.container');

    sign_up_btn.addEventListener('click', () => {
        container.classList.add('sign-up-mode');
    });

    sign_in_btn.addEventListener('click', () => {
        container.classList.remove('sign-up-mode');
    });
</script>

</html>