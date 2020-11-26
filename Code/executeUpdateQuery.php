<?php
	require_once "dbconnection.php";
	if(isset($_POST['submit'])){
		$productid=$_POST['productid'];
		$count=0;
		if(isset($_POST['productname']) && !empty($_POST['productname']))
		{
			$productname=$_POST['productname'];
			$sql="update product set PRODUCT_NAME='$productname' where PRODUCT_ID='$productid'";
			if(mysqli_query($con,$sql))
			{
				$count+=1;
			}
		}
		if(isset($_POST['rate']) && !empty($_POST['rate']))
		{
			$rate=$_POST['rate'];
			$sql="update product set PRICE='$rate' where PRODUCT_ID='$productid'";
			if(mysqli_query($con,$sql))
			{
				$count+=1;
			}
		}
		if(isset($_POST['quantity']) && !empty($_POST['quantity']))
		{
			$quantity=$_POST['quantity'];
			$sql="update product set STOCK_QUANTITY='$quantity' where PRODUCT_ID='$productid'";
			if(mysqli_query($con,$sql))
			{
				$count+=1;
			}
		}
		if($count>0)
		{
			echo "<script>alert('Data Modified Successfully')</script>";
			echo "<script>window.location='adminChoice.html'</script>";
		}
		else
		{
			echo "<script>alert('Data Modification Failed')</script>";
			echo "<script>window.location='updateStock.html'</script>";
		}
	}
	else{
		echo "<script>alert('GG')</script>";
	}	
?>