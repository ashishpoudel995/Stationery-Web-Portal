<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			font-family: Times New Roman;
		}
		.header{
			background-color: black;
			padding: 10px;
			height: 45px;
		}
		ul{
			float: right;
			list-style-type: none;
			margin-top: 25px;
		}
		ul li{
			display: inline-block;
		}
		ul li a{
			text-decoration: none;
			color: #fff;
			padding: 5px 20px;
			border: 1px solid #fff;
			transition: 0.6s ease;
		}
		ul li a:hover{
			background-color: #fff;
			color: #000;
		}
		ul li.active a{
			background-color: #fff;
			color: #000;
		}
		body{
			background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.8)), url(background3.jpg);
			height: 100vh;
			background-size: cover;
			background-position: center;
		}
		.guide{
			position: absolute;
			top: 20%;
			left: 39%;
			font-size: 30px;
			color:white;
		}
		.amount{
			margin-left: 20px;
			border: 1px solid white;
			width: 200px;
			padding: 20px;
			display: inline-block;
			color:white;
		}
		.payment{
			border:1px solid white;
			display: inline-block;
			margin-top: 10%;
			margin-left: 10%;
			padding: 50px;
		}
		.delivery{
			border: 1px solid white;
			padding: 20px;
			position: absolute;
			top:30%;
			left:65%;
			display: inline-block;
		}
		label{
			font-size: 20px;
			color:white;
			width: 200px;
			display: inline-block;
		}
		h1{
			color:white;
		}
		input[type="text"]{
			padding: 5px;
			width: 190px;
		}
		input[type="submit"]{
			padding: 10px;
			margin-left: 260px;
			font-family: Times New Roman;
			font-size: 18px;
			background-color: #4CAF50;
			color:white;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div class="header">
		<p style="color:white;font-size: 30px; float: left;margin-left: 50px;">Stationery Web Portal</p>
		<ul>
			<li><a href="customerChoice.html">Home Page</a></li>
			<li><a href="contactus.html">Contact Us</a></li>
			<li class="active"><a href="#">CheckOut</a></li>
			<li><a href="homepage.html">Log Out</a></li>
		</ul>
	</div>
	<div class="guide">
		<p>Step 1 &emsp;&emsp;&emsp;&emsp;&emsp;-------------------------> &emsp;&emsp;&emsp;Step 2</p>
	</div>
	<div class="amount">
		<?php session_start();?>
		<h2>YOUR ORDER:</h2><br>
		<p>Total No. Of Items: <?php echo($_SESSION["noofitems"]);?> </p><br>
		<p>Total Amount: Rs.<?php echo number_format($_SESSION["total"],2);?></p>
	</div>
	<div class="payment">
		<h1>SELECT PAYMENT MODE:</h1><br><br>
		<form>
		<input type="radio" name="pay" value="debit" disabled>
		<label for="debit">Debit Card</label><br><br>
		<input type="radio" name="pay" value="credit" disabled>
		<label for="credit">Credit Card</label><br><br>
		<input type="radio" name="pay" value="cod" checked>
		<label for="cod">Cash On Delivery</label><br><br>
		<input type="radio" name="pay" value="gpay" disabled>
		<label for="gpay">Google Pay (UPI)</label><br><br>
		<input type="radio" name="pay" value="phonepe" disabled>
		<label for="phonpe">Phone Pe (UPI)</label><br><br>
		</form>
	</div>
	<div class="delivery">
		<h1>ENTER DELIVERY LOCATION:</h1><br><br>
		<form method="post" action="placeOrder.php">
			<label for="fname">First Name:</label>
			<input type="text" name="fname" required=><br><br>
			<label for="lname">Last Name:</label>
			<input type="text" name="lname" required=><br><br>
			<label for="phoneno">Phone Number:</label>
			<input type="text" name="phoneno" required><br><br>
			<label for="address">Address:</label>
			<textarea name="address" rows="3" cols="30" required></textarea><br><br>
			<input type="submit" name="placeorder" value="Place Order">
		</form>
	</div>
</body>
</html>