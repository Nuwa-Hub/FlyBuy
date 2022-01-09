<!DOCTYPE html5>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FlyBuy | Home</title>
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/style_editBuyerAccount.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/styles_popup.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Great Vibes' rel='stylesheet'>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>
<header id="header">
    <a href="<?php echo URLROOT; ?>/PageController/home" class="logo">FlyBuy</a>
    <img src="<?php echo URLROOT; ?>/public/img/logo.png" id="flybuy-logo" style="width:65px;height:65px;position:fixed;left:210px;">

    <ul>
      <li><a href="<?php echo URLROOT; ?>/PageController/buyerAccount/<?php echo $data['user']->buy_id; ?>">Home</a></li>
      <li><a href='<?php echo URLROOT; ?>/PageController/shoppingCart/<?php echo $data['user']->buy_id; ?>'><i class="fas fa-cart-plus"><span id="cart-item" class="badge badge-danger"><?php echo sizeof($_SESSION['cartarr']); ?></span></i></a> </li>
      <li><a href="<?php echo URLROOT; ?>/PageController/aboutUs">About us</a></li>
      <li><a onclick="toggleLogout()" class="logout">Logout</a></li>
    </ul>
  </header>

<body>
  <div class="wrapper">
    <div class="name">
      <img src="<?php echo URLROOT; ?>/public/img/avatar2.png"style="width:150px;height:150px;">
      <h1 style="color:white;font-family:Great Vibes;font-size: 55px;">Welcome</h1>
      <h1 style="color:white;"><?php echo $data['user']->username; ?></h1><br><br>
      <div class="info">
        <i class="fas fa-user-alt" style="font-size:25px;color:white"><span style="font-family: Myriad Pro;"> <?php echo $data['user']->username; ?></span></i><br><br>
        <i class="fa fa-envelope" style="font-size:25px;color:white"><span style="font-family: Myriad Pro;"> <?php echo $data['user']->email; ?></span></i><br><br>
        <i class="fas fa-map-marker-alt" style="font-size:25px;color:white"><span style="font-family: Myriad Pro;"> <?php echo $data['user']->address; ?></span></i><br><br>
        <i class="fa fa-phone" style="font-size:25px;color:white"><span style="font-family: Myriad Pro;"> <?php echo $data['user']->telNo; ?></span></i>
      </div>
      
    </div>
    <div class="orders">
      <h1 style="color:white;">Order history</h1>
    </div>
  </div>

  <!--Popup window to confirm logout-->

  <div class="popup-window logout">

    <div class="overlay"></div>

    <div class="content">

      <div class="closeBtn" onclick="toggleLogout()">&times;</div>

      <h1 class="popup title">logout</h1>

      <form method="post" class="logoutForm" action="<?php echo URLROOT; ?>/UserController/logout">
        <input type="submit" class="logout btn" name="submitLogout" value="Confirm">
      </form>

    </div>

  </div>

</body>

<script src="<?php echo URLROOT; ?>/public/javascript/homePage.js"></script>

<script src="<?php echo URLROOT; ?>/public/javascript/popupFormValidation.js"></script>

<script src="<?php echo URLROOT; ?>/public/javascript/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script src="<?php echo URLROOT ?>/public/javaScript/shoppingCart.js"></script>





</html>
