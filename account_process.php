<?php 

	if (isset($_POST['save_btn'])) {

		$cus_id = $_POST['cus_id'];
 		$fname = $_POST['fname'];
 		$lname = $_POST['lname'];
 		$user = $_POST['username'];
 		$email = $_POST['email'];
 		$contact = $_POST['contact'];
 		$house_no = $_POST['house'];
 		$brgy = $_POST['brgy'];
 		$city = $_POST['city'];
 		$province = $_POST['province'];

		$que = "UPDATE `customer_tbl` SET `first_name`='$fname',`last_name`='lname',`house_no`='$house_no',`barangay`='$brgy',`city`='$city',`province`='$province',`phone_number`='$contact',`email`='$email' WHERE `customer_id`= '$cus_id'";
		$result2 = mysqli_query($db,$que);
		header("location: account.php");
	}

 ?>