<?php

include '../models/buyer.php';
include '../models/seller.php';
include '../database/db_connection.php';

require('../validators/user_validator.php');

if(!isset($_COOKIE['user_login'])){      //if the cookie is not set redirect -> loginSignup
  header('Location: loginSignup.php');
}
else{
  $curr_email = $_COOKIE['user_login'];  //logged in user email
  $user  = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM buyers WHERE email = '$curr_email' LIMIT 1"), MYSQLI_ASSOC)[0];

  $products = mysqli_fetch_all( mysqli_query($conn, "SELECT * FROM  products"), MYSQLI_ASSOC);
}

?>

<!DOCTYPE html5>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project cosmos</title>
     <link rel="stylesheet" href="../css/style-home.css"> 
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
          <li><a href="#">Login/Sign up</a></li>
          <li><a href="#"><i class="fas fa-cart-plus"></i></a>
          </li>
      </ul>
  </header>
  <section>
      <h2 id="text"><span>Welcome to</span><br>FlyBuy</h2>
      <img src="../images/item1.png" id="item1">
      <a href="#products" id='btn'>Explore</a>

      <img src="../images/item2.png" id="item2">
  </section>
  <div class="sec" id="products">
      <h2>Featured products</h2>
      <div class="container">
        <?php foreach ($products as $product): ?>
        <div class="product">
          <div class="product-card">
            <h3 class="name"><?php echo $product['itemName']; ?></h3>
            <span class="price"><?php echo "Rs. ".$product['price']; ?></span>
            <a class="popup-btn">View item</a>
            <img src="../images/Kottu mee.png" class="product-img" alt="">
          </div>
          <div class="popup-view">
            <div class="popup-card">
              <a><i class="fas fa-times close-btn"></i></a>
              <div class="product-img">
                <img src="../images/kottu mee.png" alt="">
              </div>
            <div class="info">
              <h2><?php echo $product['itemName']; ?><br><span>Chandrasena stores</span></h2>
              <h3><span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span></h3>
              <p><?php echo $product['description']; ?></p>
              <span class="price"><?php echo "Rs. ".$product['price']."/unit"; ?></span>
              <span class="quantity">Quantity :</span>
              <input type="number" value="1" id="quantity" name="quantity" min="1" max="10">
              <a href="#" class="add-cart-btn">Add to cart</a>
            </div>
          </div>
          </div>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
  <script type="text/javascript">

      let text = document.getElementById('text');
      let btn = document.getElementById('btn');
      let item2 = document.getElementById('item2');
      let item1 = document.getElementById('item1');
     window.addEventListener('scroll',function(){
          var header = document.querySelector("header");
          header.classList.toggle("sticky",window.scrollY>0);

          let value = window.scrollY;
          text.style.top=50+value* -0.5 + '%';
          btn.style.marginTop=value* 1.5 + 'px';
          item2.style.top=value* -0.12 + 'px';
          item1.style.top=value* 0.25 + 'px';
      })

      var popupViews=document.querySelectorAll('.popup-view');
      var popupBtns=document.querySelectorAll('.popup-btn');
      var closeBtns=document.querySelectorAll('.close-btn');

      var popup = function(popupClick){
        popupViews[popupClick].classList.add('active');

        document.body.style.overflowY = 'hidden';
      }

      popupBtns.forEach((popupBtn,i)=>{
        popupBtn.addEventListener("click",()=>{
        popup(i)
      });
    });

      closeBtns.forEach((closeBtn)=>{
        closeBtn.addEventListener("click",()=>{
          popupViews.forEach((popupView)=>{
            popupView.classList.remove('active');

            document.body.style.overflowY='';
          });
        });
      });


      </script>
  </body>
</html>
