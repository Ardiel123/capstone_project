<?php
	include ('../include/dbconnection.php');

	if(isset($_GET['vkey'])){
		$vkey = $_GET['vkey'];

		$check = "SELECT verification_key,status FROM account_tbl WHERE status = 0 AND verification_key = '$vkey' LIMIT 1";
		$result = mysqli_query($db, $check);

		if(mysqli_num_rows($result)==1){
			$update = "UPDATE account_tbl SET status = 1 WHERE verification_key = '$vkey' LIMIT 1";
			$result2 = mysqli_query($db, $update);

			if($result2){
				echo "Verification success!";
				header("location:../login.php");
			}
			else
			{
				echo "Failed to verify";
			}
		}
		else{
			echo "This Account is invalid or already verified";
		}

	}else{

		die("Something went wrong");
	}
?>