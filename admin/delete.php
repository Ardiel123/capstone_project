<?php
include("../include/dbconnection.php");

		$id = $_GET['id'];

		$quer1 = "DELETE FROM product_variation_tbl WHERE product_details_id = '$id'";
		$res1 = mysqli_query($db,$quer1);

		$quer = "DELETE FROM product_details_tbl WHERE product_details_id = '$id'";
		$res = mysqli_query($db,$quer);

		if($res && $res1){
			echo "<script>
				alert('Deleted Successfully.');
				window.location.href='product.php';
			</script>";
		}else{
			echo "<script>
				alert('The item you wish to delete is in order progress.');
				window.location.href='product.php';
			</script>";
		}


?>