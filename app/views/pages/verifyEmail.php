<!DOCTYPE html>
<html>

    <head>
        <title>Verify Email | FlyBuy</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/styles_verifyEmail.css"" />
    </head>

    <body class="main-body">

        <main>
            <div class="container">
            
                <div class="content">
                    <h2 class="title">Hello User</h2>
                    <h3 class="subtitle">You&#8217;re almost ready</h3>
                    <h4 class="msg">Go to your email and verify your email address</h4>
        
                    <span class="resend-hint">Haven't Received Your Email Yet?</span>
        
                    <form method="post" class="sendAgainForm">
                        <button class="sendAgainLink">
                            <div class="buttonText">Click Here to Re-send</div>
                        </button>
                    </form>
                    
                    <a class="loginLink btn" href="<?php echo URLROOT; ?>/PageController/loginSignup">Login To Your Account</a>
                </div>
    
            </div>
        </main>

    </body>

</html>