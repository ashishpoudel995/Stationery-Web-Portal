<?php
	require_once "dbconnection.php";
	$count=0;
	if(isset($_POST['Submit'])){
		$productid=$_POST['productid'];
		$sql="select * from product where PRODUCT_ID='$productid'";
		$res=mysqli_query($con,$sql);
		if(mysqli_num_rows($res)>0)
		{
			while($row=mysqli_fetch_assoc($res))
			{
				if($productid==$row['PRODUCT_ID'])
				{
					$productname=$row['PRODUCT_NAME'];
					$quantity=$row['STOCK_QUANTITY'];
					$price=$row['PRICE'];
					$count+=1;
				}
				else
				{
					$count=0;
				}
			}
		}
		if($count==0)
		{
			echo "<script>alert('Product Code not in database')</script>";
			echo "<script>window.location='updateStock.html'</script>";
		}
	}	
?>
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
		body{
			background-image:linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.6)), url(background.jpg);
			height: 100vh;
			background-size: cover;
			background-position: center;
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
		.header{
			background-color: black;
			padding: 10px;
			height: 45px;
		}
		.update{
			margin-top: 200px;
			margin-right: 550px;
			margin-left: 550px;
			padding: 10px;
		}
		label{
			width: 200px;
			display: inline-block;
			text-align: left;
		}
		input[type="text"],input[type="number"]{
			width: 160px;
			height: 20px;
		  	border: 1px solid #ccc;
		  	border-radius: 5px;
		}
		input[type="submit"]{
			margin-top: 50px;
			margin-left: 170px;
			padding: 10px;
			font-size: 14px;
			background-color: #4CAF50;
			color: white; 
			border: none; 
			cursor: pointer; 
		}
		form{
			font-size: 20px;
		}
		.title{
			position: absolute;
			top: 30%;
			left: 50%;
			transform: translate(-50%,-50%);	
		}
		.title h1{
			color: #fff;		
		}
	</style>
</head>
<body>
	<div class="header">
		<p style="color:white;font-size: 30px; float: left;margin-left: 50px;">Stationery Web Portal</p>
		<ul>
			<li><a href="adminChoice.html">Home Page</a></li>
			<li class="active"><a href="#">Add Stock</a></li>
			<li><a href="homepage.html" onclick="logout();">Log Out</a></li>
		</ul>
		<script type="text/javascript">
			function logout(){
				alert('Logged Out Successfully');
			}
		</script>
	</div>
	<div class="title">
		<h1>UPDATE STOCK</h1>
	</div>
	<div class="update">
	<form action="executeUpdateQuery.php" method="post">
		<label for="productid">Product Id:</label>
		<input type="text" name="productid" id="productid" value=<?php echo $productid ?> readonly><br><br>
		<label for="productname">Product Name:</label>
		<input type="text" id="productname" name="productname" placeholder=<?php echo $productname ?> ><br><br>
		<label for="quantity">Quantity:</label>
		<input type="number" id="quantity" name="quantity" placeholder=<?php echo $quantity ?> ><br><br>
		<label for="rate">Rate:</label>
		<input type="number" id="rate" name="rate" placeholder=<?php echo $price ?> ><br><br>
		<input type="submit" name="submit" value="Update Stock">
	</form>
	</div>
</body>
</html>