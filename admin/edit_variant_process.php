<?php
	$id = $_GET['id'];

	$query = "SELECT * FROM weight_unit_tbl";
	$result = mysqli_query($db,$query);
	$show = mysqli_fetch_assoc($result);

	$query1 = "SELECT * FROM product_variation_tbl WHERE product_variation_id = '$id'";
	$result1 = mysqli_query($db,$query1);
	$show1 = mysqli_fetch_assoc($result1);

	if (isset($_POST['save'])) {
		$prod_id = $_POST['product_id'];
		$to_save_id = $_POST['id'];
		$size = $_POST['size'];
		$value = $_POST['value'];
		$price = $_POST['price'];

		$que = "UPDATE `product_variation_tbl` SET weight_value='$value',price='$price', weight_unit_id='$size' WHERE product_variation_id = '$to_save_id'";
		$result2 = mysqli_query($db,$que);
		echo  '<script> window.location.href="manage_product.php?id='.$prod_id.'";</script>';

	}
	if (isset($_POST['back'])) {
		$prod_id = $_POST['product_id'];
		echo  '<script> window.location.href="manage_product.php?id='.$prod_id.'";</script>';
	}
?>