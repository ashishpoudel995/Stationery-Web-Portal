<?php
	require_once "dbconnection.php";
	if(isset($_POST['submit'])){
		$productid=$_POST['productid'];
		$sql="select * from product where PRODUCT_ID='$productid'";
		$res=mysqli_query($con,$sql);
		if(mysqli_num_rows($res)>0){
			echo "<script>alert('Product ID already in Database')</script>";
			echo "<script>window.location='addStock.html'</script>";
		}
		$image = $_FILES['image']['name'];
		$target = "images/".basename($image);
		$valid = getimagesize($_FILES["image"]["tmp_name"]);
		if($valid==false){
			echo "<script>alert('The uploaded File is not an image. Please Try Again !')</script>";
			echo "<script>window.location='addStock.html'</script>";
		}
		else{
			$productname=$_POST['productname'];
			$quantity=$_POST['quantity'];
			$rate=$_POST['rate'];
			$sql="insert into product(PRODUCT_ID,PRODUCT_NAME,STOCK_QUANTITY,PRICE,IMAGE) values('$productid','$productname','$quantity','$rate','$image')";
			if(mysqli_query($con,$sql)){
				if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
					echo "<script>alert('Stock Added !')</script>";
				}
				else{
					echo "<script>alert('Image Upload Failed...')</script>";
				}
			}
			echo "<script>window.location='addStock.html'</script>";
		}
	}
?>