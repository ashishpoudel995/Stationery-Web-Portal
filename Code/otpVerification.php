<?php
	require_once "dbconnection.php";
	$email=$_POST['email'];
	$sql="select * from login where email='$email'";
	$res=mysqli_query($con,$sql);
	if(mysqli_num_rows($res)>0){
		echo "<script>alert('There is an existing account with the entered email!')</script>";
		echo "<script>window.location='signUp.html'</script>";
	}
	$username=$_POST['username'];
	$sql="select * from login where USER_NAME='$username'";
	$res=mysqli_query($con,$sql);
	if(mysqli_num_rows($res)>0){
		echo "<script>alert('User Name already taken!')</script>";
		echo "<script>window.location='signUp.html'</script>";
	}
	$recipient=$_POST['email'];
	$otp=mt_rand(1000,9999);
	session_start();
	$_SESSION['otp']=$otp;
	$message= "Your OTP for signing in to the Stationery Web Portal is: ".$otp;
	if(!mail($recipient,"OTP Verification",$message)){
		echo "<script>alert('Mail Send Process Failed from Server')</script>";
		echo "<script>window.location='signUp.html'</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		*{
			margin: 0;
			padding: 0;
			font-family: Times New Roman;
		}
		body{
			background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.8)), url(background.jpg);
			height: 100vh;
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
  			background-attachment: fixed;
  			margin-bottom: 50px;
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
		form { 
			border: 3px solid #f1f1f1; 
			margin-left: 560px;
			margin-right: 580px;
			margin-top: 50px;
		}
		label{
			width: 100px;
			display: inline-block;
			text-align: left;
			font-size: 18px;
		}
		input[type=number]{ 
			width: 100%; 
			padding: 12px 20px; 
			margin: 8px 0; 
			display: inline-block; 
			border: 1px solid #ccc; 
			box-sizing: border-box; 
		} 
		input[type=submit]{ 
			background-color: #4CAF50; 
			color: white; 
			padding: 14px 20px; 
			margin: 8px 0; 
			border: none; 
			cursor: pointer; 
			width: 100%; 
		} 
		button:hover { 
			opacity: 0.8; 
		} 
		.imgcontainer { 
			text-align: center; 
			margin: 24px 0 12px 0; 
		} 
		img.avatar { 
			width: 40%; 
			border-radius: 50%; 
		} 
		.container { 
			padding: 18px; 
			color:white;
		} 
		a{
			text-decoration: none;
		}
		.title{
			margin-left: 600px;
			margin-top: 50px;
		}
		.title h1{
			color:#fff;
		}
	</style>
</head>
<body>
	<div class="header">
		<p style="color:white;font-size: 30px; float: left;margin-left: 50px;">Stationery Web Portal</p>
		<ul>
			<li><a href="homepage.html">LogIn Page</a></li>
			<li class="active"><a href="#">Home Page</a></li>
			<li><a href="contactus.html">Contact Us</a></li>
		</ul>
	</div>
	<div class="title">
		<h1>OTP VERIFICATION</h1>
	</div>
	<form  action="postSignUpDetails.php" method="post"> 
		<div class="imgcontainer"> 
			<img src= "avatar.png" alt="Avatar" class="avatar"> 
		</div> 

		<div class="container"> 
			<label for="otp">Enter OTP:</label>
			<input type="hidden" name="username" id="username" value="<?php echo($_POST['username'])?>">
			<input type="hidden" name="password" id="password" value="<?php echo($_POST['password'])?>">
			<input type="hidden" name="email" id="email" value="<?php echo($_POST['email'])?>">
			<input type="number" name="otp" id="otp" placeholder="Enter OTP Sent to Your Mail" required>
			<input type="submit" name="submit" id="submit" value="Verify OTP">
		</div>
	</form>
</body>
</html>