<?php
	session_start();

	//check if product is already in the cart
	if(!in_array($_GET['fid'], $_SESSION['cart'])){
		array_push($_SESSION['cart'], $_GET['fid']);
		$_SESSION['message'] = 'Food added to cart';
	}
	else{
		$_SESSION['message'] = 'Food already in cart';
	}

	header('location: index.php#mymenu');
?>