<?php
session_start();

include('dbconnect.php');
if (!isset($_SESSION['uid'])) {
	header('Location:index.php');
}
$uid = $_SESSION['uid'];
$sql = "SELECT * FROM customer_order WHERE uid='$uid'";
$run_query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($run_query);
$trid = $row['tr_id'];
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Payment Success</title>
	<script src="https://kit.fontawesome.com/2d7d554efc.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.6-dist/css/bootstrap.css">
	<link rel="stylesheet" href="style.css">
	<link href="img/logo.png" rel="icon">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.6-dist/css/bootstrap.css">
	<style type="text/css">
		.content {
			display: none;
		}
	</style>
</head>

<body>
	<section id="header">
		<a href="index.php"><img src="img/logo.png" class="logo" alt=""></a>
		<div id="navbar">
			<li><a href="profile.php">Home</a></li>
			<li><a href="shop.php">Shop</a></li>
			<li><a href="about.html">About</a></li>
			<li><a href="contact.php">Contact</a></li>
			<li id="ld-bag"><a class="active" name="cartmenu" href="cart.php"><i class="fa-regular fas fa-bag-shopping"></i></a></li>
			<a href="#" id="close"><i class="fa-regular fa-cart-shopping"></i></a>
			<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>Hello, <?php echo $_SESSION['uname']; ?></a>
				<ul class="dropdown-menu">
					<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart-large"></span> Cart</a></li>
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
	<div class="logo" style="background-image: url('img/BACKGROUNDS/hero2.gif'); height: 85.6vh; background-size: 100% 100%;">
		<br><br><br><br><br>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h1>Thank You!</h1>
						</div>
						<div class="panel-body">
							Hello <?php echo $_SESSION['uname']; ?>, your payment was successful.
							<br>Your transaction ID is <?php echo $trid; ?>
							<br>You can continue shopping.
							<p></p>
							<a href="profile.php" class="normal">Back to Store</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="assets/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
	<script src="script.js"></script>
</body>

</html>
