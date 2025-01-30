<?php
session_start();

if(!isset($_SESSION['uid'])){
	header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/2d7d554efc.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.6-dist/css/bootstrap.css">
	<link rel="stylesheet" href="style.css">
	<link href="img/logo.png" rel="icon">
	<title>World Toys</title>
</head>

<body>
	<section id="headre">
		<a href="index.php"><img src="img/logo.png" class="logo" alt=""></a>
		<div id="navbar">
			<li><a class="active" href="index.php">Home</a></li>
			<li><a href="shop.php">Shop</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="contact.php">Contact</a></li>
			<li id="ld-bag"><a href="cart.php"><i class="fa-regular fas fa-bag-shopping"></i></a></li>
			<a href="#" id="close"><i class="far fa-times"></i></a>
			<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Logged in as <?php echo $_SESSION['uname']; ?></a>
				<ul class="dropdown-menu">
					<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart-large"></span>Cart</a></li>
					<li><a href="change_password.php">Change Password</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</div>
		<div id="mobile">
			<a href="cart.php"><i class="fa-regular fa-bag-shopping"></i></a>
			<i id="bar" class="fsa fa-outdent"></i>
		</div>
	</section>
	<section id="hero">
		<h4>Safe and Suitable Toys for All Ages & Genders</h4>
		<h2>Super Value Deals</h2>
		<h1>On All Toys</h1>
		<p>Save Up to 70% Off!</p>
		<a href="shop.php">
			<button>Shop Now</button>
		</a>
	</section>
	<section id="product1" class="section-p1">
		<h2>Featured Products</h2>
		<p>New Collection of Modern Toys</p>
		<div class="pro-container">
			<?php
				include('dbconnect.php');
				$limit = 8;
				$product_query = "SELECT * FROM products WHERE product_keywords = 'FeaturedProducts' LIMIT $limit";
				$run_query = mysqli_query($conn, $product_query);
				if(mysqli_num_rows($run_query)) {
					while($row = mysqli_fetch_array($run_query)) {
						$pro_id = $row['product_id'];
						$product_name = $row['product_name'];
						$product_title = $row['product_title'];
						$price = $row['product_price'];
						$img = $row['product_image'];
						echo "<div class='pro' onclick='window.location.href='sproduct.php';'>
						<img src='img/FeaturedProduct/$img' alt=''>
						<div class='des'>
							<span>$product_name</span>
							<h5>$product_title</h5>
							<div class='star'>
								<i class='fas fa-star'></i>
								<i class='fas fa-star'></i>
								<i class='fas fa-star'></i>
								<i class='fas fa-star'></i>
								<i class='fas fa-star'></i>
							</div>
							<h4>$price JD</h4>
						</div>";
						?> 
						<a href="sproduct.php?proId=<?php echo $pro_id;?>"><i class='cart'><img
							src='assets/images/shopping-cart1.png' style='width: 24px;'></i></a>
						</div> 
						<?php
					}
				}
			?> 
		</div>
	</section>
	<section id="banner" class="section-m1">
		<h4>Create Delight</h4>
		<h2>Your Support Brings Happiness</h2>
		<a href="donation.php"><button class="normal">Explore More</button></a>
	</section>
	<section id="product1" class="section-p1">
		<h2>New Arrivals</h2>
		<div class="pro-container">
			<?php
				include('dbconnect.php');
				$limit = 8;
				$product_query = "SELECT * FROM products WHERE product_keywords = 'newProduct' LIMIT $limit";
				$run_query = mysqli_query($conn, $product_query);
				if(mysqli_num_rows($run_query)) {
					while($row = mysqli_fetch_array($run_query)) {
						$pro_id = $row['product_id'];
						$product_name = $row['product_name'];
						$product_title = $row['product_title'];
						$price = $row['product_price'];
						$img = $row['product_image'];
						echo "<div class='pro' onclick='window.location.href='sproduct.php';'>
						<img src='img/newProduct/$img' alt=''>
						<div class='des'>
							<span>$product_name</span>
							<h5>$product_title</h5>
							<div class='star'>
								<i class='fas fa-star'></i>
								<i class='fas fa-star'></i>
								<i class='fas fa-star'></i>
								<i class='fas fa-star'></i>
								<i class='fas fa-star'></i>
							</div>
							<h4>$price JD</h4>
						</div>";
						?> 
						<a href="sproduct.php?proId=<?php echo $pro_id;?>"><i class='cart'><img
							src='assets/images/shopping-cart1.png' style='width: 24px;'></i></a>
						</div> 
						<?php
					}
				}
			?> 
		</div>
	</section>
	<section id="banner3">
		<div class="banner-box"></div>
		<div class="banner-box banner-box2"></div>
		<div class="banner-box banner-box3"></div>
	</section>
	<hr size="10" color="#088178">
	<footer class="section-p1">
		<div class="col">
			<img class="logo" src="img/logo.png" alt="">
			<h4>Contact</h4>
			<p><strong>Address: </strong> Al-Mafraq</p>
			<p><strong>Hours: </strong> 8:30 - 14:30 (Sunday to Thursday)</p>
			<div class="Follow">
				<h4>Follow Us</h4>
				<div class="icon">
					<a href="https://www.facebook.com/aabuniversity"><i class="fa-brands fa-facebook"></i></a>
					<a href="https://x.com/aabuniversity"><i class="fa-brands fa-twitter"></i></a>
					<a href="https://www.instagram.com/aabuniversity"><i class="fa-brands fa-instagram"></i></a>
				</div>
			</div>
		</div>
		<div class="col">
			<h4>About</h4>
			<a href="about.php">About Us</a>
			<a href="contact.php">Contact Us</a>
		</div>
		<div class="col">
			<h4>My Account</h4>
			<?php if(isset($_SESSION['uid'])) { ?> 
				<a href="#">Sign In</a> 
			<?php } else { ?> 
				<a href="customer_login.php">Sign In</a> 
			<?php } ?> 
			<a href="cart.php">View Cart</a>
		</div>
		<div class="col install">
			<div class="row"></div>
		</div>
	</footer>
	<div class="copyright">
		<p>&copy; 2024 All rights reserved by AABU University students.</p>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="assets/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
	<script src="script.js"></script>
</body>
</html>
