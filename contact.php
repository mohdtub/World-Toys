<?php
include('dbconnect.php');
$error_msg = '';
$msg = '';

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];

	if (empty($name) || empty($email) || empty($subject) || empty($message)) {
		$error_msg = "All fields are required!";
	} else {
		$sql = "INSERT INTO feedback (user_name, user_email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
		$run_query = mysqli_query($conn, $sql);

		if ($run_query) {
			$msg = "
				<br>
				<div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Thank you for your feedback. We appreciate your input.
				</div>
			";
		}
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
	<link rel="stylesheet" href="style.css">
	<link href="img/logo.png" rel="icon">
	<title>Shop</title>
</head>

<body>
	<section id="headre">
		<a href="index.php"><img src="img/logo.png" class="logo" alt=""></a>
		<div id="navbar">
			<li><a href="index.php">Home</a></li>
			<li><a href="shop.php">Shop</a></li>
			<li><a href="about.php">About</a></li>
			<li><a class="active" href="contact.php">Contact</a></li>
			<li id="ld-bag"><a href="cart.php"><i class="fa-regular fas fa-bag-shopping"></i></a></li>
			<a href="#" id="close"><i class="fa-regular fa-cart-shopping"></i></a>
		</div>
		<div id="mobile">
			<a href="cart.html"><i class="fa-regular fa-bag-shopping"></i></a>
			<i id="bar" class="fsa fa-outdent"></i>
		</div>
	</section>

	<section id="page-header" class="about-header" style="background-image: url('img/DONATION PHOTO/D3.gif');">
		<h2>#Let's Talk</h2>
		<p>Leave us a message, we'd love to hear from you!</p>
	</section>

	<?php if ($error_msg) { ?>
		<br>
		<div class='alert alert-danger' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
			</button>
			<strong><?php echo $error_msg; ?></strong>
		</div>
	<?php } else {
		echo $msg;
	} ?>

	<section id="contact-details" class="section-p1">
		<div class="details">
			<span>GET IN TOUCH</span>
			<h2>Visit one of our agency locations or contact us today</h2>
			<h3>Head Office</h3>
			<div>
				<li>
					<i class="fa-regular fa-map"></i>
					<p>Al-Mafraq</p>
				</li>
				<li>
					<i class="fa-regular fa-envelope"></i>
					<p>aabustudents@gmail.com</p>
				</li>
				<li>
					<i class="fa-sharp fa-solid fa-phone"></i>
					<p>+962799390614</p>
				</li>
				<li>
					<i class="fa-regular fa-clock"></i>
					<p>Sunday to Thursday: 8:30 AM - 4:30 PM</p>
				</li>
			</div>
		</div>
		<div class="map">
			<iframe
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1417.3573154034987!2d36.24070334309114!3d32.33702339055197!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151b98159b4583f5%3A0xd740a5426eab295f!2z2YPZhNmK2Kkg2KrZg9mG2YjZhNmI2KzZitinINin2YTZhdi52YTZiNmF2KfYqg!5e0!3m2!1sen!2sjo!4v1735587047975!5m2!1sen!2sjo"
				width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</section>

	<section id="form-details">
		<form action="" method="post">
			<span>LEAVE A MESSAGE</span>
			<h2>We'd Love to Hear From You</h2>
			<input type="text" placeholder="Your Name" name="name">
			<input type="text" placeholder="Email" name="email">
			<input type="text" placeholder="Subject" name="subject">
			<textarea name="message" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
			<button class="normal" name="submit" type="submit">Submit</button>
		</form>

		<div class="people" style="margin-left:70px;">
			<div>
				<img src="img/people/mohammed.png" alt="">
				<p><span>Mohammed Tubaishat</span> Computer Science <br>Phone: +962 799390614 <br>Email:
					mohammed.tubaishat01@gmail.com</p>
			</div>
			<div>
				<img src="img/people/mahmoud.png" alt="">
				<p><span>Mahmoud Masaeed</span> Computer Science <br>Phone: +962 788272010 <br>Email:
					mahmoudalshmare78@gmail.com</p>
			</div>
			<div>
				<img src="img/people/abdallah.png" alt="">
				<p><span>Abdullah Hendawi</span> Computer Science <br>Phone: +962 795390574 <br>Email:
					aboodabood57x@gmail.com</p>
			</div>
		</div>
	</section>

	<?php include('includes/footer.php'); ?>
	<script src="script.js"></script>
</body>
</html>
