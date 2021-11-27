<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

//system email credentials
$address = 'cosmosflybuy@gmail.com';
$password = 'kanr@1234';

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;              //Enable verbose debug output
    $mail->isSMTP();                                    //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';               //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                           //Enable SMTP authentication
    $mail->Username   = $address;                       //SMTP username
    $mail->Password   = $password;                      //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    //Enable implicit TLS encryption
    $mail->Port       = 465;

    function sendMail($clientEmail, $type, $additionalData, $path){

        $mail = $GLOBALS['mail'];

        if($type == 'signup'){

            //Recipients
            $mail->setFrom('cosmosflybuy@gmail.com', 'FlyBuy');
            $mail->addAddress($clientEmail);

            //Content
            $vkey = $additionalData['vkey'];
            $table = $additionalData['table'];
            
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'FlyBuy - email verification';
            $mail->Body    = "You have successfully created your Flybuy account. Click <a href='$path/$table/$vkey'>here</a> to verify your email";
        }
        else if($type== 'forgotPsw'){
            $mail->setFrom('cosmosflybuy@gmail.com', 'FlyBuy');
            $mail->addAddress($clientEmail);

            //Content
            $path = 'http://localhost/OOP%20project/FlyBuy/view/changePsw.php';
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'FlyBuy - Change Password';
            $mail->Body    ="Click <a href=$path>here</a> to change your password";
        }

        $mail->send();
        echo 'Message has been sent';

    }
}
catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>