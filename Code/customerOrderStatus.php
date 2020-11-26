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
			margin-left: 41%;
			margin-bottom: 5%;
		}
		.b,.c{
			border: 1px solid #fff;
			padding: 10px 30px;
			color: #fff;
			text-decoration: none;
			transition: 0.6s ease;
			background-color: #4CAF50;
		}
		.b:hover,.c:hover{
			color:black;
		}
		.b{
			margin-left: 25%;
		}
		h3{
			margin-top: 5%;
			margin-left: 40%;
			font-size: 40px;
			color:white;
		}
		table,th,td{
			margin-top: 20px;
			margin-left:8%;
			color:white;
			border: 1px solid white;
			border-collapse: collapse;
			padding:5px;
			text-align: center;
		}
		table{
			border-right: 0px;
			margin-bottom: 5%;
		}
		img{
		   	float: left;
		   	margin: 5px;
		   	height: 100px;
		   	width: 200px;
		}
		.cancel{
			background-color: #f44336;
			padding: 5px;
			color:white;
			font-weight: bold;
			cursor: pointer;
		}
		.noorders{
			position: absolute;
			left: 33%;
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
			<li><a href="shopping.php">Shopping Page</a></li>
			<li><a href="cart.php">My Cart</a></li>
			<li class="active"><a href="customerOrderStatus.php">Order Status</a></li>
			<li><a href="homepage.html" onclick="logout();">Log Out</a></li>
		</ul>
	</div>
	<h3>YOUR ORDER STATUS</h3>
	<?php
		session_start();
		$username=$_SESSION['username'];
		require_once "dbconnection.php";
		$sql="select * from orders WHERE USERNAME='$username'";
		$res=mysqli_query($con,$sql);
		if(mysqli_num_rows($res)==0){
	?>
			<div class="noorders">
				<p>You havenot ordered anything yet !</p><br><br>
				<a href="shopping.php" class="b">Start Shopping</a>
			</div>
	<?php
	}
	else{
	?>
		<table>
			<th>Product ID</th>
			<th>Product Image</th>
			<th>Product Name</th>
			<th>Quantity</th>
			<th>Rate</th>
			<th>Cost</th>
			<th>Service Charge</th>
			<th>VAT</th>
			<th>Total Price</th>
			<th>Delivery Information</th>
			<th>Status</th>
	<?php
		while($row=mysqli_fetch_array($res)){
		$pid=$row['PRODID'];
		$imageres=mysqli_query($con,"SELECT IMAGE FROM product where PRODUCT_ID='$pid'");
		$image=mysqli_fetch_array($imageres);
	?>
			<tr>
				<td><?php echo($row['PRODID']);?></td>
				<td><?php echo "<img src='images/".$image['IMAGE']."' >"; ?></td>
				<td><?php echo($row['PRODNAME']);?></td>
				<td><?php echo($row['QUANTITY']);?></td>
				<td><?php echo(number_format($row['RATE'],2));?></td>
				<td><?php echo(number_format($row['COST'],2));?></td>
				<td><?php echo(number_format($row['SERVICE_CHARGE'],2));?></td>
				<td><?php echo(number_format($row['VAT'],2));?></td>
				<td><?php echo(number_format($row['TOTALPRICE'],2));?></td>
				<td><?php
						echo("<b>First Name: </b>".$row['FIRST_NAME']."<br>");
						echo("<b>Last Name: </b>".$row['LAST_NAME']."<br>");
						echo("<b>Mobile No: </b>".$row['PHONE_NO']."<br>");
						echo("<b>Address: </b>".$row['ADDRESS']); 
					?>		
				</td>
				<td><?php echo($row['STATUS']) ?></td>
				<?php 
				if($row['STATUS']=='PENDING')
				{
				?>	
				<td style="border: none;">
					<form method="post">
						<input type="hidden" name="hidden_id" value="<?php echo($row['ORDER_ID'])?>">
						<input type="hidden" name="prodid" value="<?php echo($row['PRODID'])?>">
						<input type="hidden" name="quantity" value="<?php echo($row['QUANTITY'])?>">
						<input type="submit" name="cancel" value="Cancel Order" class="cancel">
					</form>
				</td>
				<?php
				}
				?>
			</tr>
	<?php
		}
	?>
		</table>
		<div class="choices">
			<a href="shopping.php" class="c">ENJOY SHOPPING</a>
		</div>
	<?php	
		}	
	?>
</body>
</html>
<?php
	if(isset($_POST["cancel"])){
		$id=$_POST['hidden_id'];
		$sql="DELETE FROM orders WHERE ORDER_ID='$id'";
		if(mysqli_query($con,$sql)){
			$added=$_POST['quantity'];
			$pid=$_POST['prodid'];
			$sql0="select * from product WHERE PRODUCT_ID='$pid'";
			$res=mysqli_query($con,$sql0);
			$row=mysqli_fetch_array($res);
			$newquantity=$added+$row['STOCK_QUANTITY'];
			$sql1="UPDATE product SET STOCK_QUANTITY='$newquantity' WHERE PRODUCT_ID='$pid'";
			if(mysqli_query($con,$sql1)){
			echo "<script>window.location='customerOrderStatus.php'</script>";
			}
		}
		else{
			echo "<script>alert('Order Cancellation Failed');</script>";
			echo "<script>window.location='customerOrderStatus.php'</script>";
		}
	}
?>