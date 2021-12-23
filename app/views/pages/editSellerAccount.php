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
    <title>FlyBuy | Edit</title>
</head>
<body>

    <main>
        <nav>
            <a href="<?php echo URLROOT; ?>/PageController/home" class="logo">FlyBuy</a>
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
                <!-- <a href="#" class="edit-icon"><i class="fas fa-pen"></i></a> -->
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

        <section class="edit-section">
            <h1 class="title">Edit Account</h1>
    
            <form class="edit-form" id="edit-form" method="POST" action="<?php echo URLROOT; ?>/UserController/editProfile">
                <!-- <div class="input-field <?php echo $editProfileClassNames['username']; ?>"> -->
                <div class="input-field <?php echo (isset($data['editProfileClassNames']['username'])) ? $data['editProfileClassNames']['username'] : ""; ?>">
                    <i class="fas fa-user"></i>
                    <input name="username" type="text" placeholder="Username" class="username" value="<?php echo (isset($data['editProfileData']['username'])) ? $data['editProfileData']['username'] : "";?>">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text"><?php echo $data['editProfileErrors']['username']; ?></small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <!-- <div class="input-field editAccount <?php echo $editProfileClassNames['storeName']; ?>"> -->
                <div class="input-field <?php echo (isset($data['editProfileClassNames']['storeName'])) ? $data['editProfileClassNames']['storeName'] : ""; ?>">
                    <i class="fas fa-store"></i>
                    <input name="storeName" type="text" placeholder="Store name" class="storeName" value="<?php echo (isset($data['editProfileData']['storeName'])) ? $data['editProfileData']['storeName'] : "";?>">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text"><?php echo $data['editProfileErrors']['storeName']; ?></small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <!-- <div class="input-field editAccount <?php echo $editProfileClassNames['telNo']; ?>"> -->
                <div class="input-field <?php echo (isset($data['editProfileClassNames']['telNo'])) ? $data['editProfileClassNames']['telNo'] : ""; ?>">
                    <i class="fas fa-mobile-alt"></i>
                    <input name="telNo" type="text" placeholder="Telephone" class="telNo" value="<?php echo (isset($data['editProfileData']['telNo'])) ? $data['editProfileData']['telNo'] : "";?>">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text"><?php echo $data['editProfileErrors']['telNo']; ?></small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <!-- <div class="input-field editAccount <?php echo $editProfileClassNames['address']; ?>"> -->
                <div class="input-field <?php echo (isset($data['editProfileClassNames']['address'])) ? $data['editProfileClassNames']['address'] : ""; ?>">
                    <i class="fas fa-map-marked-alt"></i>
                    <input name="address" type="text" placeholder="Address" class="address" value="<?php echo (isset($data['editProfileData']['address'])) ? $data['editProfileData']['address'] : "";?>">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text"><?php echo $data['editProfileErrors']['address']; ?></small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <!-- <div class="input-field editAccount <?php echo $editProfileClassNames['password']; ?>"> -->
                <div class="input-field <?php echo (isset($data['editProfileClassNames']['password'])) ? $data['editProfileClassNames']['password'] : ""; ?>">
                    <i class="fas fa-lock"></i>
                    <input name="password" type="password" placeholder="Password" class="psw" value="<?php echo (isset($data['editProfileData']['password'])) ? $data['editProfileData']['password'] : "";?>">
                    <i class="fas fa-eye togglePassword"></i>
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text"><?php echo $data['editProfileErrors']['password']; ?></small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <!-- <div class="input-field editAccount <?php echo $editProfileClassNames['confirmPsw']; ?>"> -->
                <div class="input-field <?php echo (isset($data['editProfileClassNames']['confirmPsw'])) ? $data['editProfileClassNames']['confirmPsw'] : ""; ?>">
                    <i class="fas fa-lock"></i>
                    <input name="confirmPsw" type="password" placeholder="Confirm Password" class="confirm-psw" value="<?php echo (isset($data['editProfileData']['confirmPsw'])) ? $data['editProfileData']['confirmPsw'] : "";?>">
                    <i class="fas fa-eye togglePassword"></i>
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text"><?php echo $data['editProfileErrors']['confirmPsw']; ?></small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <input class="seller-id notify" type="hidden" name="seller_id" value="<?php echo $data['seller_id']; ?>">

                <input type="submit" class="edit btn" name="submitEditProfile" value="Edit">

            </form>
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
    
</body>

<script src="<?php echo URLROOT; ?>/public/javaScript/popupFormValidation.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo URLROOT; ?>/public/javascript/sellerNotification.js"></script>

</html>