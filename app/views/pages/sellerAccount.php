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
    <!-- <script src="https://kit.fontawesome.com/f4df70b5dd.js" crossorigin="anonymous"></script> -->
    
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/styles_sellerAccount.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/styles_popup.css">
    
    <title>FlyBuy | Profile</title>
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
            <a href="#" class="add-item" onclick="toggleDisplay()">New Item+</a>
            <a href="<?php echo URLROOT ?>/PageController/viewAllNotifications/<?php echo $data['user']->seller_id; ?>" class="notification">Notification<small id="indicator" class="badge"></small></a>
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

        <section class="item-container">
            <div class="year-div">
                <label class="year-label">Year: </label>
                <select name="year" id="year" data-component="date" onchange="yearChanged(event)">
                    <?php 
                        for($year=2020; $year <= date('Y'); $year++){
                            echo '<option value="' . $year . '">' . $year . '</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="store-stats">
                <div class="sales">
                    <i class="fas fa-chart-line"></i>
                    <div class="sales-details details-col">
                        <div class="no-sales">80</div>
                        <span>sales</span>
                    </div>
                </div>
                <div class="earnings">
                    <i class="far fa-money-bill-alt"></i>
                    <div class="earnings-details details-col">
                        <div class="no-earnings">Rs. 4250</div>
                        <span>earnings</span>
                    </div>
                </div>
                <div class="graphbox">
                    <canvas id="my-chart"></canvas>
                </div>
            </div>
            
        </section>

        <section class="product-section">
            <div class="product-wrapper">
                <button class="scroll-left scroll"><i class="fas fa-arrow-left"></i></button>
                <div class="product-container">
                    <?php foreach ($data['products'] as $product): ?>
                        <div class="item-details wrapper" id="<?php echo $product->item_id; ?>">
                            <div class="card">
                                <div class="front">
                                    <h2 class="item name"><?php echo $product->itemName; ?></h2>
                                    <h2 class="item price"><?php echo "Rs. ".$product->price; ?></h2>
                                    <img src="<?php echo URLROOT ?>/public/img/uploads/itemImages/<?php echo $product->item_image?>" alt="item">
                                </div>
                                <div class="back">
                                    <p class="item description"><?php echo $product->description; ?></p>
                                    <p class="item amount"><?php echo $product->amount." Available"; ?></p>
                                    <p class="item date"><?php echo date('Y-m-d H:i:s', strtotime($product->created_at)); ?></p>
                                    
                                    <i class="fas fa-trash" onclick="toggleDelete(this)"></i>
                                    <i class="fas fa-edit" onclick="toggleEdit(this)"></i>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="scroll-right scroll"><i class="fas fa-arrow-right"></i></button>
            </div>
        </section>

        <footer>Copyright</footer>
    </main>

    <!-- ------------------------------Popup window to add items-------------------------------------------- -->

    <div class="popup-window addItem">

        <div class="overlay"></div>

        <div class="content">

            <div class="closeBtn" onclick="toggleDisplay()">&times;</div>

            <h1 class="popup title">Add Item</h1>

            <form class="add item-form" id="add item-form" method="POST" action="<?php echo URLROOT; ?>/ProductController/addItem" enctype="multipart/form-data">
                

                <!-- <div class="input-field addItem file-upload">
                    <i class="fas fa-camera"></i>
                    <input name="itemName" type="text" placeholder="Upload Image" class="itemName">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text">Error</small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                    <input type="file" name="itemImage" accept="image/*" class="image-upload">
                </div> -->

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

                <input class="seller-id notify" type="hidden" name="seller_id" value="<?php echo $data['seller_id']; ?>">

                <button class="add-item btn" name="submitAddItem">Add</button>

            </form>

        </div>

    </div>

    <!-- ------------------------------Popup window to edit items------------------------------------------- -->

    <div class="popup-window editItem">

        <div class="overlay"></div>

        <div class="content">

            <div class="closeBtn" onclick="toggleEdit(null)">&times;</div>

            <h1 class="popup title">Edit Item</h1>

            <form class="edit item-form" id="edit item-form" method="POST" action="<?php echo URLROOT; ?>/ProductController/editItem" enctype="multipart/form-data">
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

                <div class="input-field addItem file-upload">
                    <i class="fas fa-file-upload"></i>
                    <input type="file" name="itemImage" accept="image/*" class="image-upload">
                </div>

                <input class="item-id" type="hidden" name="item_id">
                <input class="seller-id" type="hidden" name="seller_id" value="<?php echo $data['seller_id']; ?>">

                <input type="submit" class="edit-item btn" name="submitEditItem" value="Edit">

            </form>

        </div>

    </div>

    <!-- -----------------------------Popup window to confirm delete item--------------------------------------- -->

    <div class="popup-window delete-item">

        <div class="overlay"></div>

            <div class="content">

                <div class="closeBtn" onclick="toggleDelete(null)">&times;</div>

                <h1 class="popup title">delete?</h1>

                <form method="post" class="delete-itemForm" action="<?php echo URLROOT; ?>/ProductController/deleteItem">

                    <input class="item-id" type="hidden" name="item_id">
                    <input class="seller-id" type="hidden" name="seller_id" value="<?php echo $data['seller_id']; ?>">

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

            <h1 class="popup title">logout?</h1>

            <form method="post" class="logoutForm" action="<?php echo URLROOT; ?>/UserController/logout">
                <input type="submit" class="logout btn" name="submitLogout" value="Confirm">
            </form>

        </div>

    </div>
    
</body>

<script src="<?php echo URLROOT; ?>/public/javascript/popupFormValidation.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo URLROOT; ?>/public/javascript/sellerNotification.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.2/dist/chart.min.js"></script>
<script src="<?php echo URLROOT; ?>/public/javascript/myChart.js"></script>


</html>