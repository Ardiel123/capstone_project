<?php  
	include('../include/dbconnection.php');

	$product_details_id = $_GET['id'];

	$query = "SELECT * from product_details_tbl where product_details_id = '$product_details_id'";
	$result=mysqli_query($db,$query);
	$products = mysqli_fetch_assoc($result);

	$query1 = "SELECT * FROM category_tbl";
	$result1 = mysqli_query($db,$query1);
	$categories = mysqli_fetch_assoc($result1);

	$query2 = "SELECT product_variation_tbl.product_variation_id,weight_unit_tbl.abbreviation,product_variation_tbl.weight_value,product_variation_tbl.price FROM product_variation_tbl JOIN weight_unit_tbl WHERE product_variation_tbl.weight_unit_id = weight_unit_tbl.weight_unit_id AND product_details_id = '$product_details_id'";
	$result2 = mysqli_query($db,$query2);
	$product_details = mysqli_fetch_assoc($result2);

	$query3 = "SELECT * FROM weight_unit_tbl";
	$result3 = mysqli_query($db,$query3);
	$weight_unit = mysqli_fetch_assoc($result3);

	if (isset($_POST['add_size_btn'])) {

		$size = $_POST['size'];
		$per_value = $_POST['per_value'];
		$price = $_POST['price_persize'];

		$query6 = "SELECT * FROM product_variation_tbl WHERE (weight_unit_id = '$size' AND weight_value = '$per_value') AND product_details_id = '$product_details_id'";
		$result6 = mysqli_query($db, $query6);

		if (mysqli_num_rows($result6) == 0) {
		
			$query4 = "INSERT INTO product_variation_tbl(product_details_id,weight_unit_id,weight_value,price) VALUES('$product_details_id','$size','$per_value','$price')";
			$result4 = mysqli_query($db,$query4);
			header("location: manage_product.php?id=$product_details_id");
		}
		else
		{
			echo '<script> alert("The variant youre trying to add already exist!")</script>';
		}

	}
	if (isset($_POST['delete'])) {

		$details_id = $_POST['details_id'];

		$query5 = "DELETE FROM `product_variation_tbl` WHERE product_variation_id = '$details_id'";
		$result5 = mysqli_query($db,$query5);
		header("location: manage_product.php?id=$product_details_id");
	
	}

	if (isset($_POST['edit'])) {

		$details_id = $_POST['details_id']; 
		header("location: edit_variant.php?id=$details_id");
	}

	if(isset($_POST['save_all'])){
		$category = $_POST['category'];
		$name = $_POST['name'];
		$desc = $_POST['description'];
		

		$update = "UPDATE product_details_tbl set category_id='$category', product_name='$name', product_description='$desc' WHERE product_details_id='$product_details_id'";
		mysqli_query($db,$update);

		if($_FILES['img']['name'] != ""){

			$file = $_FILES['img']['name'];
			$tmp_name = $_FILES['img']['tmp_name'];

			$div = explode('.', $file);
			$ext = strtolower(end($div));
			$unique_name = md5($div[0].time()).'.'.$ext;

			$destination ="../img/".$unique_name;
			$destination1 = "img/".$unique_name;
			move_uploaded_file($tmp_name, $destination);

			$update_img = "UPDATE product_details_tbl set product_image = '$destination1' WHERE product_details_id='$product_details_id'";
			mysqli_query($db,$update_img);

		}

		header("location:product.php");
	}

	if (isset($_POST['back'])) {
		header("location:product.php");
	}


?>