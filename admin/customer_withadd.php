<?php
	include('../include/dbconnection.php');
	include('../include/validate.php');
	include('../include/header.php');
	include('../include/navbar.php');

	$query3 = "SELECT * FROM customer_tbl";
	$result3 = mysqli_query($db,$query3);
	$show_cust = mysqli_fetch_assoc($result3);


	if (isset($_POST['add_btn'])) {
		$fname = $_POST['f_name'];
		$lname = $_POST['l_name'];
		$house_no = $_POST['house_no'];
		$brgy = $_POST['brgy'];
		$city = $_POST['city'];
		$province = $_POST['province'];
		$email = $_POST['email'];
		$username = $_POST['user'];
		$phone = $_POST['phone'];


		if (!empty($fname) && !empty($lname) && !empty($house_no) && !empty($brgy) && !empty($city) && !empty($province) && !empty($email) && !empty($phone) && !empty($username) && !empty($pass) && !empty($con_pass)) 
		{
			
			$query = "SELECT customer_email FROM customer_tbl where customer_email = '$email'";
			$email_res = mysqli_query($db,$query);

			$query = "SELECT customer_username FROM customer_tbl where customer_username = '$username'";
			$user_res = mysqli_query($db,$query);

			$query = "SELECT customer_phonenumber FROM customer_tbl where customer_phonenumber = '$phone'";
			$phone_res = mysqli_query($db,$query);


			if (mysqli_num_rows($email_res)) {
				echo '<script> alert("Email already exist") </script>';
			}else if(mysqli_num_rows($user_res)){
				echo '<script> alert("Username already exist") </script>';
			}else if(mysqli_num_rows($phone_res)){
				echo '<script> alert("Phone number already exist") </script>';
			}
			else
			{
				
				
				$query1 = "INSERT INTO `customer_tbl`(`customer_id`, `customer_fname`, `customer_lname`, `house_no`, `barangay`, `city`, `province`, `customer_email`, `customer_phonenumber`, `customer_username`, `customer_password`) VALUES ('$fname','$lname','$house_no','$brgy','$city', '$province','$email', '$username','$phone','$password')";
				mysqli_query($db,$query1);
			}
		}
		else
		{
			header("location: customer.php?error=Please fill all required fields!");
		}
	}

	if (isset($_POST['delete'])) {
		$user = $_POST['user_id'];

		$query4 = "DELETE FROM `customer_tbl` WHERE customer_id = '$user'";
		mysqli_query($db,$query4);
		header("location: customer.php");
	}

	if (isset($_POST['edit'])) {

		$user = $_POST['user_id']; 
		header("location: edit_user.php?id=$user");
	}
?>

<!-- Modal for add product-->
			  <div id="add_user" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <div class="modal-content">
			      <div class="modal-header">
			      	<button type="button" id="button1" class="close" data-dismiss="modal">&times;</button>
			        	<h4 class="modal-title">Add Customer</h4>
			      </div>
			      	<!--form-->
			      	<form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
			      		<div class="modal-body">
			      				<?php if(isset($_GET['error']) && !empty($_GET['error'])) { ?>
									<div class="alert alert-danger" role="alert">
									  	<?php echo $_GET['error']; ?>
									</div>
								<?php } ?>
			      				<h4>User Information</h4>
							  	<div class="form-group">
							    	<label for="f_name">First Name: <span>*</span></label>
							   	 	<input type="text" class="form-control" name="f_name" placeholder="first name">
							  	</div>
							  	<div class="form-group">
							    	<label for="l_name">Last Name: <span>*</span></label>
							   	 	<input type="text" class="form-control" name="l_name" placeholder="last name">
							  	</div>
							  	<div class="form-group">
							    	<label for="address">House No#: <span>*</span></label>
							   	 	<input type="text" class="form-control" name="house_no" placeholder="#">
							  	</div>
							  	<div class="form-group">
							    	<label for="address">Barangay: <span>*</span></label>
							   	 	<input type="text" class="form-control" name="brgy" placeholder="ex. Sumacab este">
							  	</div>
							  	<div class="form-group">
							    	<label for="address">City: <span>*</span></label>
							   	 	<input type="text" class="form-control" name="city" placeholder="ex. Cabanatuan City">
							  	</div>
							  	<div class="form-group">
							    	<label for="address">Province: <span>*</span></label>
							   	 	<input type="text" class="form-control" name="province" placeholder="ex. Nueva Ecija">
							  	</div>
							  	<div class="form-group">
							    	<label for="email">Email address: <span>*</span></label>
							   	 	<input type="text" class="form-control" name="email" placeholder="example@gmail.com">
							  	</div>
							  	<div class="form-group">
							    	<label for="phone">Phone number: <span>*</span></label>
							   	 	<input type="tel" class="form-control" name="phone" placeholder="+63xxxxxxxxx">
							  	</div>
							  	<div class="form-group">
							    	<label for="user">Username: <span>*</span></label>
							   	 	<input type="text" class="form-control" name="user" placeholder="username">
							  	</div>
							  	<div class="form-group">
							    	<label for="pass">Password: <span>*</span></label>
							   	 	<input type="password" class="form-control" name="pass" placeholder="password">
							  	</div>
							  	<div class="form-group">
							    	<label for="con_pass">Confirm password: <span>*</span></label>
							   	 	<input type="password" class="form-control" name="con_pass" placeholder="confirm password">
							  	</div>

					    </div>
					    <div class="modal-footer">
					        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        	<button type="submit" class="btn btn-primary" name="add_btn">Add</button>
					    </div>
			    </div>
			    </form>
			  </div>
			</div>
			<!--end of modal-->

	<div class="content">
		<div class="for_title">
			<h2>Users</h2>
		</div>
		<div class="my_content">

			<div class="panel panel-default">
			  	<div class="panel-heading" style="height: 55px">
			  		<button type="button" class="btn btn-primary" style="margin-left: -50%; float:right;" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
			  	</div>
			  	<div class="panel-body">

			  		<div class="container" style="width: 100%; height: 600px; overflow: auto;">
			  			<table class="table table-striped">
			  				<thead>
			  					<tr>
			  						<th>Customer ID#</th>
			  						<th>Full name</th>
			  						<th>Address</th>
			  						<th>Email</th>
			  						<th>Phone number</th>
			  						<th>Actions</th>
			  					</tr>
			  				</thead>
			  				<tbody>
			  					<?php 
			  						if (mysqli_num_rows($result3) ==0) {
			  							?>
			  								<tr>
			  									<td colspan="6" class="text-center">No Entry<td>
			  								</tr>
			  							<?php
			  						}
			  						else{

			  							do{
			  						
			  					?>
			  						<tr>
			  							<td><?php echo $show_cust['customer_id']; ?></td>
			  							<td><?php echo ''.$show_cust['first_name'].' '.$show_cust['last_name'].''; ?></td>
			  							<td><?php echo '#'.$show_cust['house_no'].'/'.$show_cust['barangay'].'/'.$show_cust['city'].'/'.$show_cust['province'].''; ?></td>
			  							<td><?php echo $show_cust['email']; ?></td>
			  							<td><?php echo $show_cust['phone_number']; ?></td>
			  							<td>
			  								<form method="POST">
				  								<input type="hidden" name="user_id" value="<?php echo $show_cust['customer_id']; ?>">
				  								<button type="submit" name="edit" class="btn btn-success">
				  									<i class="fa fa-eraser" aria-hidden="true" ></i> Edit
				  								</button>
				  								<button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete <?php echo ''.$show_cust['first_name'].' '.$show_cust['last_name'].''; ?>?')">
				  									<i class="fa fa-ban" aria-hidden="true" ></i> Delete
				  								</button>
				  							</form>
			  							</td>
			  						</tr>
			  					<?php
			  							}while ($show_cust = mysqli_fetch_assoc($result3)); 
			  						}
			  					?>
			  				</tbody>
			  				
			  			</table>
			  		</div>
			  		
			  	</div>
			</div>
			
		</div>
	</div>


