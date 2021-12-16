<?php 

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
    
    <title>FlyBuy | Profile</title>
</head>
<body>

    <main>
        <nav>
            <a href="#" class="logo">FlyBuy</a>
            <a href='<?php echo URLROOT ?>/PageController/sellerAccount/<?php echo $data['user']->seller_id; ?>' class="home">Home</a>
            <a href="<?php echo URLROOT ?>/PageController/viewNotification/<?php echo $data['user']->seller_id; ?>" class="notification">Notification<span id="cart-item" class="badge badge-danger"><?php echo sizeof($_SESSION['cartarr']); ?></a>
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
                <a href='<?php echo URLROOT ?>/PageController/editSellerAccount/<?php echo $data['user']->seller_id; ?>' class="user-edit-icon"><i class="fas fa-user-edit"></i></a>
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
            
            <?php foreach ($data['products'] as $product): ?>
                <div class="item-details" id="<?php echo $product->item_id; ?>">
                    <div class="item-img"><img src="<?php echo URLROOT ?>/public/img/sugar500g.jpg" alt="item"></div>
                    <div class="item-name">
                        <div><?php echo $product->itemName; ?></div>
                        <small><?php echo $product->description; ?></small>
                    </div>
                    <div class="item-price"><?php echo "Rs. ".$product->price; ?></div>
                    <div class="item-amount"><?php echo $product->amount." Available"; ?></div>
                    <div class="item-date-added"><?php echo date('Y-m-d H:i:s', strtotime($product->created_at)); ?>
                        <button class="item-edit-btn" onclick="toggleEdit(this)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="item-delete-btn" onclick="toggleDelete(this)">
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

            <form class="add item-form" id="add item-form" method="POST" action="<?php echo URLROOT; ?>/ProductController/addItem">
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
                    <input name="price" type="number" placeholder="Price" min="0.00" step="0.01" class="price">
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

                <input class="item-id" type="hidden" name="seller_id" value="<?php echo $data['seller_id']; ?>">

                <button class="add-item btn" name="submitAddItem">Add</button>

            </form>

        </div>

    </div>

    <!-- ------------------------------Popup window to edit items------------------------------------------- -->

    <div class="popup-window editItem">

        <div class="overlay"></div>

        <div class="content">

            <div class="closeBtn" onclick="toggleEdit(null)">&times;</div>

            <h1 class="title">Edit Item</h1>

            <form class="edit item-form" id="edit item-form" method="POST" action="<?php echo URLROOT; ?>/ProductController/editItem">
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
                    <input name="price" type="number" placeholder="Price" min="0.00" step="0.01" class="price">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text">Error</small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="input-field editItem">
                    <i class="fas fa-file-alt"></i>
                    <input name="description" type="text" placeholder="Description" class="description" value="<?php echo htmlspecialchars($product->description); ?>">
                    <i class="fas fa-check-circle"></i>
                </div>

                <input class="item-id" type="hidden" name="item_id">
                <input class="item-id" type="hidden" name="seller_id" value="<?php echo $data['seller_id']; ?>">

                <input type="submit" class="edit-item btn" name="submitEditItem" value="Edit">

            </form>

        </div>

    </div>

    <!-- -----------------------------Popup window to confirm delete item--------------------------------------- -->

    <div class="popup-window delete-item">

        <div class="overlay"></div>

            <div class="content">

                <div class="closeBtn" onclick="toggleDelete(null)">&times;</div>

                <h1 class="title">delete?</h1>

                <img src="<?php echo URLROOT; ?>/public/img/warn.png" alt="warn.png" class="warn-img">

                <form method="post" class="delete-itemForm" action="<?php echo URLROOT; ?>/ProductController/deleteItem">

                    <input class="item-id" type="hidden" name="item_id">
                    <input class="item-id" type="hidden" name="seller_id" value="<?php echo $data['seller_id']; ?>">

                    <input type="submit" class="delete-item btn" name="submitDeleteItem" value="Delete">

                </form>

            </div>

        </div>

    </body>

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

<script src="<?php echo URLROOT; ?>/public/javascript/popupFormValidation.js"></script>

</html>