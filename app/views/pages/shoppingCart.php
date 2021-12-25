<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/style_shoppingCart.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <title>Shopping Cart</title>
</head>

<body>

    <header id="site-header">
        <div class="container">

            <h1>Shopping cart </h1>
            <div class="search-box">
                <input class="search-txt" id="pinput" type="text" name="" placeholder="Search for products" onkeyup="searchFunction()">
                <a class="search-btn" href="#">
                    <i class="fas fa-search"></i>
                </a>
            </div>
            <ul>

                <li><a href="<?php echo URLROOT; ?>/PageController/buyerAccount/<?php echo $data['buyer_id']; ?>">Home</a></li>
                <li><a href="#"><i class="fas fa-cart-plus"><span id="cart-item" class="badge badge-danger" value="<?php echo sizeof($_SESSION['cartarr']) ?>"><?php echo sizeof($_SESSION['cartarr']) ?></span></i></a>
                </li>
                <li><a href="<?php echo URLROOT; ?>/PageController/buyerAccount/<?php echo $data['buyer_id']; ?>">About Us</a></li>
            </ul>
        </div>


    </header>



    <div class="container">
        <section id="cart">
            <header id="hidden" value="xc" class="q"></header>
            <ul class="pul" id="pul">
                <?php
                $total = 0;

                foreach ($_SESSION['cartarr'] as $product) { ?>

                    <li id="pli" class="pli" value="<?php echo $product->itemName ?>">
                        <article class="product block" id="product">
                            <header class="pimg">

                                <input type="hidden" class="pid" value="<?php echo  $product->item_id ?>">
                                <a class="remove">
                                    <img src="<?php echo URLROOT; ?>/public/img/kottu_mee.png" alt="">
                                    <h3>Remove product</h3>
                                </a>
                            </header>
                            <div class="content">
                                <h1><?php echo $product->itemName ?></h1>
                                <?php echo $product->description ?>
                            </div>
                            <footer class="content">
                                <span class="qt-minus ">-</span>
                                <span class="qt" value="<?= $product->amount[1] ?>"><?php echo $product->amount[1] ?></span>
                                <span class="qt-plus ">+</span>
                                <h2 class="full-price">
                                    <?php echo ($product->price) * ($product->amount[1]) ?>
                                </h2>
                                <h2 class="price">
                                    <span class="price"><?php echo $product->price ?>&nbsp;/=</span>
                                </h2>
                                <input type="hidden" name="pid" class="pid" value="<?php echo  $product->item_id ?>">
                                <input type="hidden" name="pamount" class="pamount" value="<?php echo  $product->amount[1] ?>">
                                <input type="hidden" class="pprice" value="<?php echo  $product->price ?>">
                                <input type="hidden" class="pimage" value="<?php echo  $product->image ?>">
                                <input type="hidden" class="pmaxAmount" value="<?php echo  $product->amount[0] ?>">
                            </footer>
                        </article>
                    </li>
                <?php
                    $total += ($product->price) * ($product->amount[1]);
                }
                ?>
            </ul>
            <header id="hidden"></header>

        </section>
    </div>
    <footer id="site-footer">
        <div class="container clearfix">

            <div class="left">
                <h2 class="subtotal">Subtotal: <span><?php echo $total ?></span>/=</h2>

                <h3 class="shipping">Shipping: <span>169.00</span>/=</h3>
            </div>
            <div class="right">
                <h1 class="total">Total: <span><?php echo ($total > 0) ? $total + 169 : 0 ?></span>/=</h1>
                <input class="buy_id" type="hidden" value="<?php echo $data['buyer_id']; ?>">
                <a class="btn draw-border" id="btn">Checkout</a>

                <!-- <a class="psub draw-border" id="psub" href='<?php echo URLROOT; ?>/PageController/buyerAccount/<?php echo $data['buyer_id']; ?>/<?php echo "submit"; ?> '>Home</a> -->

            </div>
        </div>
    </footer>
    <!-- popup form -->
    <div class="popup-menu" id="popup-menu">>
        <h1 class="success">Checkout Success!</h1>
       
            <div class="row">
                <div id="ms-container">
                    <label for="ms-download">
                    
                        <div class="ms-content"> 
                            <div class="ms-content-inside">  
                          
                                <input type="checkbox" id="ms-download" />
                        
                                <div class="ms-line-down-container">
                                    <div class="ms-line-down"></div>
                                </div>
                                <div class="ms-line-point"></div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        
        <!-- <a class="pbtn draw-border downloadbtn" id="pbtn">Download</a> -->
    </div>
     <!-- Section 1 - Notification-->
    <section class="section-notification">
        <ul class="nav">
            <li class="overlay">
                <ul class="notifications">
                    <li>
                        <span><h1>Cart shouldn't be empty!</h1></span>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <script src="<?php echo URLROOT ?>/public/javaScript/shoppingCart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
</body>

</html>