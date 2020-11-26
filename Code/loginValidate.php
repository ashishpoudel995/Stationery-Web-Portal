<?php
	require_once "dbconnection.php";
	if(isset($_POST['submit'])){
		$username=$_POST['uname'];
		$password=$_POST['psw'];
		if($username=="admin" && $password=="admin"){
			echo "<script>alert('LogIn Successful')</script>";
			echo "<script>window.location='adminChoice.html'</script>";
		}
		else{
			$sql="select * from login where USER_NAME='$username'";
			$res=mysqli_query($con,$sql);
			if(mysqli_num_rows($res)>0)
			{
				$row=mysqli_fetch_assoc($res);
				if($password==$row['PASSWORD'])
				{
					session_start();
					$_SESSION['username']=$username;
					echo "<script>alert('LogIn Successful')</script>";
					echo "<script>window.location='customerChoice.html'</script>";
				}
				else
				{
					echo "<script>alert('Incorrect Credentials')</script>";
					echo "<script>window.location='homepage.html'</script>";	
				}
			}
			else
			{
				echo "<script>alert('Incorrect Credentials')</script>";
				echo "<script>window.location='homepage.html'</script>";
			}
		}
	} 
?>