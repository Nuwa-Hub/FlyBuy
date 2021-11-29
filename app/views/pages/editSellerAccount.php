<?php 

// include '../models/buyer.php';
// include '../models/seller.php';
// include '../database/db_connection.php';

// require('../validators/user_validator.php');

// // if(strpos($_SERVER['HTTP_USER_AGENT'],'Mediapartners-Google') !== false) {
// //     exit();
// // }

// $userType = 'seller';
// $seller_id = $_GET['seller_id'];

// function checknone($arr){

//     foreach ($arr as $ele) {
//         if ($ele != 'none') {
//             return false;
//         }
//     }
//     return true;
// }

// if(isset($_POST['submitLogout'])){

//     if (isset($_COOKIE['user_login'])) {

//         unset($_COOKIE['user_login']); 
//         setcookie('user_login', null, -1, '/');
//     }
    
//     header('Location: loginSignup.php');
// }

// if(!isset($_COOKIE['user_login'])){
//     header('Location: loginSignup.php');
// }
// else{

//     $curr_email = $_COOKIE['user_login'];  //logged in user email

//     $edit_username = '';
//     $edit_storeName = '';
//     $edit_telNo = '';
//     $edit_address = '';
//     $edit_password = '';
//     $edit_confirmPsw = '';

//     $user  = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM sellers WHERE email = '$curr_email' LIMIT 1"), MYSQLI_ASSOC)[0];

//     if (isset($_POST['submitEditProfile'])){

//         unset($_POST['submitEditProfile']);
        
//         $edit_username   = mysqli_real_escape_string($conn, $_POST['username']);
//         $edit_storeName  = mysqli_real_escape_string($conn, $_POST['storeName']);
//         $edit_telNo      = mysqli_real_escape_string($conn, $_POST['telNo']);
//         $edit_address    = mysqli_real_escape_string($conn, $_POST['address']);
//         $edit_password   = mysqli_real_escape_string($conn, $_POST['password']);
//         $edit_confirmPsw = mysqli_real_escape_string($conn, $_POST['confirmPsw']);

//         // validate entries
//         $validation     = new UserValidator($_POST, [], $userType );
//         $return_data    = $validation->validateForm('editProfile');
        
//         $editProfileErrors       = $return_data['errors'];
//         $editProfileClassNames   = $return_data['classNames'];

//         if(count($editProfileErrors) == 0){
//             header('Location: sellerAccount.php?seller_id='.$seller_id);
//         }
//         else if(checknone($editProfileErrors)){

//             $psw_changed = false;

//             try {

//                 if(!empty($edit_username)){
//                     $update = $conn->query("UPDATE sellers SET username = '$edit_username' WHERE seller_id = $seller_id");
//                 }
//                 if(!empty($edit_storeName)){
//                     $update = $conn->query("UPDATE sellers SET storeName = '$edit_storeName' WHERE seller_id = $seller_id");
//                 }
//                 if(!empty($edit_telNo)){
//                     $update = $conn->query("UPDATE sellers SET telNo = '$edit_telNo' WHERE seller_id = $seller_id");
//                 }
//                 if(!empty($edit_address)){
//                     $update = $conn->query("UPDATE sellers SET address = '$edit_address' WHERE seller_id = $seller_id");
//                 }
//                 if(!empty($edit_password)){

//                     $hashed_password = password_hash($edit_password, PASSWORD_DEFAULT);
//                     $update = $conn->query("UPDATE sellers SET password = '$hashed_password' WHERE seller_id = $seller_id");
//                     $psw_changed = true;
//                 }
//             }
//             catch (Exception $e) {
//                 echo "Data could not be change";
//             }

//             if($psw_changed){

//                 if (isset($_COOKIE['user_login'])) {

//                     unset($_COOKIE['user_login']); 
//                     setcookie('user_login', null, -1, '/');
//                 }
                
//                 header('Location: loginSignup.php');
//             }
//             else{
//                 header('Location: sellerAccount.php?seller_id='.$seller_id);
//             }
//         }
//     }
// }

?>


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
            <a href="#" class="logo">FlyBuy</a>
            <a href='<?php echo URLROOT ?>/pageController/sellerAccount/<?php echo $data['user']->seller_id; ?>' class="home">Home</a>
            <a href="#" class="notification">Notification</a>
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

                <input class="item-id" type="hidden" name="seller_id" value="<?php echo $data['seller_id']; ?>">

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

            <form method="post" class="logoutForm">
                <input type="submit" class="logout btn" name="submitLogout" value="Confirm">
            </form>

        </div>

    </div>
    
</body>

<script src="<?php echo URLROOT; ?>/public/javaScript/popupFormValidation.js"></script>

</html>