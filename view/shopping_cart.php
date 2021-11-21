<?php
include '../models/product.php';
session_start();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_shoppingCart.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">


    <title>Shopping Cart</title>
</head>

<body>
    <header id="site-header">
        <div class="container">
            <h3>FlyBuy</h3>
            <h1>Shopping cart </h1>
            <div class="search-box">
                <input class="search-txt" id="pinput" type="text" name="" placeholder="Search for products" onkeyup="searchFunction()">
                <a class="search-btn" href="#">
                    <i class="fas fa-search"></i>
                </a>
            </div>
            <ul>

                <li><a href="homepage.php">Home</a></li>
                <li><a href="loginSignup.php">Login/Sign up</a></li>
                <li><a href="shopping_cart.php" class="active"><i class="fas fa-cart-plus"><span id="cart-item" class="badge badge-danger"><?php echo sizeof($_SESSION['cartarr']) ?></span></i></a>
                </li>
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
                    <li class="pli" id="pli" value="<?php echo $product->itemName ?>">
                        <article class="product">
                            <header>
                                <input type="hidden" class="pid" value="<?php echo  $product->item_id ?>">
                                <a class="remove">
                                    <img src=<?php echo $product->image ?> alt="">
                                    <h3>Remove product</h3>
                                </a>
                            </header>
                            <div class="content">
                                <h1><?php echo $product->itemName ?></h1>
                                <?php echo $product->description ?>
                            </div>
                            <footer class="content">
                                <span class="qt-minus">-</span>
                                <span class="qt" value="<?= $product->amount ?>"><?php echo $product->amount ?></span>
                                <span class="qt-plus">+</span>
                                <h2 class="full-price">
                                    <span><?php echo ($product->price) * ($product->amount) ?></span>/=
                                </h2>
                                <h2 class="price">
                                    <span><?php echo $product->price ?></span>/=
                                </h2>
                                <input type="hidden" name="pid" class="pid" value="<?php echo  $product->item_id ?>">
                                <input type="hidden" name="pamount" class="pamount" value="<?php echo  $product->amount ?>">
                                <input type="hidden" class="pprice" value="<?php echo  $product->price ?>">
                                <input type="hidden" class="pimage" value="<?php echo  $product->image ?>">
                                <input type="hidden" class="pmaxAmount" value="<?php echo  $product->maxAmount ?>">
                            </footer>
                        </article>
                    </li>
                <?php
                    $total += ($product->price) * ($product->amount);
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
                <a class="btn">Checkout</a>
            </div>
        </div>
    </footer>
    <script src="../javaScript/shoppingCart.js"></script>
</body>

</html>