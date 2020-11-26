<?php
	session_start();
	require_once "dbconnection.php";
	if(isset($_POST['submit'])){
		$otpentered=$_POST['otp'];
		if($_SESSION['otp']!=$otpentered){
			echo "<script>alert('The entered OTP is incorrect. Retry Signing Up Again !')</script>";
			echo "<script>window.location='signUp.html'</script>";
		}
		else{
			$email=$_POST['email'];
			$username=$_POST['username'];
			$password=$_POST['password'];
			$sql="insert into login(USER_NAME,PASSWORD,email) values('$username','$password','$email')";
			if(mysqli_query($con,$sql))
				echo "<script>alert('Account Created !')</script>";
			echo "<script>window.location='homepage.html'</script>";
		}
	}