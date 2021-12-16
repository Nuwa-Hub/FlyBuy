<!DOCTYPE html5>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FlyBuy | Home</title>
	<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/styles_homepage.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link 
		rel="stylesheet" 
		href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" 
		integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" 
		crossorigin="anonymous">
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
		<li><a href="<?php echo URLROOT; ?>/PageController/loginSignup">Login/Sign up</a></li>
	</ul>

	</header>

	<section>
		<h2 id="text"><span>Welcome to</span><br>FlyBuy</h2>
		<img src="<?php echo URLROOT; ?>/public/img/item1.png" id="item1">
		<a href="#products" id='btn'>Explore</a>
		<img src="<?php echo URLROOT; ?>/public/img/item2.png" id="item2">
	</section>

	<div class="sec" id="products">
		<h2>See what we have for you</h2>

		<div class="container">

			<?php foreach ($data['products'] as $product) : ?>
				<div class="product">

					<div class="product-card">
						<h3 class="name"><?php echo $product->itemName; ?></h3>
						<span class="price"><?php echo "Rs. " . $product->price; ?></span>
						<a class="popup-btn">View item</a>
						<img src="<?php echo URLROOT; ?>/public/img/kottu_mee.png" class="product-img" alt="">
					</div>

					<div class="popup-view">

						<form method="post" action="">
							<div class="popup-card">
								<a><i class="fas fa-times close-btn"></i></a>
								<div class="product-img">
									<img src="<?php echo URLROOT; ?>/public/img/kottu_mee.png" alt="">
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

	<script src="<?php echo URLROOT; ?>/public/javascript/homePage.js"></script>
	<script src="<?php echo URLROOT; ?>/public/javascript/jquery.min.js"></script>
	<script src="<?php echo URLROOT; ?>/public/javascript/star.js"></script>

</body>

</html>