<?php
	session_start();
	if(isset($_POST['save'])){
		if(!empty($_SESSION['cart'])){
		foreach($_POST['indexes'] as $key){
			$_SESSION['qty_array'][$key] = $_POST['qty_'.$key];
		}

		$_SESSION['message'] = 'Cart updated successfully';
		header('location: checkout.php');
		}
		else{
			$_SESSION['message'] = 'Cart can NOT be empty!';
			header('location: view_cart.php');
		}
	}
?>
