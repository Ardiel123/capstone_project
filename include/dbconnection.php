<?php
	
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	$host = "localhost";
	$dbusername = "root";
	$pass = "";
	$database = "tradebay_db";

	$db = mysqli_connect($host,$dbusername,$pass,$database);
?>