<?php
	require_once "dbconnection.php";
	session_start();
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
			background-repeat: no-repeat;
 			background-attachment: fixed;
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
		label{
			width: 150px;
			display: inline-block;
			text-align: left;
			margin-left: 50px;
		}
		input[type="number"]{
			width: 90px;
			height: 20px;
		  	border: 1px solid #ccc;
		  	border-radius: 5px;
		}
		input[type="submit"]{
			padding: 5px;
			margin-left: 10px;
			background-color: #4CAF50;
			color: white; 
			border: none; 
			cursor: pointer; 
		}
		form{
			font-size: 20px;
		}
		.title{
			margin-left: 650px;
			margin-top: 20px;	
		}
		.title h1{
			color: white;		
		}
		#img_div{
		  width: 29.5%;
		  padding: 5px;
		  margin: 20px;
		  border:2px solid black;
		  display: inline-block;
		  color:white;
		  background-color: #28231D;
		 }
		   img{
		   	float: left;
		   	margin: 5px;
		   	height: 140px;
		   	width: 250px;
		   }
		   .na{
		   		width: 300px;
		   		margin-left: 55px;
		   }
	</style>
</head>
<body>
	<div class="header">
		<p style="color:white;font-size: 30px; float: left;margin-left: 50px;">Stationery Web Portal</p>
		<ul>
			<li><a href="customerChoice.html">Home Page</a></li>
			<li class="active"><a href="#">Shopping Page</a></li>
			<li><a href="cart.php">My Cart</a></li>
			<li><a href="customerOrderStatus.php">Order Status</a></li>
			<li><a href="homepage.html" onclick="logout();">Log Out</a></li>
		</ul>
		<script type="text/javascript">
			function logout(){
				alert('Logged Out Successfully');
			}
		</script>
	</div>
	<div class="title">
		<h1>SHOPPING PAGE</h1>
	</div>
	<?php
		  $result = mysqli_query($con, "SELECT * FROM product");
		while ($row = mysqli_fetch_array($result)) {
      		echo "<div id='img_div'>";
      		echo "<img src='images/".$row['IMAGE']."' ><br><br>";
      		echo "<p>PRODUCT ID: ".$row['PRODUCT_ID']."</p>";
      		echo "<p>NAME: ".$row['PRODUCT_NAME']."</p>";
      		echo "<p>STOCK QUANTITY: ".$row['STOCK_QUANTITY']."</p>";
      		echo "<p>RATE: Rs.".$row['PRICE']."/piece</p>";
    	if($row['STOCK_QUANTITY']>0){
    ?>
    		<form method="post">
    			<input type="hidden" name="hidden_image" value="<?php echo($row['IMAGE']) ?>">
    			<input type="hidden" name="hidden_id" value="<?php echo($row['PRODUCT_ID'])?>">
    			<input type="hidden" name="hidden_name" value="<?php echo($row['PRODUCT_NAME'])?>">
    			<input type="hidden" name="hidden_rate" value="<?php echo($row['PRICE'])?>">
    			<label for="quantity">Enter Quantity:</label>
    			<input type="number" name="quantity" min="1" max="<?php echo($row['STOCK_QUANTITY'])?>" required>
    			<input type="submit" name="submit" value="Add To Cart">
    		</form>
    <?php
    	}
    	else{
    	?>
    		<div class="na">
    			<br><br>
    			<p style="font-size: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red;"><strike>Available</strike>&emsp;(Out Of Stock)</span></p>
    		</div>
    <?php
		}
      	echo "</div>";
      	}
    ?>
</body>
</html>
<?php
	if(isset($_POST["submit"]))
	{
		$username=$_SESSION["username"];
		$productid=$_POST['hidden_id'];
		$productname=$_POST['hidden_name'];
		$productimage=$_POST['hidden_image'];
		$quantity=$_POST['quantity'];
		$rate=$_POST['hidden_rate'];
		$total=$quantity*$rate;
		$servicecharge=0.15*$total;
		$vat=0.13*($total+$servicecharge);
		$totalcost=$total+$servicecharge+$vat;
		$query="insert into cart(USERNAME,PRODUCT_ID,PRODUCT_NAME,IMAGE,QUANTITY,RATE,TOTAL,SERVICE_CHARGE,VAT,TOTAL_COST) values('$username','$productid','$productname','$productimage','$quantity','$rate','$total','$servicecharge','$vat','$totalcost')";
		if(mysqli_query($con,$query)){
			echo "<script>alert('Item Added to the cart')</script>";
		}
		else{
			echo "<script>Item Addition Failed</script>";
		}
	}
?>