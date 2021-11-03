<?php
	session_start();
	unset($_SESSION['cus_name']);
	unset($_SESSION['user_id']);
	unset($_SESSION['cart']);
	header("location: login.php");
?>