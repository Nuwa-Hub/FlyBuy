<!DOCTYPE html5>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FlyBuy | Home</title>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/style_buyerAccount.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/styles_popup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
  </head>

  <body>

    <header id="header">
      <a href="#" class="logo">FlyBuy</a>
      <div class="search-box">
        <input class="search-txt" type="text" name="" placeholder="Search for products">
        <a class="search-btn" href="#">
          <i class="fas fa-search"></i>
        </a>
      </div>
      <ul>
        <li><a href="#" class="active">Home</a></li>
        <li><a href='<?php echo URLROOT; ?>/PageController/shoppingCart/<?php echo $data['user']->buy_id; ?>'><i class="fas fa-cart-plus"><span id="cart-item" class="badge badge-danger"><?php echo sizeof($_SESSION['cartarr']); ?></span></i></a> </li>
        <li><a onclick="toggleLogout()" class="logout">Logout</a></li>
      </ul>
    </header>

    <section>
      <h2 id="text"><span>Welcome to</span><br>FlyBuy</h2>
      <img src="<?php echo URLROOT ?>/public/img/item1.png" id="item1">
      <a href="#products" id='btn'>Explore</a>

      <img src="<?php echo URLROOT ?>/public/img/item2.png" id="item2">
    </section>

    <div class="sec" id="products">
      <h2>Featured products</h2>
      <div class="container">
        <?php foreach ($data['products'] as $product) : ?>
          <div class="product">
            <div class="product-card">
              <h3 class="name"><?php echo $product->itemName; ?></h3>
              <span class="price"><?php echo "Rs. " . $product->price; ?></span>
              <a class="popup-btn">View item</a>
              <img src="<?php echo URLROOT ?>/public/img/kottu_mee.png" class="product-img" alt="">
            </div>
            <div class="popup-view">
              <form method="post" action="<?php echo URLROOT; ?>/ProductController/addToCart">
                <div class="popup-card">
                  <a><i class="fas fa-times close-btn"></i></a>
                  <div class="product-img">
                    <img src="<?php echo URLROOT ?>/public/img/kottu_mee.png" alt="">
                  </div>
                  <div class="info">
                    <h2><?php echo $data['user']->buy_id; ?><br><span>Chandrasena stores</span></h2>
                    <h3><span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star"></span>
                    </h3>
                    <p><?php echo $product->description; ?></p>
                    <span class="price"><?php echo "Rs. " . $product->price . "/unit"; ?></span>
                    <span class="quantity">Quantity :</span>
                    <input type="number" name="pqty" class="pqty" value="1" id="quantity" name="quantity" min="1" max="<?php $product->amount ?>">

                    <input type="hidden" name="pid" class="pid" value="<?php echo $product->item_id ?>">
                    <input type="hidden" name="buyer_id" class="buyer_id" value="<?php echo $data['buyer_id']; ?>">
                    <input type="hidden" name="pmaxAmount" class="pmaxAmount" value="<?php echo $product->amount ?>">

                    <!--     <a href="#" class="add-cart-btn" name="addTocart">Add to cart</a>-->
                    <button class="btn btn-info btn-block addItemBtn add-cart-btn" name="addTocart"><i class="fas fa-cart-plus">
                      </i>&nbsp;&nbsp;Add tocart</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>

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

  <script src="<?php echo URLROOT; ?>/public/javascript/homePage.js"></script>

  <script src="<?php echo URLROOT; ?>/public/javascript/popupFormValidation.js"></script>

</html>