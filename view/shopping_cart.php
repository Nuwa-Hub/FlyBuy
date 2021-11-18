<?php
include '../models/product.php';
session_start();
$productsArr = new ArrayObject(array());


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_shoppingCart.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Shopping Cart</title>
</head>

<body onload="changeTot()">
    <header id="site-header">
        <div class="container">
            <h1>Shopping cart </h1>
        </div>
    </header>

    <div class="container">
        <section id="cart">
            <?php
            foreach ($_SESSION['cartArr'] as $product) { ?>
                <article class="product">
                    <header>
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
                            <?php echo ($product->price) * ($product->amount) ?>
                        </h2>
                        <h2 class="price">
                            <?php echo $product->price ?>
                        </h2>
                        <input type="hidden" class="pid" value="<?php echo  $product->item_id ?>">
                        <input type="hidden" class="pamount" value="<?php echo  $product->amount ?>">
                        <input type="hidden" class="pprice" value="<?=  $product->price ?>">
                        <input type="hidden" class="pimage" value="<?=  $product->image ?>">
                    </footer>
                </article>
            <?php
            }
            ?>
        </section>
    </div>
    <footer id="site-footer">
        <div class="container clearfix">

            <div class="left">
                <h2 class="subtotal">Subtotal: <span>163.96</span>/=</h2>

                <h3 class="shipping">Shipping: <span>169.00</span>/=</h3>
            </div>
            <div class="right">
                <h1 class="total">Total: <span>177.16</span>/=</h1>
                <a class="btn">Checkout</a>
            </div>
        </div>
    </footer>
    <script src="../javaScript/shoppingCart.js"></script>
</body>

</html>