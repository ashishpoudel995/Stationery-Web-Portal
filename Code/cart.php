<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			font-family: Century Gothic;
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
			font-family: Times New Roman;
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
			background-repeat: no-repeat;
 			background-attachment: fixed;
		}
		.title{
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%,-50%);	
		}
		.title h1{
			color: #fff;
			font-size: 70px;
		}
		.choices{
			margin-left: 33%;
			margin-bottom: 3%;
		}
		.a,.b,.c{
			border: 1px solid #fff;
			padding: 10px 30px;
			color: #fff;
			text-decoration: none;
			transition: 0.6s ease;
		}
		.a:hover,.b:hover{
			background-color: #fff;
			color: #000;
		}
		.c{
			background-color: #4CAF50;
		}
		.c:hover{
			color:black;
		}
		h3{
			margin-top: 5%;
			margin-left: 40%;
			font-size: 40px;
			color:white;
		}
		table,th,td{
			margin-top: 20px;
			margin-left: 15%;
			color:white;
			border: 1px solid white;
			border-collapse: collapse;
			padding:5px;
		}
		table{
			border-right: 0px;
		}
		img{
		   	float: left;
		   	margin: 5px;
		   	height: 100px;
		   	width: 200px;
		}
		.delete{
			background-color: #f44336;
			padding: 5px;
			color:white;
			font-weight: bold;
		}
		.emptycart{
			position: absolute;
			left: 37%;
			top: 30%;
			font-size: 28px;
			color:white;
			border: 1px solid white;
			padding: 50px;
		}
	</style>
</head>
<body>
	<div class="header">
		<p style="color:white;font-size: 30px; float: left;margin-left: 50px;font-family: Times New Roman;">Stationery Web Portal</p>
		<ul>
			<li><a href="customerChoice.html">Home Page</a></li>
			<li><a href="contactus.html">Contact Us</a></li>
			<li class="active"><a href="#">My Cart</a></li>
			<li><a href="homepage.html">Log Out</a></li>
		</ul>
	</div>
	<h3>CART DETAILS</h3>
	<?php
		require_once "dbconnection.php";
		session_start();
		$username=$_SESSION["username"];
		$sql="select * from cart where USERNAME='$username'";
		$res=mysqli_query($con,$sql);
		if(mysqli_num_rows($res)==0){
	?>
			<div class="emptycart">
				<p>No Items in the Cart</p><br><br>
				<a href="shopping.php" class="c">Start Shopping</a>
			</div>
	<?php
	}
	else{
	?>
		<div class="cart_table">
			<table>
				<tr>
					<th>Product Image</th>
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Rate</th>
					<th>Total</th>
					<th>SERVICE CHARGE(15%)</th>
					<th>VAT(13%)</th>
					<th>Total Cost</th>
					<th>Availability</th>
				</tr>
				<?php
					$available=true;
					$total = 0;
					while($values=mysqli_fetch_array($res)){
				?>
					<tr>
						<td><?php echo "<img src='images/".$values['IMAGE']."' >"; ?></td>
						<td align="center"><b><?php echo $values["PRODUCT_NAME"]; ?></b></td>
						<td align="center"><?php echo $values["QUANTITY"]; ?></td>
						<td align="center">Rs. <?php echo $values["RATE"]; ?></td>
						<td align="center">Rs. <?php echo number_format($values["TOTAL"],2); ?></td>
						<td align="center">Rs. <?php echo number_format($values["SERVICE_CHARGE"],2);?></td>
						<td align="center">Rs. <?php echo number_format($values["VAT"],2);?></td>
						<td align="center">Rs. <?php echo number_format($values["TOTAL_COST"],2);?></td>
						<td align="center"><?php
							$pid=$values['PRODUCT_ID'];
							$query="select STOCK_QUANTITY from product where PRODUCT_ID='$pid'";
							$result=mysqli_fetch_array(mysqli_query($con,$query));
							if($result['STOCK_QUANTITY']<$values['QUANTITY']){
								$available=false;
							?>
								<span style="color: red;font-weight: bold;">Unavailable<span>
							<?php
							}
							else{
							?>
								<span style="color: #4CAF50;font-weight: bold;">Available</span>
							<?php
							}
						?>	
						</td>
						<td style="border:none;"><form method="post">
							<input type="hidden" name="hidden-id" value="<?php echo($values['CART_ADD_ID']) ?>">
							<input type="submit" name="delete" class="delete" value="Remove from Cart">
						</form></td>
					</tr>
				<?php
						$total =$total+ $values["TOTAL_COST"];
					}
					$_SESSION['total']=$total;
					$_SESSION['noofitems']=mysqli_num_rows($res);
					$_SESSION['availability']=$available;
				?>
					<tr>
						<td colspan="7" align="right">Total</td>
						<td align="left" colspan="2">Rs. <?php echo number_format($total, 2); ?></td>
					</tr>
			</table>
		</div>
		<div class="choices">
			<br><br>
			<a href="shopping.php" class="a">Continue Shopping</a>
			<a href="checkavailability.php" class="b">Proceed to Checkout</a>
		</div>
	<?php
		}	
	?>
</body>
</html>
<?php
	if(isset($_POST["delete"])){
		$id=$_POST["hidden-id"];
		$sql="DELETE from cart where CART_ADD_ID='$id'";
		if(mysqli_query($con,$sql)){
			echo "<script>alert('Item Removed From Cart')</script>";
			echo "<script>window.location='cart.php'</script>";
		}
		else{
			echo "<script>alert('Item Removal Failed')</script>";
			echo "<script>window.location='cart.php'</script>";
		}
	}
?>