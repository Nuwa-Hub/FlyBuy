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
            <h3>FlyBuy</h3>
            <h1>Shopping cart </h1>
            <div class="search-box">
                <input class="search-txt" id="pinput" type="text" name="" placeholder="Search for products" onkeyup="searchFunction()">
                <a class="search-btn" href="#">
                    <i class="fas fa-search"></i>
                </a>
            </div>
            <ul>

                <li><a href="<?php echo URLROOT; ?>/PageController/buyerAccount/<?php echo $data['buyer_id']; ?>">Home</a></li>
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

                    <li id="pli" class="pli" value="<?php echo $product->itemName ?>">
                        <article class="product" id="product">
                            <header>

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
                                <span class="qt-minus">-</span>
                                <span class="qt" value="<?= $product->amount[1] ?>"><?php echo $product->amount[1] ?></span>
                                <span class="qt-plus">+</span>
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

                <a class="btn">Checkout</a>

            </div>
        </div>
    </footer>
    <!-- popup form -->
    <div class="popup-form" id="popup-form">

        <div class="pdf">
            <label for="pdf-dn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                    <path d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                </svg></label></button>
        </div>

        <input type="hidden" class="buy_id" value="<?php echo $data['buyer_id']; ?>">
        <a class="pbtn" href='<?php echo URLROOT; ?>/PageController/downloadPdf/<?php echo $data['buyer_id']; ?>'>Download</a>
        <a class="psub" href='<?php echo URLROOT; ?>/PageController/buyerAccount/<?php echo $data['buyer_id']; ?>'>Submit</a>


        <!-- 
        <button class="submit" id="submit">
            <img id="lorry" src="../../public/img/lorry.jpg" alt=" ">
        </button> -->
    </div>
    <script src="<?php echo URLROOT ?>/public/javaScript/shoppingCart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
</body>

</html>