<?php
	require_once "dbconnection.php";
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
		.add{
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
		   }
	</style>
</head>
<body>
	<div class="header">
		<p style="color:white;font-size: 30px; float: left;margin-left: 50px;">Stationery Web Portal</p>
		<ul>
			<li><a href="adminChoice.html">Home Page</a></li>
			<li class="active"><a href="#">View Stock</a></li>
			<li><a href="homepage.html" onclick="logout();">Log Out</a></li>
		</ul>
		<script type="text/javascript">
			function logout(){
				alert('Logged Out Successfully');
			}
		</script>
	</div>
	<div class="title">
		<h1>VIEW STOCK</h1>
	</div>
	<?php
		  $result = mysqli_query($con, "SELECT * FROM product");
		while ($row = mysqli_fetch_array($result)) {
      		echo "<div id='img_div'>";
      		echo "<img src='images/".$row['IMAGE']."' ><br><br>";
      		echo "<p>PRODUCT ID: ".$row['PRODUCT_ID']."</p>";
      		echo "<p>NAME: ".$row['PRODUCT_NAME']."</p>";
      		if($row['STOCK_QUANTITY']>0){
      			echo "<p>STOCK QUANTITY: ".$row['STOCK_QUANTITY']."</p>";
      		}
      		else{
      			echo "<p style='color:red;'><b>Out Of Stock</b></p>";
      		}
      		echo "<p>RATE: Rs.".$row['PRICE']."/piece</p>";
      		echo "</div>";
      	}
    ?>
</body>
</html>