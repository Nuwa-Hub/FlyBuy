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
    
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/styles_editSellerAccount.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/styles_popup.css">
    <title>FlyBuy | Edit</title>
</head>
<body>

    <main>
        <nav>
            <a href="#" class="logo">FlyBuy</a>
            <a href='<?php echo URLROOT ?>/pageController/sellerAccount/<?php echo $data['user']->seller_id; ?>' class="home">Home</a>
            <a href="<?php echo URLROOT ?>/PageController/viewAllNotifications/<?php echo $data['user']->seller_id; ?>" class="notification">Notification<span id="cart-item" class="badge badge-danger"></span></a>
            <a href="#" onclick="toggleLogout()" class="logout">Logout</a>
        </nav>

        <aside>
            <div class="header">
                <div class="title">
                    <h2 class="store"><?php echo $data['user']->storeName; ?></h2>
                    <h3 class="rating">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                    </h3>
                </div>
                <div class="profilePic">
                    <form class="profilePic-form" id="profilePic-form" method="POST" action="<?php echo URLROOT; ?>/UserController/editProfilePicture" enctype="multipart/form-data">
                        <img src="<?php echo URLROOT; ?>/public/img/uploads/profilePics/<?php echo $data['user']->profilePic?>" alt="profile picture" class="profile-img">
                        <i class="fa fa-camera" onclick="upload(this)"></i>
                        <input name="profilePic" type="file" accept="image/*" class="file-input" onchange="submitImage(event)">
                        <input class="seller-id pic" type="hidden" name="seller_id" value="<?php echo $data['seller_id']; ?>">
                    </form>
                </div>
            </div>
            <div class="details">
                <div class="name">
                    <i class="fas fa-user"></i>
                    <?php echo $data['user']->username; ?>
                </div>
                <div class="email">
                    <i class="fas fa-envelope"></i>
                    <?php echo $data['user']->email; ?>
                </div>
                <div class="contact">
                    <i class="fas fa-phone"></i>
                    <?php echo $data['user']->telNo; ?>
                </div>
                <div class="location">
                    <i class="fas fa-map-marker-alt"></i>
                    <?php echo $data['user']->address; ?>
                </div>
            </div>
        </aside>

        <section class="edit-section">
            <h1 class="edit title">Edit Profile</h1>
    
            <form class="edit-form" id="edit-form" method="POST" action="<?php echo URLROOT; ?>/UserController/editProfile">
                <div class="input-field <?php echo (isset($data['editProfileClassNames']['username'])) ? $data['editProfileClassNames']['username'] : ""; ?>">
                    <i class="fas fa-user"></i>
                    <input name="username" type="text" placeholder="Username" class="username" value="<?php echo (isset($data['editProfileData']['username'])) ? $data['editProfileData']['username'] : "";?>">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text"><?php echo $data['editProfileErrors']['username']; ?></small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="input-field <?php echo (isset($data['editProfileClassNames']['storeName'])) ? $data['editProfileClassNames']['storeName'] : ""; ?>">
                    <i class="fas fa-store"></i>
                    <input name="storeName" type="text" placeholder="Store name" class="storeName" value="<?php echo (isset($data['editProfileData']['storeName'])) ? $data['editProfileData']['storeName'] : "";?>">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text"><?php echo $data['editProfileErrors']['storeName']; ?></small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="input-field <?php echo (isset($data['editProfileClassNames']['telNo'])) ? $data['editProfileClassNames']['telNo'] : ""; ?>">
                    <i class="fas fa-mobile-alt"></i>
                    <input name="telNo" type="text" placeholder="Telephone" class="telNo" value="<?php echo (isset($data['editProfileData']['telNo'])) ? $data['editProfileData']['telNo'] : "";?>">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text"><?php echo $data['editProfileErrors']['telNo']; ?></small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="input-field <?php echo (isset($data['editProfileClassNames']['address'])) ? $data['editProfileClassNames']['address'] : ""; ?>">
                    <i class="fas fa-map-marked-alt"></i>
                    <input name="address" type="text" placeholder="Address" class="address" value="<?php echo (isset($data['editProfileData']['address'])) ? $data['editProfileData']['address'] : "";?>">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text"><?php echo $data['editProfileErrors']['address']; ?></small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="input-field <?php echo (isset($data['editProfileClassNames']['password'])) ? $data['editProfileClassNames']['password'] : ""; ?>">
                    <i class="fas fa-lock"></i>
                    <input name="password" type="password" placeholder="Password" class="psw" value="<?php echo (isset($data['editProfileData']['password'])) ? $data['editProfileData']['password'] : "";?>">
                    <i class="fas fa-eye togglePassword"></i>
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text"><?php echo $data['editProfileErrors']['password']; ?></small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

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

            <h1 class="popup title">logout?</h1>

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
<script>
    function upload(element){
        const input = element.nextElementSibling;
        
        // force click the input for file uploading
        input.click();
    }

    function submitImage(event){
        const img = document.querySelector('.profile-img');
        img.src = URL.createObjectURL(event.target.files[0]);

        const form = event.target.parentElement;
        // force submit the form
        form.submit();
    }
</script>

</html>