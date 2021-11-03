<?php
	
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	$host = "localhost";
	$user = "root";
	$pass = "";
	$database = "tradebay_db";

	$db = mysqli_connect($host,$user,$pass,$database);
?>