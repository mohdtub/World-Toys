<?php
include('dbconnect.php');
session_start();

$error = $msg = $user_id = '';

if (isset($_SESSION['uid'])) {
	$user_id = $_SESSION['uid'];
}

if (isset($_POST['change'])) {
	$old_password = md5($_POST['password']);
	$new_password = md5($_POST['newpassword']);
	$con_password = md5($_POST['confirmpassword']);
	$chg_pwd = mysqli_query($conn, "SELECT * FROM customer WHERE user_id='$user_id'");
	$chg_pwd1 = mysqli_fetch_array($chg_pwd);
	$data_pwd = $chg_pwd1['password'];

	if ($data_pwd == $old_password) {
		if ($new_password == $con_password) {
			$update_pwd = mysqli_query($conn, "UPDATE customer SET password='$new_password' WHERE user_id='$user_id'");
			$msg = "Password updated successfully!";
		}
	} else {
		$error = "Incorrect old password!";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Change Password</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/2d7d554efc.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.6-dist/css/bootstrap.css">
	<link rel="stylesheet" href="style.css">
	<link href="img/logo.png" rel="icon">
	<meta content="Steelcoders" name="author">
	<link href="assets/css/style-barside.css" rel="stylesheet" type="text/css">
</head>

<body>
	<section id="headre">
		<a href="index.php"><img src="img/logo.png" class="logo" alt=""></a>
		<div id="navbar">
			<li><a href="index.php">Home</a></li>
			<li><a href="shop.php">Shop</a></li>
			<li><a href="about.html">About</a></li>
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
	<div class="logo" style="background-image: url('img/BACKGROUNDS/hero1.gif'); height: 86vh; background-size: 100% 100%;">
		<div class="container-fluid">
			<?php if ($msg) { ?>
				<div class='alert alert-success' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
					<strong><?php echo $msg; ?></strong>
				</div>
			<?php } else if ($error) { ?>
				<div class='alert alert-danger' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
					<strong><?php echo $error; ?></strong>
				</div>
			<?php } ?>
			<section id="cart" class="section-p1">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="panel panel-primary">
							<div class="panel-heading" style="color: #333; background-color: #e3e6f3; border-color: #e3e6f3;">
								Change Password
							</div>
							<div class="panel-body">
								<form id="chngpwd" method="post" name="chngpwd">
									<div class="row">
										<div class="col-md-12">
											<label for="password">Enter Old Password</label>
											<input autocomplete="off" class="form-control" id="password" name="password" required="" type="password">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-6">
											<label for="password">Enter New Password</label>
											<input autocomplete="off" class="form-control" id="newpassword" name="newpassword" required="" type="password">
										</div>
										<div class="col-md-6">
											<label for="password">Confirm New Password</label>
											<input autocomplete="off" class="form-control" id="password" name="confirmpassword" required="" type="password">
										</div>
									</div>
									<br>
									<div class="row">
										<div style="margin-left: 45%;">
											<button class="btn btn-primary" name="change" type="submit" style="color: #333; background-color: #e3e6f3; border-color: #e3e6f3; width: 100px;">
												Change
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>

	<script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
	<script src="assets/plugins/materialize/js/materialize.min.js"></script>
	<script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
	<script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
	<script src="assets/js/alpha.min.js"></script>
	<script src="assets/js/pages/form_elements.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="assets/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
	<script src="script.js"></script>
</body>

</html>
