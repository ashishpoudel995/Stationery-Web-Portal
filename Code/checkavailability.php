<?php
	session_start();
	$availability=$_SESSION['availability'];
	if($availability==false){
		echo "<script>alert('Either one or more items are unavailable at the moment')</script>";
		echo "<script>window.location='cart.php'</script>";
	}
	else{
		echo "<script>window.location='checkout.php'</script>";
	}
?>