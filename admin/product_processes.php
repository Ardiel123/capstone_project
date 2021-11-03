<?php  
	include('../include/dbconnection.php');
	
	$query = "SELECT product_details_tbl.product_details_id, product_details_tbl.product_image, category_tbl.category_name, product_details_tbl.product_name, product_details_tbl.product_description, product_details_tbl.date_posted FROM product_details_tbl JOIN category_tbl WHERE product_details_tbl.category_id = category_tbl.category_id ORDER BY date_posted ASC";
	$result = mysqli_query($db,$query);
	$show_products = mysqli_fetch_assoc($result);

	$query2 = "SELECT * FROM category_tbl";
	$result2 = mysqli_query($db,$query2);
	$categories = mysqli_fetch_assoc($result2);

	$query3 = "SELECT * FROM category_tbl";
	$result3 = mysqli_query($db,$query3);
	$category = mysqli_fetch_assoc($result3);

	$query5 = "SELECT * FROM category_tbl";
	$result5 = mysqli_query($db,$query5);
	$category5 = mysqli_fetch_assoc($result5);

	$query4 = "SELECT * FROM weight_unit_tbl";
	$result4 = mysqli_query($db,$query4);
	$weight_unit = mysqli_fetch_assoc($result4);


	if(isset($_POST['add_btn'])){	

		if (!empty( $_POST['name']) && !empty($_POST['description']) && !empty( $_POST['category']) && !empty( $_POST['size']) && !empty( $_POST['per_price']))
		{

		$name = $_POST['name'];
		$desc = mysqli_real_escape_string($db,$_POST['description']);
		$category = $_POST['category'];
		
		$file = $_FILES['img']['name'];
		$tmp_name = $_FILES['img']['tmp_name'];

		$div = explode('.', $file);
		$ext = strtolower(end($div));
		$unique_name = md5($div[0].time()).'.'.$ext;

		$destination ="../img/".$unique_name;
		$destination1 = "img/".$unique_name;
		move_uploaded_file($tmp_name, $destination);

		$query5 = "SELECT * FROM product_details_tbl WHERE product_name = '$name' AND category_id = '$category'";
		$result5 = mysqli_query($db, $query5);

			if (mysqli_num_rows($result5) == 0) {
				$insert_product = "INSERT INTO `product_details_tbl`(`product_name`, `product_description`, `product_image`, `category_id`) VALUES ('$name','$desc','$destination1','$category')";
				mysqli_query($db, $insert_product);

				$last_id_query = "SELECT MAX(product_details_id) AS last_id FROM product_details_tbl";
				$execute_last_id = mysqli_query($db,$last_id_query);
				$show_last_id = mysqli_fetch_assoc($execute_last_id);

				$the_last_id = $show_last_id['last_id'];

				$size = $_POST['size'];
				$value = $_POST['value'];
				$per_price = $_POST['per_price'];

				$insert_det = "INSERT INTO product_variation_tbl(product_details_id,weight_unit_id,weight_value,price) VALUES('$the_last_id','$size','$value','$per_price')";
				$result6 = mysqli_query($db,$insert_det);
				header("location: manage_product.php?id=$the_last_id");
			}	
			else
			{
				echo '<script> alert("Product already exist!")</script>';
			}
		}
		else
		{
			echo '<script> alert("Please fill all required fields") </script>';
		}

		
	}

?>