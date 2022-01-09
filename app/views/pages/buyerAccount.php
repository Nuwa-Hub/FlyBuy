<!DOCTYPE html5>
<html lang="en">

<head>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FlyBuy | Home</title>
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/style_buyerAccount.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/styles_popup.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>


<header id="header">
  <a href="<?php echo URLROOT; ?>/PageController/home" class="logo">FlyBuy</a>
  <img src="<?php echo URLROOT; ?>/public/img/logo.png" id="flybuy-logo" style="width:65px;height:65px;position:fixed;left:210px;">

  <div class="search-box">
    <input class="search-txt" id="pinput" type="text" name="" placeholder="Search for products" onkeyup="searchElement()">
    <a class="search-btn" href="#">
      <i class="fas fa-search"></i>
    </a>
  </div>
  <ul>
    <li><a href="<?php echo URLROOT; ?>/PageController/buyerAccount/<?php echo $data['user']->buy_id; ?>" class="active">Home</a></li>
    <li><a href='<?php echo URLROOT; ?>/PageController/shoppingCart/<?php echo $data['user']->buy_id; ?>'><i class="fas fa-cart-plus"><span id="cart-item" class="badge badge-danger"><?php echo sizeof($_SESSION['cartarr']); ?></span></i></a> </li>
    <li><a href="<?php echo URLROOT; ?>/PageController/buyerInfo/<?php echo $data['user']->buy_id; ?>">Account</a></li>
    <li><a href="<?php echo URLROOT; ?>/PageController/aboutUs">About us</a></li>
    <li><a onclick="toggleLogout()" class="logout">Logout</a></li>
  </ul>
</header>

<section>
  <div id="snow"></div>
  <h2 id="text"><span>Welcome to</span><br>FlyBuy</h2>
  <img src="<?php echo URLROOT ?>/public/img/item1.png" id="item1">
  <a href="#products" id='btn'>Explore</a>

  <img src="<?php echo URLROOT ?>/public/img/item2.png" id="item2">
</section>

<div class="slidediv">
  <!-- slideshow start -->
  <div class="slider">
    <div class="slides">
      <!-- radio buttons start -->
      <input type="radio" name="radio-btn" id="radio1">
      <input type="radio" name="radio-btn" id="radio2">
      <input type="radio" name="radio-btn" id="radio3">
      <input type="radio" name="radio-btn" id="radio4">
      <!-- radio buttons end -->
      <!-- slide images start -->
      <div class="slide first">
        <img src="<?php echo URLROOT; ?>/public/img/slideshow/1.jpg" alt="" style="width:1000px;height:500px;">
      </div>
      <div class="slide">
        <img src="<?php echo URLROOT; ?>/public/img/slideshow/2.jpg" alt="" style="width:1000px;height:500px;">
      </div>
      <div class="slide">
        <img src="<?php echo URLROOT; ?>/public/img/slideshow/3.jpg" alt="" style="width:1000px;height:500px;">
      </div>
      <div class="slide">
        <img src="<?php echo URLROOT; ?>/public/img/slideshow/4.jpg" alt="" style="width:1000px;height:500px;">
      </div>
      <!-- slide images end -->
      <!-- automatic navigation start -->
      <div class="navigation-auto">
        <div class="auto-btn1"></div>
        <div class="auto-btn2"></div>
        <div class="auto-btn3"></div>
        <div class="auto-btn4"></div>
      </div>
      <!-- automatic navigation end -->
    </div>
    <!-- manual navigation start -->
    <div class="navigation-manual">
      <label for="radio1" class="manual-btn"></label>
      <label for="radio2" class="manual-btn"></label>
      <label for="radio3" class="manual-btn"></label>
      <label for="radio4" class="manual-btn"></label>
    </div>
    <!-- manual navigation end -->
  </div>
  <!-- slideshow end -->
  <div class="slidewords">
    <h2 id="txt"><span style="font-family:Segoe UI;text-shadow: 0 0 3px black, 0 0 10px #ffff00;">SHOP</span></h2>
    <h2 id="txt"><span style="font-family:Segoe UI;text-shadow: 0 0 3px black, 0 0 10px #ffff00;">FOR</span></h2>
    <h2 id="txt"><span style="font-family:Segoe UI;text-shadow: 0 0 3px black, 0 0 10px #ffff00;">YOUR</span></h2>
    <h2 id="txt"><span style="font-family:Segoe UI;text-shadow: 0 0 3px black, 0 0 10px #ffff00;">GROCERIES</span></h2>
  </div>
</div>

<div class="sec" id="products">
  <h2 style="color:white;">Featured products</h2>
  <div class="container">

    <?php foreach ($data['products'] as $product) : ?>


      <div class="product">
        <div class="product-card">
          <h3 class="name"><?php echo $product->itemName; ?></h3>
          <span class="price"><?php echo "Rs. " . $product->price; ?></span>
          <a class="popup-btn">View item</a>
          <img src="<?php echo URLROOT ?>/public/img/uploads/itemImages/<?php echo $product->item_image ?>" class="product-img" alt="">
        </div>
        <div class="popup-view">
          <form method="post" action="<?php echo URLROOT; ?>/ProductController/addToCart">
            <div class="popup-card">
              <a><i class="fas fa-times close-btn"></i></a>
              <div class="product-img">
                <img src="<?php echo URLROOT ?>/public/img/uploads/itemImages/<?php echo $product->item_image ?>" alt="">
              </div>
              <div class="info">
                <h2><?php echo $product->itemName; ?><br><span><?php echo $product->seller->storeName; ?></span></h2>
                <h3>
                  <span class="stars"><?php echo $product->seller->rating; ?></span>
                  <span><?php echo $product->seller->rating; ?></span>
                  <a class="popup-rate">Rate seller</a>

                  <!--Popup window to Rate end-->
                  <div class="container-new">
                    <div class="feedback">
                      <div class="rating">
                        <input type="radio" class="rating-5" onclick="rate(5,<?php echo $product->seller->seller_id; ?>)" name="rating" id="<?php echo "rating-5".$product->item_id; ?>">
                        <label for="<?php echo "rating-5".$product->item_id; ?>"></label>
                        <input type="radio" class="rating-4" onclick="rate(4,<?php echo $product->seller->seller_id; ?>)" name="rating" id="<?php echo "rating-4".$product->item_id; ?>">
                        <label for="<?php echo "rating-4".$product->item_id; ?>"></label>
                        <input type="radio" class="rating-3" onclick="rate(3,<?php echo $product->seller->seller_id; ?>)" name="rating" id="<?php echo "rating-3".$product->item_id; ?>">
                        <label for="<?php echo "rating-3".$product->item_id; ?>"></label>
                        <input type="radio" class="rating-2" onclick="rate(2,<?php echo $product->seller->seller_id; ?>)" name="rating" id="<?php echo "rating-2".$product->item_id; ?>">
                        <label for="<?php echo "rating-2".$product->item_id; ?>"></label>
                        <input type="radio" class="rating-1" onclick="rate(1,<?php echo $product->seller->seller_id; ?>)" name="rating" id="<?php echo "rating-1".$product->item_id; ?>">
                        <label for="<?php echo "rating-1".$product->item_id; ?>"></label>
                        <div class="emoji-wrapper">
                          <div class="emoji">
                            <svg class="rating-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                            <path d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z" fill="#f4c534"/>
                            <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318" cy="199.829" rx="56.146" ry="56.13" fill="#fff"/>
                            <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822" rx="28.048" ry="28.08" fill="#3e4347"/>
                            <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993" rx="8.016" ry="5.296" fill="#5a5f63"/>
                            <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695" cy="199.819" rx="56.146" ry="56.13" fill="#fff"/>
                            <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84" rx="28.048" ry="28.08" fill="#3e4347"/>
                            <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794" cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63"/>
                            <path d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z" fill="#3e4347"/>
                          </svg>
                            <svg class="rating-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                            <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                            <path d="M328.4 428a92.8 92.8 0 0 0-145-.1 6.8 6.8 0 0 1-12-5.8 86.6 86.6 0 0 1 84.5-69 86.6 86.6 0 0 1 84.7 69.8c1.3 6.9-7.7 10.6-12.2 5.1z" fill="#3e4347"/>
                            <path d="M269.2 222.3c5.3 62.8 52 113.9 104.8 113.9 52.3 0 90.8-51.1 85.6-113.9-2-25-10.8-47.9-23.7-66.7-4.1-6.1-12.2-8-18.5-4.2a111.8 111.8 0 0 1-60.1 16.2c-22.8 0-42.1-5.6-57.8-14.8-6.8-4-15.4-1.5-18.9 5.4-9 18.2-13.2 40.3-11.4 64.1z" fill="#f4c534"/>
                            <path d="M357 189.5c25.8 0 47-7.1 63.7-18.7 10 14.6 17 32.1 18.7 51.6 4 49.6-26.1 89.7-67.5 89.7-41.6 0-78.4-40.1-82.5-89.7A95 95 0 0 1 298 174c16 9.7 35.6 15.5 59 15.5z" fill="#fff"/>
                            <path d="M396.2 246.1a38.5 38.5 0 0 1-38.7 38.6 38.5 38.5 0 0 1-38.6-38.6 38.6 38.6 0 1 1 77.3 0z" fill="#3e4347"/>
                            <path d="M380.4 241.1c-3.2 3.2-9.9 1.7-14.9-3.2-4.8-4.8-6.2-11.5-3-14.7 3.3-3.4 10-2 14.9 2.9 4.9 5 6.4 11.7 3 15z" fill="#fff"/>
                            <path d="M242.8 222.3c-5.3 62.8-52 113.9-104.8 113.9-52.3 0-90.8-51.1-85.6-113.9 2-25 10.8-47.9 23.7-66.7 4.1-6.1 12.2-8 18.5-4.2 16.2 10.1 36.2 16.2 60.1 16.2 22.8 0 42.1-5.6 57.8-14.8 6.8-4 15.4-1.5 18.9 5.4 9 18.2 13.2 40.3 11.4 64.1z" fill="#f4c534"/>
                            <path d="M155 189.5c-25.8 0-47-7.1-63.7-18.7-10 14.6-17 32.1-18.7 51.6-4 49.6 26.1 89.7 67.5 89.7 41.6 0 78.4-40.1 82.5-89.7A95 95 0 0 0 214 174c-16 9.7-35.6 15.5-59 15.5z" fill="#fff"/>
                            <path d="M115.8 246.1a38.5 38.5 0 0 0 38.7 38.6 38.5 38.5 0 0 0 38.6-38.6 38.6 38.6 0 1 0-77.3 0z" fill="#3e4347"/>
                            <path d="M131.6 241.1c3.2 3.2 9.9 1.7 14.9-3.2 4.8-4.8 6.2-11.5 3-14.7-3.3-3.4-10-2-14.9 2.9-4.9 5-6.4 11.7-3 15z" fill="#fff"/>
                          </svg>
                            <svg class="rating-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                            <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                            <path d="M336.6 403.2c-6.5 8-16 10-25.5 5.2a117.6 117.6 0 0 0-110.2 0c-9.4 4.9-19 3.3-25.6-4.6-6.5-7.7-4.7-21.1 8.4-28 45.1-24 99.5-24 144.6 0 13 7 14.8 19.7 8.3 27.4z" fill="#3e4347"/>
                            <path d="M276.6 244.3a79.3 79.3 0 1 1 158.8 0 79.5 79.5 0 1 1-158.8 0z" fill="#fff"/>
                            <circle cx="340" cy="260.4" r="36.2" fill="#3e4347"/>
                            <g fill="#fff">
                              <ellipse transform="rotate(-135 326.4 246.6)" cx="326.4" cy="246.6" rx="6.5" ry="10"/>
                              <path d="M231.9 244.3a79.3 79.3 0 1 0-158.8 0 79.5 79.5 0 1 0 158.8 0z"/>
                            </g>
                            <circle cx="168.5" cy="260.4" r="36.2" fill="#3e4347"/>
                            <ellipse transform="rotate(-135 182.1 246.7)" cx="182.1" cy="246.7" rx="10" ry="6.5" fill="#fff"/>
                          </svg>
                            <svg class="rating-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                      <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                      <path d="M407.7 352.8a163.9 163.9 0 0 1-303.5 0c-2.3-5.5 1.5-12 7.5-13.2a780.8 780.8 0 0 1 288.4 0c6 1.2 9.9 7.7 7.6 13.2z" fill="#3e4347"/>
                      <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                      <g fill="#fff">
                        <path d="M115.3 339c18.2 29.6 75.1 32.8 143.1 32.8 67.1 0 124.2-3.2 143.2-31.6l-1.5-.6a780.6 780.6 0 0 0-284.8-.6z"/>
                        <ellipse cx="356.4" cy="205.3" rx="81.1" ry="81"/>
                      </g>
                      <ellipse cx="356.4" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
                      <g fill="#fff">
                        <ellipse transform="scale(-1) rotate(45 454 -906)" cx="375.3" cy="188.1" rx="12" ry="8.1"/>
                        <ellipse cx="155.6" cy="205.3" rx="81.1" ry="81"/>
                      </g>
                      <ellipse cx="155.6" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
                      <ellipse transform="scale(-1) rotate(45 454 -421.3)" cx="174.5" cy="188" rx="12" ry="8.1" fill="#fff"/>
                    </svg>
                            <svg class="rating-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                            <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                            <path d="M232.3 201.3c0 49.2-74.3 94.2-74.3 94.2s-74.4-45-74.4-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
                            <path d="M96.1 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2C80.2 229.8 95.6 175.2 96 173.3z" fill="#d03f3f"/>
                            <path d="M215.2 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
                            <path d="M428.4 201.3c0 49.2-74.4 94.2-74.4 94.2s-74.3-45-74.3-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
                            <path d="M292.2 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2-77.8-65.7-62.4-120.3-61.9-122.2z" fill="#d03f3f"/>
                            <path d="M411.3 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
                            <path d="M381.7 374.1c-30.2 35.9-75.3 64.4-125.7 64.4s-95.4-28.5-125.8-64.2a17.6 17.6 0 0 1 16.5-28.7 627.7 627.7 0 0 0 218.7-.1c16.2-2.7 27 16.1 16.3 28.6z" fill="#3e4347"/>
                            <path d="M256 438.5c25.7 0 50-7.5 71.7-19.5-9-33.7-40.7-43.3-62.6-31.7-29.7 15.8-62.8-4.7-75.6 34.3 20.3 10.4 42.8 17 66.5 17z" fill="#e24b4b"/>
                          </svg>
                            <svg class="rating-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <g fill="#ffd93b">
                              <circle cx="256" cy="256" r="256"/>
                              <path d="M512 256A256 256 0 0 1 56.8 416.7a256 256 0 0 0 360-360c58 47 95.2 118.8 95.2 199.3z"/>
                            </g>
                            <path d="M512 99.4v165.1c0 11-8.9 19.9-19.7 19.9h-187c-13 0-23.5-10.5-23.5-23.5v-21.3c0-12.9-8.9-24.8-21.6-26.7-16.2-2.5-30 10-30 25.5V261c0 13-10.5 23.5-23.5 23.5h-187A19.7 19.7 0 0 1 0 264.7V99.4c0-10.9 8.8-19.7 19.7-19.7h472.6c10.8 0 19.7 8.7 19.7 19.7z" fill="#e9eff4"/>
                            <path d="M204.6 138v88.2a23 23 0 0 1-23 23H58.2a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#45cbea"/>
                            <path d="M476.9 138v88.2a23 23 0 0 1-23 23H330.3a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#e84d88"/>
                            <g fill="#38c0dc">
                              <path d="M95.2 114.9l-60 60v15.2l75.2-75.2zM123.3 114.9L35.1 203v23.2c0 1.8.3 3.7.7 5.4l116.8-116.7h-29.3z"/>
                            </g>
                            <g fill="#d23f77">
                              <path d="M373.3 114.9l-66 66V196l81.3-81.2zM401.5 114.9l-94.1 94v17.3c0 3.5.8 6.8 2.2 9.8l121.1-121.1h-29.2z"/>
                            </g>
                            <path d="M329.5 395.2c0 44.7-33 81-73.4 81-40.7 0-73.5-36.3-73.5-81s32.8-81 73.5-81c40.5 0 73.4 36.3 73.4 81z" fill="#3e4347"/>
                            <path d="M256 476.2a70 70 0 0 0 53.3-25.5 34.6 34.6 0 0 0-58-25 34.4 34.4 0 0 0-47.8 26 69.9 69.9 0 0 0 52.6 24.5z" fill="#e24b4b"/>
                            <path d="M290.3 434.8c-1 3.4-5.8 5.2-11 3.9s-8.4-5.1-7.4-8.7c.8-3.3 5.7-5 10.7-3.8 5.1 1.4 8.5 5.3 7.7 8.6z" fill="#fff" opacity=".2"/>
                          </svg>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <!--Popup window to Rate end-->

                </h3>
                <p><?php echo $product->description; ?></p>
                <span class="price"><?php echo "Rs. " . $product->price . "/unit"; ?></span>
                <span class="quantity">Quantity :</span>
                <input type="number" name="pqty" class="pqty" value="1" id="quantity" name="quantity" min="1" max="<?php echo $product->amount; ?>">

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

<!--Popup window to confirm logout-->

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

</body>



<script src="<?php echo URLROOT; ?>/public/javascript/popupFormValidation.js"></script>

<script src="<?php echo URLROOT; ?>/public/javascript/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>


<script src="<?php echo URLROOT; ?>/public/javascript/homePage.js"></script>
<script src="<?php echo URLROOT; ?>/public/javascript/slideshow.js"></script>
<!-- <script src="<?php echo URLROOT ?>/public/javaScript/shoppingCart.js"></script> -->
<script src="<?php echo URLROOT; ?>/public/javascript/star.js"></script>

</html>