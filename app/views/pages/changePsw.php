<?php echo isset($data['values']['confirmPsw']) ? $data['values']['confirmPsw'] : ''; ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/styles_forgotPsw.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <title>Change Password</title>
</head>

<body>
    <main>

        <div class="container">

            <div class="shape-wrapper">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
                </svg>
            </div>

            <div class="forgotPsw">

                <form class="forgotPsw-form" method="post" action="<?php echo URLROOT; ?>/PageController/changePassword/<?php echo $data['vkeyBuyer'] . '/' . $data['vkeySeller'] ?>">

                    <h2 class="title">Change Password?</h2>

                    <img src="<?php echo URLROOT; ?>/public/img/password.png" alt="forgotPsw-image">

            

                    <div class="input-field <?php echo isset($data['classNames']['password']) ? $data['classNames']['password'] : ''; ?>">
                        <i class="fas fa-lock"></i>
                        <input name="password" type="password" placeholder="New Password" class="ForgotPsw" value="<?php echo isset($data['values']['password']) ? $data['values']['password'] : ''; ?>">
                        <i class="fas fa-eye togglePassword"></i>
                        <i class="fas fa-exclamation-circle tooltip">
                            <small class="tooltip-text"><?php echo isset($data['errors']['password']) ? $data['errors']['password'] : ''; ?></small>
                        </i>
                        <i class="fas fa-check-circle"></i>
                    </div>

                    <div class="input-field <?php echo isset($data['classNames']['confirmPsw']) ? $data['classNames']['confirmPsw'] : ''; ?>">
                        <i class="fas fa-lock"></i>
                        <input name="confirmPsw" type="password" placeholder="Confirm Password" class="ForgotPsw" value="<?php echo isset($data['values']['confirmPsw']) ? $data['values']['confirmPsw'] : ''; ?>">
                        <i class="fas fa-eye togglePassword"></i>
                        <i class="fas fa-exclamation-circle tooltip">
                            <small class="tooltip-text"><?php echo isset($data['errors']['confirmPsw']) ? $data['errors']['confirmPsw'] : ''; ?></small>
                        </i>
                        <i class="fas fa-check-circle"></i>
                    </div>

                    <button class="btn solid forgotPsw" name="submitChangePsw">
                        <span class="buttontext">Submit</span>
                    </button>

                    <button class="btn solid forgotPsw" name="loginToYourAccout">
                        <span class="buttontext">Login to your account</span>
                    </button>

                </form>

            </div>

        </div>

    </main>

    <script src="<?php echo URLROOT; ?>/public/javaScript/form.js"></script>

</body>

</html>