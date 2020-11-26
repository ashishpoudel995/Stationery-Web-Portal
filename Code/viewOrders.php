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
			margin-left: 30%;
		}
		h3{
			margin-top: 5%;
			margin-left: 35%;
			font-size: 40px;
			color:white;
		}
		table,th,td{
			margin-top: 20px;
			margin-left:7%;
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
		.deliver{
			background-color: #4CAF50;
			padding: 5px;
			color:white;
			font-weight: bold;
		}
		.nopendingorders{
			position: absolute;
			left: 30%;
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
			<li><a href="adminChoice.html">Home Page</a></li>
			<li class="active"><a href="#">View Pending Orders</a></li>
			<li><a href="homepage.html">Log Out</a></li>
		</ul>
	</div>
	<h3>PENDING ORDER DETAILS</h3>
	<?php
		require_once "dbconnection.php";
		$sql="select * from orders WHERE STATUS='PENDING'";
		$res=mysqli_query($con,$sql);
		if(mysqli_num_rows($res)==0){
	?>
			<div class="nopendingorders">
				<p>Currently, there are no pending orders.</p><br><br>
				<a href="adminChoice.html" class="b">Home Page</a>
			</div>
	<?php
	}
	else{
	?>
		<table>
			<th>Ordered By</th>
			<th>Product ID</th>
			<th>Product Image</th>
			<th>Product Name</th>
			<th>Quantity</th>
			<th>Rate</th>
			<th>Cost</th>
			<th>Service Charge(15%)</th>
			<th>VAT(13%)</th>
			<th>Total Price</th>
			<th>Delivery Information</th>
	<?php
		while($row=mysqli_fetch_array($res)){
		$pid=$row['PRODID'];
		$imageres=mysqli_query($con,"SELECT IMAGE FROM product where PRODUCT_ID='$pid'");
		$image=mysqli_fetch_array($imageres);
	?>
			<tr>
				<td><?php echo($row['USERNAME']);?></td>
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
				<td style="border: none;">
					<form method="post">
						<input type="hidden" name="hidden_id" value="<?php echo($row['ORDER_ID'])?>">
						<input type="submit" name="deliver" value="Deliver Now" class="deliver">
					</form>
				</td>
			</tr>
	<?php
		}
	?>
		</table>
		<div class="choices">
			<a href="adminChoice.html" class="c">Go to Homepage</a>
		</div>
	<?php	
		}	
	?>
</body>
</html>
<?php
	if(isset($_POST["deliver"])){
		$id=$_POST['hidden_id'];
		$sql="UPDATE orders set STATUS='DELIVERED' WHERE ORDER_ID='$id'";
		if(mysqli_query($con,$sql)){
			echo "<script>alert('Order Delivered');</script>";
			echo "<script>window.location='viewOrders.php'</script>";
		}
		else{
			echo "<script>alert('Order Delivery Failed');</script>";
			echo "<script>window.location='viewOrders.php'</script>";
		}
	}
?>