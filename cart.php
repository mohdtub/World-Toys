<?php
session_start();

include('dbconnect.php');

if (!isset($_SESSION['uid'])) {
	header('Location:index.php');
}

$uid = $_SESSION['uid'];
$msg = '';
$error_msg = '';

if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];
	$run_query = mysqli_query($conn, "DELETE FROM cart WHERE id='$id' AND user_id='$uid'");
	if ($run_query) {
		$msg = 'Success! Item removed from cart!';
	} else {
		$error_msg = 'Error occurred while removing item from cart.';
	}
}

if (isset($_POST['update_cart'])) {
	$update_quantity = $_POST['cart_quantity'];
	$update_id = $_POST['cart_id'];
	$sql = "SELECT products.product_price, cart.qty, cart.total_amount 
			FROM cart, products 
			WHERE id='$update_id' AND cart.p_id = products.product_id";
	$run_query = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($run_query);
	$price = $row['product_price'];
	$total_price = $update_quantity * $price;
	mysqli_query($conn, "UPDATE `cart` SET qty = '$update_quantity', total_amount = '$total_price' WHERE id = '$update_id'") or die('Query failed');
	$msg = 'Success! Cart quantity updated.';
}

if (isset($_POST['payment_checkout'])) {
	$sql = "SELECT cart.p_id, cart.qty, cart.total_amount, products.product_name, products.product_image, products.product_price 
			FROM cart, products 
			WHERE user_id='$uid' AND cart.p_id = products.product_id";
	$run_query = mysqli_query($conn, $sql);
	$transaction_id = rand();

	if (mysqli_num_rows($run_query) > 0) {
		while ($cart_row = mysqli_fetch_array($run_query)) {
			$cart_prod_id = $cart_row['p_id'];
			$cart_qty = $cart_row['qty'];
			$cart_price_total = $cart_row['total_amount'];
			$sql2 = "INSERT INTO customer_order (uid, pid, p_price, p_qty, tr_id) 
					VALUES ('$uid', '$cart_prod_id', '$cart_price_total', '$cart_qty', '$transaction_id')";
			mysqli_query($conn, $sql2);
		}
		$transaction_id++;
		$sql3 = "DELETE FROM cart WHERE user_id='$uid'";
		mysqli_query($conn, $sql3);
		header("Location: payment_success.php");
	} else {
		$error_msg = "Cart is empty. Please add items to your cart.";
	}
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
	<title>Shop</title>
	<style>
		.button {
			background-color: transparent;
			background-repeat: no-repeat;
			border: none;
			cursor: pointer;
			overflow: hidden;
			outline: none;
		}

		.flex2 {
			display: flex;
			justify-content: space-around;
		}
	</style>
</head>

<body>
	<section id="headre">
		<a href="index.php"><img src="img/logo.png" class="logo" alt=""></a>
		<div id="navbar">
			<li><a href="profile.php">Home</a></li>
			<li><a href="shop.php">Shop</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="contact.php">Contact</a></li>
			<li id="ld-bag"><a class="active" name="cartmenu" href="cart.php"><i class="fa-regular fas fa-bag-shopping"></i></a></li>
			<a href="#" id="close"><i class="fa-regular fa-cart-shopping"></i></a>
			<li>
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Logged in as <?php echo $_SESSION['uname']; ?></a>
				<ul class="dropdown-menu">
					<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart-large"></span>Cart</a></li>
					<li><a href="change_password.php">Change Password</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</div>
		<div id="mobile">
			<a href="cart.html"><i class="fa-regular fa-bag-shopping"></i></a>
			<i id="bar" class="fsa fa-outdent"></i>
		</div>
	</section>
	<section id="page-header" class="about-header">
		<h2>#Shop Today's Deals</h2>
		<p>Your WORLD TOYS Cart</p>
	</section>
	<section id="cart" class="section-p1">
		<?php if ($msg) { ?>
			<div class='alert alert-success' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
				</button>
				<strong><?php echo $msg; ?></strong>
			</div>
		<?php } elseif ($error_msg) { ?>
			<div class='alert alert-danger' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
				</button>
				<strong><?php echo $error_msg; ?></strong>
			</div>
		<?php } ?>
		<table width="100%">
			<form method="post" action="">
				<thead>
					<td></td>
					<td>Remove | Update</td>
					<td>Images</td>
					<td>Product</td>
					<td>Price</td>
					<td>Quantity</td>
					<td>Subtotal</td>
				</thead>
				<?php 
					$sql = "SELECT cart.id, cart.p_id, cart.qty, cart.total_amount, products.product_name, products.product_image, products.product_price FROM cart, products WHERE user_id='$uid' AND cart.p_id = products.product_id";
					$run_query = mysqli_query($conn, $sql);
					$count = mysqli_num_rows($run_query);
					if ($count > 0) {
						$total_amt = 0;
						while ($row = mysqli_fetch_array($run_query)) {
							$id = $row['id'];
							$product_image = $row['product_image'];
							$product_name = $row['product_name'];
							$product_price = $row['product_price'];
							$qty = $row['qty'];
							$total = $row['total_amount'];
							$total_amt += $total;
				?>
				<tbody>
					<tr>
						<td></td>
						<td>
							<a href="cart.php?del_task=<?php echo $row['id']; ?>" style="margin: 20px;">
								<i class="fa-regular fa-circle-xmark"></i>
							</a>
							<form action="" method="post">
								<input type="hidden" name="cart_id" value="<?php echo $row['id']; ?>">
								<button type="submit" name="update_cart" class="button" style="margin: 20px;">
									<i class="fa fa-check" style="color:blue;"></i>
								</button>
							</form>
						</td>
						<td><img src="img/products/<?php echo $product_image; ?>" alt=""></td>
						<td><?php echo $product_name; ?></td>
						<td><?php echo $product_price; ?></td>
						<td>
							<input type="number" min="1" name="cart_quantity" value="<?php echo $qty; ?>" style="width: 70px;">
						</td>
						<td><?php echo $total; ?></td>
					</tr>
				</tbody>
				<?php } } ?>
			</form>
		</table>
	</section>
	<form method="post">
		<section id="cart-add" class="section-p1">
			<div id="subtotal">
				<h3>Cart Totals</h3>
				<table>
					<tr>
						<td>Cart Subtotal</td>
						<td>
							<?php 
								$sql = "SELECT * FROM cart WHERE user_id='$uid'";
								$run_query = mysqli_query($conn, $sql);
								$total_amt = 0;
								while ($row = mysqli_fetch_array($run_query)) {
									$total_amt += $row['total_amount'];
								}
								echo $total_amt;
							?>
						</td>
					</tr>
					<tr>
						<td>Shipping</td>
						<td>Free</td>
					</tr>
					<tr>
						<td><strong>Total</strong></td>
						<td><strong><?php echo $total_amt; ?></strong></td>
					</tr>
				</table>
				<button class="normal" name="payment_checkout" type="submit">Proceed to Checkout</button>
			</div>
		</section>
	</form>
	<hr size="10" color="#088178">
	<footer class="section-p1">
		<div class="col">
			<img class="logo" src="img/logo.png" alt="">
			<h4>Contact</h4>
			<p><strong>Address:</strong> Jordan-Amman-JORst</p>
			<p><strong>Hours:</strong> 10:00 - 18:00, Sun-Thu</p>
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
			<a href="customer_login.php">Sign In</a>
			<a href="cart.php">View Cart</a>
		</div>
	</footer>
	<div class="copyright">
		<p>© 2022, All rights reserved to World Toys Team.</p>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="assets/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
	<script src="script.js"></script>
</body>
</html>
