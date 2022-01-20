<!DOCTYPE html5>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FlyBuy | Home</title>
	<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/styles_homepage.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>

<body>

	<header id="header">

		<a href="<?php echo URLROOT; ?>/PageController/home" class="logo">FlyBuy
		<img src="<?php echo URLROOT; ?>/public/img/logo.svg" id="flybuy-logo" style="width:65px;height:65px;position:absolute;margin-left:10px"></a>


		<div class="search-box">
		<input class="search-txt" id="pinput" type="text" name="" placeholder="Search for products" onkeyup="searchElement()">
			<a class="search-btn" href="#">
				<i class="fas fa-search"></i>
			</a>
		</div>

		<ul>
			<li><a href="#" class="active">Home</a></li>
			<li><a href="<?php echo URLROOT; ?>/PageController/loginSignup">Login/Sign up</a></li>
			<li><a href="<?php echo URLROOT; ?>/PageController/homeaboutUs">About us</a></li>
		</ul>

	</header>
		<section>
			<div id="snow"></div>
			<h2 id="text"><span stye="text-shadow: 0 0 3px black, 0 0 10px aqua;color:aqua;">Welcome to</span><br>FlyBuy</h2>
			<img src="<?php echo URLROOT; ?>/public/img/item1.png" id="item1">
			<a href="#products" id='btn'>Explore</a>
			<img src="<?php echo URLROOT; ?>/public/img/item2.png" id="item2">
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
			<h2 style="color:white;">See what we have for you</h2>

			<div class="container" >

				<?php foreach ($data['products'] as $product) : ?>
					<div class="product">

						<div class="product-card">
							<h3 class="name"><?php echo $product->itemName; ?></h3>
							<span class="price"><?php echo "Rs. " . $product->price; ?></span>
							<a class="popup-btn">View item</a>
							<img src="<?php echo URLROOT; ?>/public/img/uploads/itemImages/<?php echo $product->item_image?>" class="product-img" alt="">
						</div>

						<div class="popup-view">

							<form method="post" action="">
								<div class="popup-card">
									<a><i class="fas fa-times close-btn"></i></a>
									<div class="product-img">
										<img src="<?php echo URLROOT; ?>/public/img/uploads/itemImages/<?php echo $product->item_image?>" alt="">
									</div>
									<div class="info">
										<h2><?php echo $product->itemName; ?><br><span><?php echo $product->seller->storeName; ?></span></h2>
										<h3>
											<span class="stars"><?php echo $product->seller->rating; ?></span>
											<span><?php echo $product->seller->rating; ?></span>
										</h3>
										<p><?php echo $product->description; ?></p>
										<span class="price"><?php echo "Rs. " . $product->price . "/unit"; ?></span>
									</div>
								</div>
							</form>

						</div>

					</div>
				<?php endforeach; ?>

			</div>

		</div>
		<footer id="footer">
		<div class="blocks">
			<div class="logo">powered by<br>
			<img src="<?php echo URLROOT; ?>/public/img/cosmos.png" id="cosmos" style="width:200px;position:absolute;margin-left:10px"><br><br><br><br><br>
			<span class="copyright">&copy; FlyBuy.All Rights Reserved.</span>
			</div>
			<div class="app">Download our app<br>
			<img src="<?php echo URLROOT; ?>/public/img/footer/playstore.svg" id="icons" style="width:120px;position:absolute;margin-left:40px;margin-top:20px;cursor:pointer;">
			<img src="<?php echo URLROOT; ?>/public/img/footer/iphone.svg" id="icons" style="width:120px;position:absolute;margin-left:40px;margin-top:75px;cursor:pointer;">
		</div>
			<div class="follow">Follow us<br>
			<img src="<?php echo URLROOT; ?>/public/img/footer/fb.svg" style="width:40px;position:absolute;margin-left:10px;margin-top:20px;cursor:pointer;">
			<img src="<?php echo URLROOT; ?>/public/img/footer/insta.svg" style="width:40px;position:absolute;margin-left:70px;margin-top:20px;cursor:pointer;">
			<img src="<?php echo URLROOT; ?>/public/img/footer/twitter.svg" style="width:40px;position:absolute;margin-left:130px;margin-top:20px;cursor:pointer;">
			</div>
			<div class="contact">Contact us
			<div class="info">
			<br>
			<i class="fas fa-phone" style="font-size:18px;color:#b3b3b3;"><span style="font-family:poppins;font-weight:400;color:#b3b3b3;"> 070 4915685</span></i><br>
			<i class="fas fa-envelope" style="font-size:18px;color:#b3b3b3;margin-top:15px;"><span style="font-family:poppins;font-weight:400;color:#b3b3b3;"> Flybuy19cse@gmail.com</span></i></div>
			</div>
		</div>

</footer>
</body>

	<script src="<?php echo URLROOT; ?>/public/javascript/jquery.min.js"></script>
	<!-- put every jquery script under this script -->


	<script src="<?php echo URLROOT; ?>/public/javascript/homePage.js"></script>
	<script src="<?php echo URLROOT; ?>/public/javascript/star.js"></script>

	<script src="<?php echo URLROOT; ?>/public/javascript/slideshow.js"></script>



</html>
