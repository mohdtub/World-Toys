<?php
session_start();

include('dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/2d7d554efc.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="style.css">
	<link href="img/logo.png" rel="icon">
	<title>Shop</title>
</head>

<body>
	<section id="headre">
		<a href="index.php"><img src="img/logo.png" class="logo" alt=""></a>
		<div id="navbar">
			<li><a href="profile.php">Home</a></li>
			<li><a href="shop.php" class="active">Shop</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="contact.php">Contact</a></li>
			<li id="ld-bag"><a name="cartmenu" href="cart.php"><i class="fa-regular fas fa-bag-shopping"></i></a></li>
			<a href="#" id="close"><i class="fa-regular fa-cart-shopping"></i></a>
		</div>
		<div id="mobile">
			<a href="cart.html"><i class="fa-regular fa-bag-shopping"></i></a>
			<i id="bar" class="fsa fa-outdent"></i>
		</div>
	</section>
	<section id="page-header">
		<h2>#Stay Happy</h2>
		<p>Save more & up to 70% off!</p>
	</section>
	<section id="product1" class="section-p1">
		<div class="pro-container">
			<?php
				$product_query="SELECT * FROM products";
				$run_query=mysqli_query($conn,$product_query);
				if(mysqli_num_rows($run_query)){
					while($row=mysqli_fetch_array($run_query))
					{
						$pro_id=$row['product_id'];
						$product_title=$row['product_name'];
						$product_title=$row['product_title'];
						$price=$row['product_price'];
						$img=$row['product_image'];
						echo "<div class='pro' onclick='window.location.href='sproduct.php';'>
						<img src='img/products/$img' alt=''>
						<div class='des'>
							<span>$product_title</span>
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
			<?php }}?>
		</div>
	</section>
	<?php include('includes/footer.php');?>
	<script src="script.js"></script>
</body>
</html>
