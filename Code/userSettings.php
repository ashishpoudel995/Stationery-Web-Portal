<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		*{
			margin: 0;
			padding: 0;
		}
		body{
			background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.8)), url(background.jpg);
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
		form { 
			border: 3px solid #f1f1f1; 
			margin-left: 560px;
			margin-right: 580px;
			margin-top: 10px;
		}
		label{
			font-size: 18px;
		}
		input[type=text], 
		input[type=password] { 
			width: 100%; 
			padding: 12px 20px; 
			margin: 8px 0; 
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
		span.psw { 
			float: right;
		} 
		a{
			text-decoration: none;
		}
		.title{
			margin-left: 600px;
			margin-top: 20px;
		}
		.title h1{
			color:#fff;
		}
		.hi{
			font-size: 20px;
		}
	</style>
</head>
<body>
	<div class="header">
		<p style="color:white;font-size: 30px; float: left;margin-left: 50px;">Stationery Web Portal</p>
		<ul>
			<li><a href="shopping.php">Shopping Page</a></li>
			<li class="active"><a href="#">User Settings</a></li>
			<li><a href="contactus.html">Contact Us</a></li>
		</ul>
	</div>
	<div class="title">
		<h1>CHANGE PASSWORD</h1>
	</div>
	<form method="post"> 
		<div class="imgcontainer"> 
			<img src= "avatar.png" alt="Avatar" class="avatar"> 
		</div> 

		<div class="container"> 
			<span class="hi">Hi <?php echo $_SESSION['username'];?>,</span><br><br>
			<label><b>Enter Current Password</b></label> <br>
			<input type="password" placeholder="Enter Current Password" id="cpsw" name="cpsw" required> 
			<label><b>Enter New Password</b></label> <br>
			<input type="password" placeholder="Enter New Password" id="psw" name="psw" required> 
			<label><b>Retype New Password</b></label> <br>
			<input type="password" placeholder="Retype New Password" id="rpsw" name="rpsw" required> 
			<input type="submit" name="submit" value="Change Password"><br>
		</div>
	</form> 
</body>
</html>
<?php
	if(isset($_POST['submit'])){
		$cpsw=$_POST['cpsw'];
		$psw=$_POST['psw'];
		$rpsw=$_POST['rpsw'];
		if($psw!=$rpsw){
			echo "<script>alert('The entered passwords do not match')</script>";
			echo "<script>window.location='userSettings.php'</script>";
		}
		else{
			require_once "dbconnection.php";
			$username=$_SESSION['username'];
			$query="select * from login where USER_NAME='$username' and PASSWORD='$cpsw'";
			$res=mysqli_query($con,$query);
			if(mysqli_num_rows($res)==1){
				$sql="update login set PASSWORD='$psw' where USER_NAME='$username'";
				if(mysqli_query($con,$sql)){
					echo "<script>alert('Password Changed Successfully')</script>";
					echo "<script>window.location='userSettings.php'</script>";
				}
			}
			else{
				echo "<script>alert('The entered password is incorrect')</script>";
				echo "<script>window.location='userSettings.php'</script>";
			}
		}
	}
?>