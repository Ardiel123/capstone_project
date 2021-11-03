<?php
	include('../include/dbconnection.php');
	include('../include/validate.php');
	include('../include/header.php');
	include('../include/navbar.php');

	$id = $_GET['id'];

	$query = "SELECT * FROM customer_tbl WHERE customer_id = '$id'";
	$result = mysqli_query($db,$query);
	$show_user = mysqli_fetch_assoc($result);

	if (isset($_POST['cancel_btn'])) {
		header("location: customer.php");
	}

	if (isset($_POST['save_btn'])) {
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$house_no = $_POST['house_no'];
		$brgy = $_POST['brgy'];
		$city = $_POST['city'];
		$province = $_POST['province'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];

		if (!empty($fname) && !empty($lname) && !empty($house_no) && !empty($brgy) && !empty($city) && !empty($province) && !empty($email) && !empty($phone)) {
			
			$query2 = "UPDATE `customer_tbl` SET `customer_fname`='$fname',`customer_lname`='$lname',`house_no`='$house_no',`barangay`='$brgy',`city`='$city',`province`='$province',`customer_email`='$email',`customer_phonenumber`='$phone' WHERE customer_id = '$id'";
			mysqli_query($db,$query2);

			header("location: customer.php");
		}
	}

?>
	<div class="content">
		<div class="for_title">
			<h2>Edit User</h2>
		</div>
		<div class="my_content">
			<div class="panel panel-default" style="width: 50%;">
			  	<div class="panel-heading" style="height: 55px">

			  	</div>
			  	<div class="panel-body">

			  		<form  method="POST">
						<div class="form-group">
							<label for="fname">First name:</label>
							<input class="form-control" type="text" name="fname" value="<?php echo $show_user['customer_fname']; ?>">
						</div>
						<div class="form-group">
							<label for="lname">Last name:</label>
							<input class="form-control" type="text" name="lname" value="<?php echo $show_user['customer_lname']; ?>">
						</div>
						<div class="form-group">
							<label for="address">House No#:</label>
							<input class="form-control" type="text" name="house_no" value="<?php echo $show_user['house_no']; ?>">
						</div>
						<div class="form-group">
							<label for="address">Barangay:</label>
							<input class="form-control" type="text" name="brgy" value="<?php echo $show_user['barangay']; ?>">
						</div>
						<div class="form-group">
							<label for="address">City:</label>
							<input class="form-control" type="text" name="city" value="<?php echo $show_user['city']; ?>">
						</div>
						<div class="form-group">
							<label for="address">Province:</label>
							<input class="form-control" type="text" name="province" value="<?php echo $show_user['province']; ?>">
						</div>
						<div class="form-group">
							<label for="email">Email address:</label>
							<input class="form-control" type="text" name="email" value="<?php echo $show_user['customer_email']; ?>">
						</div>
						<div class="form-group">
							<label for="phone">Phone number:</label>
							<input class="form-control" type="text" name="phone" value="<?php echo $show_user['customer_phonenumber']; ?>">
						</div>
						<div class="form-group">
							<button type="submit" name="cancel_btn" class="btn btn-default">Back</button>
							<button type="submit" name="save_btn" class="btn btn-primary">Save</button>
						</div>
					</form>
			</div>
			
		</div>
	</div>
