<?php
session_start();

if (isset($_SESSION['uid'])) {
	header('location:profile.php');
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
	<?php include('includes/header.php'); ?>
	<section id="hero">
		<h4>Safe and suitable toys for children of all ages and genders</h4>
		<h2>Super Value Deals</h2>
		<h1>On All Toys</h1>
		<p>Save up to 70% off!</p>
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
				if (mysqli_num_rows($run_query)) {
					while ($row = mysqli_fetch_array($run_query)) {
						$pro_id = $row['product_id'];
						$product_name = $row['product_name'];
						$product_title = $row['product_title'];
						$price = $row['product_price'];
						$img = $row['product_image'];
						echo "<div class='pro' onclick='window.location.href=\"sproduct.php\";'>
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
								</div>
								<a href='sproduct.php?proId=$pro_id'>
									<i class='cart'>
										<img src='assets/images/shopping-cart1.png' style='width: 24px;'>
									</i>
								</a>
							</div>";
					}
				}
			?>
		</div>
	</section>
	<section id="product1" class="section-p1">
		<h2>New Arrivals</h2>
		<div class="pro-container">
			<?php
				$product_query = "SELECT * FROM products WHERE product_keywords = 'newProduct' LIMIT $limit";
				$run_query = mysqli_query($conn, $product_query);
				if (mysqli_num_rows($run_query)) {
					while ($row = mysqli_fetch_array($run_query)) {
						$pro_id = $row['product_id'];
						$product_name = $row['product_name'];
						$product_title = $row['product_title'];
						$price = $row['product_price'];
						$img = $row['product_image'];
						echo "<div class='pro' onclick='window.location.href=\"sproduct.php\";'>
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
								</div>
								<a href='sproduct.php?proId=$pro_id'>
									<i class='cart'>
										<img src='assets/images/shopping-cart1.png' style='width: 24px;'>
									</i>
								</a>
							</div>";
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
	<?php include('includes/footer.php'); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="assets/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
	<script src="script.js"></script>
</body>
</html>
