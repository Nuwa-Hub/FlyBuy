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
    
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/styles_sellerNotification.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/styles_popup.css">
    <title>FlyBuy | Notification</title>
</head>
<body>

    <main>
        <nav>
            <a href="#" class="logo">FlyBuy</a>
            <div class="search">
                <div class="search-box">
                    <input class="search-txt" type="text" placeholder="search here...">
                    <a class="search-btn" href="#">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
            </div>
            <a href='<?php echo URLROOT ?>/pageController/sellerAccount/<?php echo $data['user']->seller_id; ?>' class="home">Home</a>
            <a href="<?php echo URLROOT ?>/PageController/viewAllNotifications/<?php echo $data['user']->seller_id; ?>" class="notification">Notification<small id="indicator" class="badge"></small></a>
            <a href="#" onclick="toggleLogout()" class="logout">Logout</a>
        </nav>

        <aside>
            <div class="header">
                <div class="title">
                    <h2 class="store"><?php echo $data['user']->storeName; ?></h2>
                    <h3 class="rating">
                    <span class="stars"><?php echo $data['user']->rating; ?></span>
                    <span><?php echo $data['user']->rating; ?></span>
                    </h3>
                </div>
                <img src="<?php echo URLROOT; ?>/public/img/uploads/profilePics/<?php echo $data['user']->profilePic?>" alt="profile picture">
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
            <a href='<?php echo URLROOT ?>/PageController/editSellerAccount/<?php echo $data['user']->seller_id; ?>' class="edit">edit account</a>
        </aside>

        <section class="notification-section">
            <div class="tab-bar">
                <input type="radio" name="buttons" id="all" <?php echo ($data['type'] == 'all') ? 'checked' : ''; ?>>
                <input type="radio" name="buttons" id="marked" <?php echo ($data['type'] == 'marked') ? 'checked' : ''; ?>>
                <input type="radio" name="buttons" id="unmarked" <?php echo ($data['type'] == 'unmarked') ? 'checked' : ''; ?>>

                <div class="controls">
                    <label for="all" class="label"><a href="<?php echo URLROOT; ?>/PageController/viewAllNotifications/<?php echo $data['seller_id']; ?>/all">All</a></label>
                    <label for="marked" class="label"><a href="<?php echo URLROOT; ?>/PageController/viewAllNotifications/<?php echo $data['seller_id']; ?>/marked">Marked</a></label>
                    <label for="unmarked" class="label"><a href="<?php echo URLROOT; ?>/PageController/viewAllNotifications/<?php echo $data['seller_id']; ?>/unmarked">Unmarked</a></label>
                </div>
            </div>
            <div class="content-div">

                <?php foreach($data['notifications'] as $notification): ?>

                    <div class="collapsible notification">

                        <div class="expand-btn <?php echo ($notification->marked) ? 'marked' : ''; ?>" onclick="expand(this)"><i class="fas fa-arrow-circle-down"></i></div>

                        <label class="order-id">order id: 
                            <span id="order-id"><?php echo $notification->notify_id; ?></span>
                        </label>
                        <label class="customer-name">customer name: 
                            <span><?php echo $notification->buyer->username; ?></span>
                        </label>

                        <div class="collapsible content">

                            <button class="mark" onclick="mark(this)">Mark</button>

                            <label class="customer-tel">telephone: 
                                <span><?php echo $notification->buyer->telNo; ?></span>
                            </label>
                            <label class="customer-address">address: 
                                <span><?php echo $notification->buyer->address; ?></span>
                            </label>

                            <span class="list-title">Item List: </span>

                            <div class="order-details">
                                <?php foreach($notification->item_list as $product): ?>
                                    <div class="item-name"><?php echo $product['itemName']; ?></div>
                                    <div class="item-amount"><?php echo $product['quantity']; ?></div>
                                    <div class="price"><?php echo 'Rs. ' . $product['price'] . ' x ' . $product['quantity'] . ' = Rs. ' . $product['price']*$product['quantity'] ?></div>
                                <?php endforeach; ?>
                            </div>

                            <div class="bill">
                                <label class="total">Total</label>
                                <label class="total-price"><?php echo 'Rs. ' . $notification->order_price ?></label>
                            </div>

                        </div>
                    </div>
                    
                <?php endforeach; ?>

            </div>
        </section>

        <footer>Copyright</footer>
    </main>

    <!-- -----------------------------Popup window to confirm logout--------------------------------------- -->

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

    <input class="seller-id notify" type="hidden" name="seller_id" value="<?php echo $data['seller_id']; ?>">
    
</body>

<script src="<?php echo URLROOT; ?>/public/javaScript/popupFormValidation.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo URLROOT; ?>/public/javascript/sellerNotification.js"></script>

<script src="<?php echo URLROOT; ?>/public/javascript/star.js"></script>

</html>