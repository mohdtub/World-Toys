<?php
include('dbconnect.php');
$error_msg = '';
$msg = '';

if (isset($_POST['signup'])) {
	$f_name = $_POST['f_name'];
	$l_name = $_POST['l_name'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$mobile = $_POST['mobile'];
	$address1 = $_POST['address1'];
	$address2 = $_POST['address2'];
	$visa = $_POST['visa'];
	$cvv = $_POST['cvv'];
	$expire = $_POST['expire'];

	$name = "/^[a-zA-Z ]+$/";
	$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
	$number = "/^[0-9]+$/";

	if (empty($f_name) || empty($l_name) || empty($email) || empty($password) || empty($mobile) || empty($address1) || empty($address2) || empty($visa) || empty($cvv)|| empty($expire)) {
		$error_msg = "Please fill all the fields!";
	} else {
		if (!preg_match($name, $f_name)) {
			$error_msg = "The first name $f_name is not valid!";
		}

		if (!preg_match($name, $l_name)) {
			$error_msg = "The last name $l_name is not valid!";
		}

		if (!preg_match($emailValidation, $email)) {
			$error_msg = "The email $email is not valid!";
		}

		if (strlen($password) < 9) {
			$error_msg = "Password is weak! It must be more than 9 characters.";
		}

		if (!preg_match($number, $mobile)) {
			$error_msg = "Mobile number $mobile is not valid.";
		}

		if (!preg_match($number, $visa)) {
			$error_msg = "Visa number $visa is not valid.";
		}

		if (!(strlen($mobile) == 10)) {
			$error_msg = "Mobile number must be 10 digits!";
		}

		if (!(strlen($visa) == 16)) {
			$error_msg = "Visa number must be 16 digits!";
		}

		if (!(strlen($cvv) == 3)) {
			$error_msg = "CVV number must be 3 digits!";
		}

		$sql = "SELECT user_id FROM customer WHERE email = '$email' LIMIT 1";
		$check_query = mysqli_query($conn, $sql);
		$count_email = mysqli_num_rows($check_query);

		if ($count_email > 0) {
			$error_msg = "Email address is already taken. Try another email address.";
		} else {
			$sql_visa = "SELECT user_id FROM customer WHERE visa = '$visa' LIMIT 1";
			$check_query = mysqli_query($conn, $sql_visa);
			$count_visa = mysqli_num_rows($check_query);

			if ($count_visa > 0) {
				$error_msg = "Visa number is already in use. Try another visa number.";
			} else {
				$sql = "INSERT INTO customer (first_name, last_name, email, password, mobile, address1, address2, visa, cvv, expire) 
						VALUES ('$f_name', '$l_name', '$email', '$password', '$mobile', '$address1', '$address2', '$visa', '$cvv', '$expire')";
				$run_query = mysqli_query($conn, $sql);

				if ($run_query) {
					$msg = "
						<div class='alert alert-success'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							Click <b><a href='customer_login.php'>here</a></b> to login.
						</div>
					";
				}
			}
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>World Toys</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/2d7d554efc.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.6-dist/css/bootstrap.css">
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
			<li><a href="customer_login.php">Sign In</a></li>
			<li><a class="active" href="customer_registration.php">Sign Up</a></li>
		</div>
		<div id="mobile">
			<a href="cart.html" name="cartmenu"><i class="fa-regular fa-bag-shopping"></i></a>
			<i id="bar" class="fsa fa-outdent"></i>
		</div>
	</section>

	<div class="logo" style="background-image: url('img/BACKGROUNDS/hero1.gif'); height: 86vh; background-size: 100% 100%;">
		<?php if ($error_msg) { ?>
			<div class='alert alert-danger' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
				</button>
				<strong><?php echo $error_msg; ?></strong>
			</div>
		<?php } else { echo $msg; } ?>
		<p><br></p>
		<div class="logo">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8" id="err_msg"></div>
					<div class="col-md-2"></div>
				</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="panel panel-primary">
							<div class="panel-heading" style="color: #333; background-color: #e3e6f3; border-color: #e3e6f3;">
								Sign Up
							</div>
							<div class="panel-body">
								<form method="post" action="customer_registration.php">
									<div class="row">
										<div class="col-md-12">
											<label for="f_name">First Name<span>*</span></label>
											<input type="text" id="f_name" name="f_name" placeholder="Name" class="form-control">
										</div>
										<div class="col-md-12">
											<label for="l_name">Last Name<span>*</span></label>
											<input type="text" id="l_name" name="l_name" placeholder="Name" class="form-control">
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<label for="email">Email <span>*</span></label>
											<input type="text" id="email" name="email" placeholder="@example.com" class="form-control">
										</div>
										<div class="col-md-12">
											<label for="password">Password<span>*</span></label>
											<input type="password" id="password" name="password" placeholder="At least 9 characters" class="form-control">
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<label for="mobile">Mobile<span>*</span></label>
											<input type="text" name="mobile" class="form-control" placeholder="(JOR) 10 digits">
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<label for="address1">Address #1<span>*</span></label>
											<input type="text" id="address1" name="address1" class="form-control">
										</div>

										<div class="col-md-12">
											<label for="address2">Address #2<span>*</span></label>
											<input type="text" id="address2" name="address2" class="form-control">
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<label for="visa">Visa Card Number<span>*</span></label>
											<input type="text" name="visa" placeholder="16 digits" class="form-control">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<label for="visa">CVV<span>*</span></label>
											<input type="text" name="cvv" placeholder="3 digits" class="form-control">
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<label for="visa">Expire<span>*</span></label>
											<input type="text" name="expire" class="form-control">
										</div>
									</div>

									<br>
									<div style="margin-left: 45%;">
										<input class="btn btn-primary" name="signup" type="submit" value="Sign Up" style="color: #333; background-color: #e3e6f3; border-color: #e3e6f3; width: 100px;">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
