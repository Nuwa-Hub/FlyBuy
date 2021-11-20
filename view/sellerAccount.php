<?php 

include '../models/buyer.php';
include '../models/seller.php';
include '../database/db_connection.php';

require('../validators/product_validator.php');

// if(strpos($_SERVER['HTTP_USER_AGENT'],'Mediapartners-Google') !== false) {
//     exit();
// }

$seller_id = $_GET['seller_id'];

function checknone($arr){

    foreach ($arr as $ele) {
        if ($ele != 'none') {
            return false;
        }
    }
    return true;
}

if(isset($_POST['submitLogout'])){

    if (isset($_COOKIE['user_login'])) {

        unset($_COOKIE['user_login']); 
        setcookie('user_login', null, -1, '/');
    }
    
    header('Location: loginSignup.php');
}

if(!isset($_COOKIE['user_login'])){
    header('Location: loginSignup.php');
}
else{

    $curr_email = $_COOKIE['user_login'];  //logged in user email
    
    $user  = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM sellers WHERE email = '$curr_email' LIMIT 1"), MYSQLI_ASSOC)[0];
    $products = mysqli_fetch_all( mysqli_query($conn, "SELECT * FROM  products"), MYSQLI_ASSOC);
    
    $add_itemName = '';
    $add_amount = '';
    $add_price = '';
    $add_description = '';

    $edit_itemName = '';
    $edit_amount = '';
    $edit_price = '';
    $edit_description = '';
    
    if (count($_POST) > 0 && isset($_POST['submitAddItem'])){
        
        $add_itemName = mysqli_real_escape_string($conn, $_POST['itemName']);
        $add_amount = mysqli_real_escape_string($conn, $_POST['amount']);
        $add_price = mysqli_real_escape_string($conn, $_POST['price']);
        $add_description = mysqli_real_escape_string($conn, $_POST['description']);
        
        //if eka nattan seller_id = 0 una duplicate item ekak add wenw.ekai if ek damme
        if($seller_id != 0){
            $sql = "INSERT INTO  products  (itemName,amount,price,description,seller_id) VALUES ('$add_itemName','$add_amount','$add_price','$add_description', '$seller_id')";
        }        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header('Location: sellerAccount.php?seller_id='.$seller_id);
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if(isset($_POST['submitEditItem'])){

        $edit_itemName = mysqli_real_escape_string($conn, $_POST['itemName']);
        $edit_amount = mysqli_real_escape_string($conn, $_POST['amount']);
        $edit_price = mysqli_real_escape_string($conn, $_POST['price']);
        $edit_description = mysqli_real_escape_string($conn, $_POST['description']);

        $item_id = $_POST['item_id'];

        print_r($item_id);
        try {

            if(!empty($edit_itemName)){
                $update = $conn->query("UPDATE products SET itemName = '$edit_itemName' WHERE seller_id = $seller_id");
            }
            if(!empty($edit_amount)){
                $update = $conn->query("UPDATE products SET amount = '$edit_amount' WHERE seller_id = $seller_id");
            }
            if(!empty($edit_price)){
                $update = $conn->query("UPDATE products SET price = '$edit_price' WHERE seller_id = $seller_id");
            }
            if(!empty($edit_description)){
                $update = $conn->query("UPDATE products SET description = '$edit_description' WHERE seller_id = $seller_id");
            }
        }
        catch (Exception $e) {
            echo "Data could not be change";
        }

        header('Location: sellerAccount.php?seller_id='.$seller_id);
    }
}

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
    
    <link rel="stylesheet" href="../css/styles_sellerAccount.css">
    <link rel="stylesheet" href="../css/styles_popup.css">
    <title>FlyBuy | Profile</title>
</head>
<body>

    <main>
        <nav>
            <a href="#" class="logo">FlyBuy</a>
            <a href='sellerAccount.php?id=<?php echo $seller_id; ?>' class="home">Home</a>
            <a href="#" class="notification">Notification</a>
            <a onclick="toggleLogout()" class="logout">Logout</a>
        </nav>

        <aside>
            <div class="header">
                <h3 class="store"><?php echo $user['storeName']; ?></h3>
                <h3>
                    <i class="fa fa-star checked"></i>
                    <i class="fa fa-star checked"></i>
                    <i class="fa fa-star checked"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </h3>
                <a href='editSellerAccount.php?seller_id=<?php echo $seller_id; ?>' class="user-edit-icon"><i class="fas fa-user-edit"></i></a>
            </div>
            <div class="img-div">
                <img src="../resources/user.png" alt="profile picture">
                <!-- <a href="#" class="edit-icon"><i class="fas fa-pen"></i></a> -->
            </div>
            <div class="name"><?php echo $user['username']; ?>
                <label for="name" class="label label-name">Username</label>
            </div>
            <div class="email"><?php echo $user['email']; ?>
                <label for="name" class="label label-name">Email</label>
            </div>
            <div class="contact"><?php echo $user['telNo']; ?>
                <label for="name" class="label label-name">Telephone</label>
            </div>
            <div class="location"><?php echo $user['Address']; ?>
                <label for="name" class="label label-name">Address</label>
            </div>
        </aside>

        <section class="control-section">
            <div class="search">
                <div class="search-box">
                    <input class="search-txt" type="text" placeholder="search here...">
                    <a class="search-btn" href="#">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
            </div>
            <a class="add-item" onclick="toggleDisplay()">New Item+</a>
        </section>

        <section class="item-container">
            
            <?php foreach ($products as $product): ?>
                <div class="item-details">
                    <div class="item-img"><img src="../resources/sugar500g.jpg" alt="item"></div>
                    <div class="item-name">
                        <div><?php echo $product['itemName']; ?></div>
                        <small><?php echo $product['description']; ?></small>
                    </div>
                    <div class="item-price"><?php echo "Rs. ".$product['price']; ?></div>
                    <div class="item-amount"><?php echo $product['amount']." Available"; ?></div>
                    <div class="item-date-added"><?php echo date('Y-m-d H:i:s', strtotime($product['created_at'])); ?>
                        <button class="item-edit-btn" onclick="toggleEdit()">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="item-delete-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
            
        </section>

        <footer>Copyright</footer>
    </main>

    <!-- ------------------------------Popup window to add items-------------------------------------------- -->

    <div class="popup-window addItem">

        <div class="overlay"></div>

        <div class="content">

            <div class="closeBtn" onclick="toggleDisplay()">&times;</div>

            <h1 class="title">Add Item</h1>

            <form class="item-form" id="item-form" method="POST">
                <div class="input-field addItem">
                    <i class="fas fa-archive"></i>
                    <input name="itemName" type="text" placeholder="Item Name" class="itemName">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text">Error</small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="input-field addItem">
                    <i class="fas fa-sort-numeric-up-alt"></i>
                    <input name="amount" type="number" placeholder="Amount" min="1" class="amount">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text">Error</small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="input-field addItem">
                    <i class="fas fa-dollar-sign"></i>
                    <input name="price" type="number" placeholder="Price" min="0.00" class="price">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text">Error</small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="input-field addItem">
                    <i class="fas fa-file-alt"></i>
                    <input name="description" type="text" placeholder="Description" class="description">
                    <i class="fas fa-check-circle"></i>
                </div>

                <input type="submit" class="add-item btn" name="submitAddItem" value="Add">

            </form>

        </div>

    </div>

    <!-- ------------------------------Popup window to edit items------------------------------------------- -->

    <div class="popup-window editItem">

        <div class="overlay"></div>

        <div class="content">

            <div class="closeBtn" onclick="toggleEdit()">&times;</div>

            <h1 class="title">Edit Item</h1>

            <form class="item-form" id="item-form" method="POST">
                <div class="input-field editItem">
                    <i class="fas fa-archive"></i>
                    <input name="itemName" type="text" placeholder="Item Name" class="itemName">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text">Error</small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="input-field editItem">
                    <i class="fas fa-sort-numeric-up-alt"></i>
                    <input name="amount" type="number" placeholder="Amount" min="1" class="amount">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text">Error</small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="input-field editItem">
                    <i class="fas fa-dollar-sign"></i>
                    <input name="price" type="number" placeholder="Price" min="0.00" class="price">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text">Error</small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="input-field editItem">
                    <i class="fas fa-file-alt"></i>
                    <input name="description" type="text" placeholder="Description" class="description" value="<?php echo htmlspecialchars($product['description']); ?>">
                    <i class="fas fa-check-circle"></i>
                </div>

                <!-- <input class="item-id" type="hidden" name="item_id" value="<?php echo $product['item_id']; ?>"> -->

                <input type="submit" class="edit-item btn" name="submitEditItem" value="Edit">

            </form>

        </div>

    </div>

    <!-- -----------------------------Popup window to confirm logout--------------------------------------- -->

    <div class="popup-window logout">

        <div class="overlay"></div>

        <div class="content">

            <div class="closeBtn" onclick="toggleLogout()">&times;</div>

            <h1 class="title">Do you want to logout?</h1>

            <img src="../resources/warn.png" alt="warn.png" class="warn-img">

            <form method="post" class="logoutForm">
                <input type="submit" class="logout btn" name="submitLogout" value="Confirm">
            </form>

        </div>

    </div>
    
</body>

<script src="../javaScript/popupFormValidation.js"></script>

</html>