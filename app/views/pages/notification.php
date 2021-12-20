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
    
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/styles_sellerAccount.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/styles_popup.css">
    <title>FlyBuy | Notification</title>
</head>
<body>

    <main>
        <nav>
            <a href="#" class="logo">FlyBuy</a>
            <a href='<?php echo URLROOT ?>/pageController/sellerAccount/<?php echo $data['user']->seller_id; ?>' class="home">Home</a>
            <a href="<?php echo URLROOT ?>/PageController/viewNotification/<?php echo $data['user']->seller_id; ?>" class="notification">Notification<span id="cart-item" class="badge badge-danger"></a>
            <a onclick="toggleLogout()" class="logout">Logout</a>
        </nav>

        <aside>
            <div class="header">
                <h3 class="store"><?php echo $data['user']->storeName; ?></h3>
                <h3>
                    <i class="fa fa-star checked"></i>
                    <i class="fa fa-star checked"></i>
                    <i class="fa fa-star checked"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </h3>
                <a href='<?php echo URLROOT ?>/pageController/editSellerAccount/<?php echo $data['user']->seller_id; ?>' class="user-edit-icon"><i class="fas fa-user-edit"></i></a>
            </div>
            <div class="img-div">
                <img src="<?php echo URLROOT ?>/public/img/user.png" alt="profile picture">
            </div>
            <div class="name"><?php echo $data['user']->username; ?>
                <label for="name" class="label label-name">Username</label>
            </div>
            <div class="email"><?php echo $data['user']->email; ?>
                <label for="name" class="label label-name">Email</label>
            </div>
            <div class="contact"><?php echo $data['user']->telNo; ?>
                <label for="name" class="label label-name">Telephone</label>
            </div>
            <div class="location"><?php echo $data['user']->address; ?>
                <label for="name" class="label label-name">Address</label>
            </div>
        </aside>

        <section class="notification-container">
            <!-- display notifications here -->
            <div class="order-container">
                Here
            </div>
        </section>

        <footer>Copyright</footer>
    </main>

    <!-- -----------------------------Popup window to confirm logout--------------------------------------- -->

    <div class="popup-window logout">

        <div class="overlay"></div>

        <div class="content">

            <div class="closeBtn" onclick="toggleLogout()">&times;</div>

            <h1 class="title">Do you want to logout?</h1>

            <img src="<?php echo URLROOT; ?>/public/img/warn.png" alt="warn.png" class="warn-img">

            <form method="post" class="logoutForm" action="<?php echo URLROOT; ?>/UserController/logout">
                <input type="submit" class="logout btn" name="submitLogout" value="Confirm">
            </form>

        </div>

    </div>

    <input class="seller-id notify" type="hidden" name="seller_id" value="<?php echo $data['seller_id']; ?>">
    
</body>

<script src="<?php echo URLROOT; ?>/public/javaScript/popupFormValidation.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo URLROOT; ?>/public/javascript/sellerNotification.js"></script>

</html>