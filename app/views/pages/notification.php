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
            <div class="search">
                <div class="search-box">
                    <input class="search-txt" type="text" placeholder="search here...">
                    <a class="search-btn" href="#">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
            </div>
            <a href='<?php echo URLROOT ?>/pageController/sellerAccount/<?php echo $data['user']->seller_id; ?>' class="home">Home</a>
            <a href="<?php echo URLROOT ?>/PageController/viewNotification/<?php echo $data['user']->seller_id; ?>" class="notification">Notification<span id="cart-item" class="badge badge-danger"></span></a>
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
                <img src="<?php echo URLROOT; ?>/public/img/Nancy-Momoland-Net-Worth-834x1024.jpeg" alt="profile picture">
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
                <input type="radio" name="buttons" id="all" checked>
                <input type="radio" name="buttons" id="marked">
                <input type="radio" name="buttons" id="unmarked">

                <div class="controls">
                    <label for="all" class="label">All</label>
                    <label for="marked" class="label">Marked</label>
                    <label for="unmarked" class="label">Unmarked</label>
                </div>
            </div>
            <div class="content-div">

                <?php foreach($data['notifications'] as $notification): ?>

                    <div class="collapsible notification">

                        <div class="expand-btn" onclick="expand(this)"><i class="fas fa-arrow-circle-down"></i></div>

                        <label class="order-id">order id: 
                            <span><?php echo $notification->notify_id; ?></span>
                        </label>
                        <label class="customer-name">customer name: 
                            <span><?php echo $notification->buyer->username; ?></span>
                        </label>

                        <div class="collapsible content">

                            <button class="mark" onclick="mark(this)">Mark</button>

                            <label class="customer-tel">telephone: 
                                <span>071-569-4899</span>
                            </label>
                            <label class="customer-address">address: 
                                <span>228/2c, Malwaththa Road, Kahanthota Road, Arangala, Malabe</span>
                            </label>

                            <span class="list-title">Item List: </span>

                            <div class="order-details">
                                <div class="item-name">Sugar 500g</div>
                                <div class="item-amount">2</div>
                                <div class="total-price">250 x 2 = Rs. 500</div>

                                <div class="item-name">Sugar 500g</div>
                                <div class="item-amount">2</div>
                                <div class="total-price">250 x 2 = Rs. 500</div>
                            </div>

                            <div class="bill">
                                <label class="total">Total</label>
                                <label class="total-price">Rs. 1000</label>
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

</html>