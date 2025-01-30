<?php
session_start();
include('dbconnect.php');
$pid=intval($_GET['proId']);
$msg='';$error='';
if(isset($_POST['addToProduct'])){
	if(!(isset($_SESSION['uid']))){
		$error='Hello! Please <a href="customer_login.php">sign in</a> to add products to your cart.';
	}
	else{
		$uid=$_SESSION['uid'];
		$sql="SELECT cart.p_id, cart.qty, cart.total_amount, products.product_name,products.product_image, products.product_price FROM cart,products WHERE cart.user_id='$uid' AND cart.p_id = $pid";
		$run_query=mysqli_query($conn,$sql);
		$count=mysqli_num_rows($run_query);
		$sql="SELECT products.product_id,cart.p_id, cart.qty, cart.total_amount, products.product_name,products.product_image, products.product_price, products.product_keywords FROM cart,products WHERE products.product_id = '$pid'";
		$run_query = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($run_query);
		$pro_price = $row["product_price"];
		$product_quantity=$_POST['quantity'];
		$total_price = $product_quantity * $pro_price;
		if($count>0){
			$sql="update cart set qty='$product_quantity',total_amount='$total_price' WHERE p_id = '$pid' AND user_id = '$uid'";
			$run_query = mysqli_query($conn,$sql);
			$msg = 'Success! Your cart has been updated.';
		}
		else{
			$sql="INSERT INTO cart(p_id,user_id,qty,total_amount) VALUES('$pid','$uid','$product_quantity','$total_price')";
			$run_query = mysqli_query($conn,$sql);
			if($run_query){
				$msg = 'Success! The product has been added to your cart.';
			}
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
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.6-dist/css/bootstrap.css">
	<link href="img/logo.png" rel="icon">
	<link rel="stylesheet" href="style.css">
	<title>shop</title>
</head>
<body>
	<section id="headre">
		<a href="index.php"><img src="img/logo.png" class="logo" alt=""></a>
		<div id="navbar">
			<li><a href="index.php">Home</a></li>
			<li><a class="active" href="shop.php">Shop</a></li>
			<li><a href="about.html">About</a></li>
			<li><a href="contact.php">Contact</a></li>
			<li id="ld-bag"><a href="cart.php"><i class="fa-regular fas fa-bag-shopping"></i></a></li>
			<a href="#" id="close"><i class="far fa-times"></i></a>
		</div>
		<div id="mobile">
			<a href="cart.html"><i class="fa-regular fa-bag-shopping"></i></a>
			<i id="bar" class="fsa fa-outdent"></i>
		</div>
	</section>
	<section id="prodetails" class="section-p1">
		<?php if($msg){?>
		<div class='alert alert-success' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span></button>
			<strong><?php echo $msg; ?></strong>
		</div>
		<?php }else{if($error){?>
		<div class='alert alert-danger' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span></button>
			<strong><?php echo $error; ?></strong>
		</div>
		<?php }}?>
		<div class="single-pro-img">
			<?php 
				$SQL = "SELECT * FROM products WHERE product_id = '$pid'";
				$run_query = mysqli_query($conn,$SQL);
				while($row=mysqli_fetch_array($run_query))
				{
			?>
			<img src="img/products/<?php echo $row['product_image'];?>" width="100%" id="MainImg" alt="">
		</div>
		<div class="single-pro-details">
			<h6>Home / Toys</h6>
			<h4><?php echo $row['product_name']; ?></h4>
			<h2>JD<?php echo $row['product_price']; ?></h2>
			<form class="col s12" id="chngpwd" method="post" name="chngpwd">
				<input type="number" value="1" min="1" name="quantity">
				<button class="normal" name="addToProduct" type="submit">Add To Cart</button>
			</form>
			<h4>Product Detailes</h4>
			<span> <?php echo $row['product_description']; ?></span>
		</div>
		<?php } ?>
	</section>
	<section id="product1" class="section-p1">
		<h2>Featured Products</h2>
		<p>Collection New Modern Toys</p>
		<div class="pro-container">
			<?php
				include('dbconnect.php');
				$limit=	4;
				$product_query="SELECT * FROM products WHERE product_keywords ='newProduct' LIMIT $limit";
				$run_query=mysqli_query($conn,$product_query);
				if(mysqli_num_rows($run_query)){
					while($row=mysqli_fetch_array($run_query))
					{
						$pro_id=$row['product_id'];
						$product_name=$row['product_name'];
						$product_title=$row['product_title'];
						$price=$row['product_price'];
						$img=$row['product_image'];
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
						</div>";?>
						<a href="sproduct.php?proId=<?php echo $pro_id;?>"><i class='cart'><img
							src='assets/images/shopping-cart1.png' style='width: 24px;'></i></a>
						</div>
			<?php }
			}
			?>
		</div>
	</section>
	<?php include('includes/footer.php');?>
	<script>
		var MainImg = document.getElementById("MainImg");
		var smallimg = document.getElementById("small-img");
		smallimg[0].onclick = function() {
			MainImg.src = smallimg[0].src;
		}
		smallimg[1].onclick = function() {
			MainImg.src = smallimg[1].src;
		}
		smallimg[2].onclick = function() {
			MainImg.src = smallimg[2].src;
		}
		smallimg[3].onclick = function() {
			MainImg.src = smallimg[3].src;
		}
	</script>
	<script src="main.js"></script>
	<script src="script.js"></script>
</body>
</html>
