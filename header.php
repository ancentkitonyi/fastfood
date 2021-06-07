<?php include('conn.php'); 
	session_start();
	//initialize cart if not set or is unset
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}

	//unset qunatity
	unset($_SESSION['qty_array']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Anc's Fast Food</title>

	<!-- css -->
	<link href='https://fonts.googleapis.com/css?family=Great Vibes' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="css/all.css">
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css.map">
	<link rel="icon" href="img/logo2.png">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all">

	<!-- script -->
	<script src="js/jquery-3.5.1.min.js"></script>  
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/all.js"></script>
	<script type="text/javascript" src="js/foundation.js"></script>
	<script type="text/javascript" src="js/main.js"></script>


</head>