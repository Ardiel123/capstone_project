<?php 
		include('include/dbconnection.php');
		include('include/validate_user.php');
		include('include/header_user.php'); 

		$sql_profile = "SELECT * FROM customer_tbl INNER JOIN account_tbl ON customer_tbl.account_id = account_tbl.account_id   WHERE customer_id = '$_SESSION[user_id]'";
		$result_profile = mysqli_query($db,$sql_profile);
		$resultCheck_profile = mysqli_num_rows($result_profile);

		$sql_profile1 = "SELECT * FROM customer_tbl INNER JOIN account_tbl ON customer_tbl.account_id = account_tbl.account_id   WHERE customer_id = '$_SESSION[user_id]'";
		$result_profile1 = mysqli_query($db,$sql_profile1);
		$resultCheck_profile1 = mysqli_fetch_assoc($result_profile1);

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
 		echo $cus_id;

 		$que = "UPDATE customer_tbl ct INNER JOIN account_tbl act ON ct.account_id = act.account_id SET `customer_fname`='$fname',`customer_lname`='$lname',`house_no`='$house_no',`barangay`='$brgy',`city`='$city',`province`='$province',`customer_email`='$email',`customer_phonenumber`='$contact', `username` = '$user' WHERE ct.customer_id = '$cus_id'";

		
		$result2 = mysqli_query($db,$que);
		  echo  '<script> window.location.href="account.php";</script>';
	}

	if (isset($_POST['save_pass'])) {

		$acc_id = $_POST['acccc_id'];


		$current_pass = $_POST['current_pass'];
		$new_pass = $_POST['new_pass'];
		$confirm_pass = $_POST['confirm_pass'];


		if(empty($current_pass)){
				$error = "Current password cannot be empty";
				echo  '<script> 
					$(document).ready(function(){
					$("#exampleModal").modal("show");
					});
				</script>';
		}
		else if(empty($new_pass)){
				$error = "Please Input new password";
				echo  '<script> 
					$(document).ready(function(){
					$("#exampleModal").modal("show");
					});
				</script>';
		}
		else if(empty($confirm_pass)){
				$error = "Please Confirm new password";
				echo  '<script> 
					$(document).ready(function(){
					$("#exampleModal").modal("show");
					});
				</script>';

		}
		else if($new_pass != $confirm_pass){
				$error = "New Password do not match";
				echo  '<script> 
					$(document).ready(function(){
					$("#exampleModal").modal("show");
					});
				</script>';
		}
		else{

				$sql_getpass = "SELECT * FROM account_tbl WHERE account_id = '$acc_id'";
				$res_getpass = mysqli_query($db, $sql_getpass);
				$ps = mysqli_fetch_assoc($res_getpass);

				$data_password = $ps['password'];
				$cur_pass = md5($current_pass);

				if($data_password == $cur_pass){

					$n_pass = md5($new_pass); 

					$sql_updpass = "UPDATE account_tbl SET password='$n_pass' WHERE account_id = '$acc_id'";
					mysqli_query($db, $sql_updpass);

					echo  '<script> 
						$(document).ready(function(){
						$("#mymodal").modal("show");
						});
					</script>';

				}
				else{
					$error = "You've entered wrong current password";
					echo  '<script> 
						$(document).ready(function(){
						$("#exampleModal").modal("show");
						});
					</script>';
				}

	
		}

	}
		
?> 

	

 <hr class="hr1">
<div class="nav-div1">
  
<ul class="nav justify-content-center" >
    <li class="nav-item navli" >
      <a class="nav-link nav2 " href="index.php" >Home</a>
    </li>
    <li class="nav-item navli" >
      <a class="nav-link nav2 " href="products.php">Products</a>
    </li>
    <li class="nav-item navli" >
      <a class="nav-link nav2" href="services.php">Services</a>
    </li>
    
    
  </ul>
</div>
<hr class="hr2">

<body class="bcolor">
	<div class="container-md account-container">
	
				
	</div>
	<div class="container-sm" >
		<div class="card">
		  <div class="card-header" style="background-color: #fafafa;font-size: 20px;">My Profile</div>
		  <div class="card-body">
		  	<?php if($resultCheck_profile > 0) { ?>
					<?php while($row_profile = mysqli_fetch_assoc($result_profile)){ ?>
		  	<form method="post">

						<div class="form-row">

					  	<div class="form-group col-md-12">
					    	<hr><h5 style="font-size: 17px">Customer Name <i class='bx bxs-id-card' style="font-size: 22px;"></i></h5> 
					    </div>

					    <div class="form-group col-md-4">
					    	<label for="inputEmail4"> Firstname</label>
					      <input type="text"  name="fname" id="fname" class="form-control" value="<?php echo $row_profile['customer_fname']; ?>" required="">
					    </div>

					    <div class="form-group col-md-4"> 
					     <label for="inputPassword4"> Lastname</label>
					      <input type="text" name="lname" id="lname" class="form-control" value="<?php echo $row_profile['customer_lname']; ?>" required="">
					    </div>
					    <div class="form-group col-md-12">
					    	<hr><h5 style="font-size: 17px">Username <i class='bx bxs-user-rectangle' style="font-size: 20px" ></i></h5> 
					    </div>

					    <div class="form-group col-md-4"> 
					     <label for="inputPassword4"> Username</label>
					      <input type="text" name="username" class="form-control" value="<?php echo $row_profile['username']; ?>" required="">
					    </div>

					    <div class="form-group col-md-12">
					    	<hr><h5 style="font-size: 17px">Contact Information 
					    		<i class='bx bxs-phone' style="font-size: 20px"></i>
					    	</h5>
					    </div>

					    <div class="form-group col-md-4">
					      <label for="inputCity">Contact Number</label>
					      <input type="text" name="contact" class="form-control" value="<?php echo $row_profile['customer_phonenumber']; ?>" required="">
					    </div>

					    <div class="form-group col-md-4">
					      <label for="inputCity">Email</label>
					      <input type="text"  name="email" class="form-control" value="<?php echo $row_profile['customer_email']; ?>" required="">
					    </div>

					    <div class="form-group col-md-12">
					    	<hr>
					    	<h5 style="font-size: 17px">Full Address 
					    		<i class='bx bxs-map' style="font-size: 20px;"></i>
							</h5>
					    </div>

						  <div class="form-group col-md-3">
						    <label for="inputAddress">House Number</label>
						    <input type="text"  name="house" class="form-control" value="<?php echo $row_profile['house_no']; ?>" required="">
						  </div>

						  <div class="form-group col-md-3">
						    <label for="inputAddress2">Barangay</label>
						    <input type="text" name="brgy" class="form-control" value="<?php echo $row_profile['barangay']; ?>" required="">
						  </div>
					 
					  	<div class="form-group col-md-3">
					      <label for="inputCity">Municipality</label>
					      <input type="text" name="city" class="form-control" value="<?php echo $row_profile['city']; ?>" required="">
					    </div>

					    <div class="form-group col-md-3">
					      <label for="inputCity">Province</label>
					      <input type="text" name="province" class="form-control" value="<?php echo $row_profile['province']; ?>" required="">
					    </div>

					    <div class="form-group col-md-12">
					    	<hr>
					    	<h5 style="font-size: 17px">Security
					    	<i class='bx bxs-lock-alt'></i>
							</h5>
					    </div>

					    <div class="form-group col-md-3">
					    	<button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#exampleModal">
 				Change Password</button>
					    </div>

					     <input class="border account-input2" type="text" name="cus_id" value="<?php echo $row_profile['customer_id']; ?>" >
						<input class="border account-input2" type="text" name="acc_id" value="<?php echo $row_profile['account_id']; ?>" >
					 	</div>

					 	
					 	  <div class="form-group col-md-12">
					    	<hr>

					    	<button type="submit" name="save_btn" class="btn btn-primary float-right">Save Changes</button>
					    	<button class="btn btn-default float-right" style="margin-right: 10px; border: solid 1px"><a href="#" onclick="history.back();" style="text-decoration: none; color: black">Back</a></button>
					    	
					    </div>
					   
					</form>
					<?php } ?>	
				<?php } ?>
		  </div>
	
		</div>
		
</div>



</body>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php if(isset($error)) { ?>
					<div class="alert alert-danger" role="alert">
							<?php echo $error; ?>
					</div>
			<?php } ?>
     <form method="POST">
      <div class="modal-body">
       <!-- Password field -->
       <div class="row">
       	<div class="col account-modal1" >
<label>Current Password: </label>
</div>
	<div class="col">
<input type="password" name="current_pass" autocomplete="new-password" id="myInput">
</div>
</div>
 <div class="row">
       	<div class="col account-modal1" >
<label>New Password: </label>
</div>
	<div class="col">
	<input type="password" name="new_pass" id="myInput1">
</div>
</div>
 <div class="row">
       	<div class="col account-modal1" >
<label>Confirm New Password: </label>
</div>
	<div class="col">
<input type="password" name="confirm_pass" id="myInput2">
</div>
</div>

<input type="hidden" name="acccc_id" value="<?php echo $resultCheck_profile1['account_id']; ?>" >
<!-- An element to toggle between password visibility -->
<input type="checkbox" onclick="myFunction()"> Show Password
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="save_pass" class="btn btn-primary account-modal-btn1" value="Submit">
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Alert-->
  <div class="modal fade" id="mymodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Password Changed!</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>  
        </div>
        <div class="modal-body">
          Use the password for your next login.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<?php 
		include('include/footer_user.php');
 ?>
 <script type="text/javascript">
 	function myFunction() {
  var x = document.getElementById("myInput");
   var y = document.getElementById("myInput1");
    var z = document.getElementById("myInput2");
  if (x.type === "password" && y.type === "password" && z.type === "password" ) {
    x.type = "text";
    y.type = "text";
    z.type = "text";
  } else {
    x.type = "password";
    y.type = "password";
    z.type = "password";
  }
}

if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
 } 

</script>
