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

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/styles_forgotPsw.css">

    <title>Forgot Password | FlyBuy</title>
</head>

<body>

    <main>

        <div class="container">

            <div class="form-container">

                <form class="forgotPsw-form" method="post" action="<?php echo URLROOT; ?>/PageController/forgotPassword">

                    <h2 class="title">Forgot Password?</h2>

                    <div class="input-field <?php echo isset($data['className']) ? $data['className'] : ''; ?>">
                        <i class="fas fa-envelope"></i>
                        <input name="email" type="text" placeholder="Email" class="emailForgotPsw" name="email" value="<?php echo isset($data['value']) ? $data['value'] : ''; ?>">
                        <i class="fas fa-exclamation-circle tooltip">
                            <small class="tooltip-text"><?php echo isset($data['errorMsg']) ? $data['errorMsg'] : ''; ?></small>
                        </i>
                        <i class="fas fa-check-circle"></i>
                    </div>

                    <small><?php echo isset($data['msg']) ? $data['msg'] : ''; ?></small>             

                    <button class="btn solid forgotPsw" name="submitForgotPsw">
                        <span class="buttontext">Submit</span>
                    </button>
                    
                </form>

            </div>

        </div>

    </main>
    
</body>

</html>