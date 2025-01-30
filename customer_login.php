<?php
include('dbconnect.php');
session_start();

if (isset($_SESSION['uid'])) {
	header("Location: profile.php");
}

if (isset($_SESSION['user_id'])) {
	header("Location: dashboard.php");
}

$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
$error = '';
$error_msg = '';

if (isset($_POST['userLogin'])) {
	$email = $_POST['email'];
	$password_user = md5($_POST['password']);
	$password_admin = $_POST['password'];

	$query = "SELECT * FROM admin WHERE UserName = '$email'";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$user_id = $row['id'];
			$user_password = $row['Password'];

			if ($password_admin == $user_password) {
				$_SESSION['user_id'] = $row['id'];
				header("Location: admin/dashboard.php");
			} else {
				$error = "Incorrect password";
			}
		}
	} else {
		if (!preg_match($emailValidation, $email)) {
			$error = "The email $email is not valid!";
		} else {
			$query = "SELECT * FROM customer WHERE email = '$email'";
			$result = mysqli_query($conn, $query);

			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$user_id = $row['user_id'];
					$password = $row['password'];

					if ($password_user == $password) {
						$_SESSION['uid'] = $row['user_id'];
						$_SESSION['uname'] = $row['first_name'];
						$_SESSION['user_id'] = $user_id;
						header("Location: profile.php");
					} else {
						$error = "Incorrect password";
					}
				}
			} else {
				$error = "Incorrect email";
			}
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Carla</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.6-dist/css/bootstrap.css">
	<script src="https://kit.fontawesome.com/2d7d554efc.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="style.css">
	<link href="img/logo.png" rel="icon">
</head>

<body>
	<section id="headre">
		<a href="index.php"><img src="img/logo.png" class="logo" alt=""></a>
		<div id="navbar">
			<li><a href="index.php">Home</a></li>
			<li><a href="shop.php">Shop</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="contact.php">Contact</a></li>
			<a href="#" id="close"><i class="far fa-times"></i></a>
			<li><a class="active" href="customer_login.php">Sign In</a></li>
			<li><a href="customer_registration.php">Sign Up</a></li>
		</div>
		<div id="mobile">
			<a href="cart.html" name="cartmenu"><i class="fa-regular fa-bag-shopping"></i></a>
			<i id="bar" class="fsa fa-outdent"></i>
		</div>
	</section>
	<div class="logo" style="background-image: url('img/BACKGROUNDS/hero1.gif'); height: 86.3vh; background-size: 100% 100%;">
		<?php if ($error) { ?>
			<div class='alert alert-danger' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
				</button>
				<strong><?php echo $error; ?></strong>
			</div>
		<?php } ?>
		<p><br><br><br></p>
		<p><br><br><br></p>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="panel panel-primary">
						<div class="panel-heading" style="color: #333; background-color: #e3e6f3; border-color: #e3e6f3;">
							Sign In
						</div>
						<div class="panel-body">
							<form method="post" action="">
								<div class="row">
									<div class="col-md-12">
										<label for="email">Email</label>
										<input type="text" id="email" name="email" class="form-control">
									</div>
									<div class="col-md-12">
										<label for="password">Password</label>
										<input type="password" id="password" name="password" class="form-control">
									</div>
								</div>
								<br>
								<div style="margin-left: 45%;">
									<input class="btn btn-success" name="userLogin" type="submit" value="Sign In" style="color: #333; background-color: #e3e6f3; border-color: #e3e6f3; width: 100px;">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
