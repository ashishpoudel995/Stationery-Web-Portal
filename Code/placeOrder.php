<?php
	require_once "dbconnection.php";
	session_start();
	$username=$_SESSION["username"];
	$firstname=$_POST['fname'];
	$lastname=$_POST['lname'];
	$phoneno=$_POST['phoneno'];
	$address=$_POST['address'];
	$sql="select * from cart where USERNAME='$username'";
	$res=mysqli_query($con,$sql);
	echo mysqli_num_rows($res);
	while($values=mysqli_fetch_array($res)){
		$prodid=$values['PRODUCT_ID'];
		$prodname=$values['PRODUCT_NAME'];
		$quantity=$values['QUANTITY'];
		$rate=$values['RATE'];
		$cost=$values['TOTAL'];
		$servicecharge=$values['SERVICE_CHARGE'];
		$vat=$values['VAT'];
		$totalprice=$values['TOTAL_COST'];
		$cartid=$values['CART_ADD_ID'];
		$flag=true;
		$sql="INSERT INTO orders(FIRST_NAME,LAST_NAME,PHONE_NO,ADDRESS,USERNAME,PRODID,PRODNAME,QUANTITY,RATE,COST,SERVICE_CHARGE,VAT,TOTALPRICE,STATUS) values('$firstname','$lastname','$phoneno','$address','$username','$prodid','$prodname','$quantity','$rate','$cost','$servicecharge','$vat','$totalprice','PENDING')";
		if(mysqli_query($con,$sql)){
			$sql="select * from product where PRODUCT_ID='$prodid'";
			$result=mysqli_query($con,$sql);
			$row=mysqli_fetch_assoc($result);
			$remquantity=$row['STOCK_QUANTITY']-$quantity;
			$sql="update product set STOCK_QUANTITY='$remquantity' where PRODUCT_ID='$prodid'";
			if(mysqli_query($con,$sql)){
				$sql="delete from cart where CART_ADD_ID='$cartid'";
				if(mysqli_query($con,$sql)){
					$flag=true;
				}
				else $flag=false;
			}
			else $flag=false;				
		}
		else $flag=false;
	}
	if($flag==true){
		echo "<script>alert('Order Placed Successfully')</script>";
		echo "<script>window.location='shopping.php'</script>";
	}
	else{
		echo "<script>alert('Order Failed')<script>";
		echo "<script>window.location='cart.php'</script>";
	}
?>