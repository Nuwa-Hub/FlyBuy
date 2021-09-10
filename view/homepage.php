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
}

?>

<!DOCTYPE html5>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project cosmos</title>
    <link rel="stylesheet" href="../css/style-home.css">
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
          <li><a href="#products">Products</a></li>
          <li><a href="#">Login</a></li>
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
      <h2>ADD Products Below Machanla</h2>
      <p>How does e-commerce work?
E-commerce is powered by the internet, where customers can access an online store to browse through, and place orders for products or services via their own devices.<br>

As the order is placed, the customer's web browser will communicate back and forth with the server hosting the online store website. <br>Data pertaining to the order will then be relayed to a central computer known as the order manager -- then forwarded to databases that manage inventory levels, a merchant system that manages payment information (using applications such as PayPal), and a bank computer -- before circling back to the order manager. This is to make sure that store inventory and customer funds are sufficient for the order to be processed.<br><br> After the order is validated, the order manager will notify the store's web server, which will then display a message notifying the customer that their order has been successfully processed. The order manager will then send order data to the warehouse or fulfillment department, in order for the product or service to be successfully dispatched to the customer. <br><br>At this point tangible and/or digital products may be shipped to a customer, or access to a service may be granted.<br>

Platforms that host e-commerce transactions may include online marketplaces that sellers simply sign up for, such as Amazon.com;<br> software as a service (SaaS) tools that allow customers to 'rent' online store infrastructures; or open source tools for companies to use in-house development to manage.<br>

Types of e-commerce
Business-to-business (B2B) e-commerce refers to the electronic exchange of products, services or information between businesses rather than between businesses and consumers.<br> Examples include online directories and product and supply exchange websites that allow businesses to search for products, services and information and to initiate transactions through e-procurement interfaces.<br>

In 2017, Forrester Research predicted that the B2B e-commerce market will top $1.1 trillion in the U.S. by 2021, accounting for 13% of all B2B sales in the nation.<br>

Business-to-consumer (B2C) is the retail part of e-commerce on the internet. It is when businesses sell products, services or information directly to consumers. The term was popular during the dot-com boom of the late 1990s, when online retailers and sellers of goods were a novelty.<br><br>
E-commerce is powered by the internet, where customers can access an online store to browse through, and place orders for products or services via their own devices.<br>

As the order is placed, the customer's web browser will communicate back and forth with the server hosting the online store website. <br>Data pertaining to the order will then be relayed to a central computer known as the order manager -- then forwarded to databases that manage inventory levels, a merchant system that manages payment information (using applications such as PayPal), and a bank computer -- before circling back to the order manager. This is to make sure that store inventory and customer funds are sufficient for the order to be processed.<br><br> After the order is validated, the order manager will notify the store's web server, which will then display a message notifying the customer that their order has been successfully processed. The order manager will then send order data to the warehouse or fulfillment department, in order for the product or service to be successfully dispatched to the customer. <br><br>At this point tangible and/or digital products may be shipped to a customer, or access to a service may be granted.<br>

Platforms that host e-commerce transactions may include online marketplaces that sellers simply sign up for, such as Amazon.com;<br> software as a service (SaaS) tools that allow customers to 'rent' online store infrastructures; or open source tools for companies to use in-house development to manage.<br>

Types of e-commerce
Business-to-business (B2B) e-commerce refers to the electronic exchange of products, services or information between businesses rather than between businesses and consumers.<br> Examples include online directories and product and supply exchange websites that allow businesses to search for products, services and information and to initiate transactions through e-procurement interfaces.<br>

In 2017, Forrester Research predicted that the B2B e-commerce market will top $1.1 trillion in the U.S. by 2021, accounting for 13% of all B2B sales in the nation.<br>

Business-to-consumer (B2C) is the retail part of e-commerce on the internet. It is when businesses sell products, services or information directly to consumers. The term was popular during the dot-com boom of the late 1990s, when online retailers and sellers of goods were a novelty.<br><br>

Today, there are innumerable virtual stores and malls on the internet selling all types of consumer goods. The most recognized example of these sites is Amazon, which dominates the B2C market.</p>


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
      })</script>
  </body>
</html>