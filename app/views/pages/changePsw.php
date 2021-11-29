<!DOCTYPE html>
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

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/styles_changePsw.css">

    <title>Change Password | FlyBuy</title>
</head>

<body>

    <main>

        <div class="container">

            <div class="form-container">

                <form class="changePsw-form" method="post" action="<?php echo URLROOT; ?>/PageController/changePassword/<?php echo $data['vkeyBuyer'] . '/' . $data['vkeySeller'] ?>">

                    <h2 class="title">Change Password?</h2>

                    <div class="input-field password <?php echo isset($data['classNames']['password']) ? $data['classNames']['password'] : ''; ?>">
                        <i class="fas fa-lock"></i>
                        <input name="password" type="password" placeholder="New Password" class="ForgotPsw" value="<?php echo isset($data['values']['password']) ? $data['values']['password'] : ''; ?>">
                        <i class="fas fa-eye togglePassword"></i>
                        <i class="fas fa-exclamation-circle tooltip">
                            <small class="tooltip-text"><?php echo isset($data['errors']['password']) ? $data['errors']['password'] : ''; ?></small>
                        </i>
                        <i class="fas fa-check-circle"></i>
                    </div>

                    <div class="input-field confirmPsw <?php echo isset($data['classNames']['confirmPsw']) ? $data['classNames']['confirmPsw'] : ''; ?>">
                        <i class="fas fa-lock"></i>
                        <input name="confirmPsw" type="password" placeholder="Confirm Password" class="ForgotPsw" value="<?php echo isset($data['values']['confirmPsw']) ? $data['values']['confirmPsw'] : ''; ?>">
                        <i class="fas fa-eye togglePassword"></i>
                        <i class="fas fa-exclamation-circle tooltip">
                            <small class="tooltip-text"><?php echo isset($data['errors']['confirmPsw']) ? $data['errors']['confirmPsw'] : ''; ?></small>
                        </i>
                        <i class="fas fa-check-circle"></i>
                    </div>

                    <button class="btn solid forgotPsw submit" name="submitChangePsw">
                        <span class="buttontext">Submit</span>
                    </button>

                    <a href="<?php echo URLROOT; ?>/PageController/loginSignup" class="btn solid forgotPsw login" name="loginToYourAccout">
                        <span class="buttontext">Login to your account</span>
                    </a>
                    
                </form>

            </div>

        </div>

    </main>

    <script src="<?php echo URLROOT; ?>/public/javaScript/form.js"></script>
    
</body>

</html>