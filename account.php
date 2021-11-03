<?php 
		include('include/dbconnection.php');
		include('include/header_user.php'); 

		$sql_profile = "SELECT * FROM customer_tbl INNER JOIN account_tbl ON customer_tbl.account_id = account_tbl.account_id   WHERE customer_id = '$_SESSION[user_id]'";
		$result_profile = mysqli_query($db,$sql_profile);
		$resultCheck_profile = mysqli_num_rows($result_profile);

		

		// if (isset($_POST['pass'])) {
		// 	echo "<script>alert ('wewwwww')</script>";
		// }
	

	if (isset($_POST['save_btn'])) {

		// echo "<script>alert ('wewwwww')</script>";
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

		$acc_id = $_POST['acc_id'];

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

<style> 
	.col-acc{
		min-width: 110px; 
	}
	@media only screen and(max-width: 579px){ 
		.container-sm{ 
			max-width: 550px;
			} 
	} 
	@media only screen and (max-width: 559px){ 
		.container-sm{ 
			max-width: 540px; 
			} 
	} 
</style>

 <hr style="margin: 0px;background-color: #dbdbdb;height: 2px;">
<div style="background-color: white;height: 60px; width: 100%">
  
<ul class="nav justify-content-center" style="padding: 10px 0px">
    <li class="nav-item " style="font-size: 19px;">
      <a class="nav-link nav2 " href="index.php" >Home</a>
    </li>
    <li class="nav-item" style="font-size: 19px;">
      <a class="nav-link nav2 " href="products.php">Products</a>
    </li>
    <li class="nav-item" style="font-size: 19px;">
      <a class="nav-link nav2" href="services.php">Services</a>
    </li>
    
    
  </ul>
</div>
<hr style="margin: 0px;background-color: #dbdbdb;height: 1.5px;">

<body style="background-color: #f5f5f5">
	<div class="container-md" style="margin-bottom: 30px;">
	<!-- <h3 class="play" style="margin: 60px 0px 5px 20px;font-weight: 500;color: black;">My Profile</h3> -->
				
	</div>
	<div class="container-sm mt-3 border" style="padding: 10px;max-width: 900px;background-color: white;">
		
		<h3 style="font-weight: 500;color: black;margin: 10px 0px 0px 10px;font-family: 'Poppins'">My Profile</h3>
		<hr style="margin-top: 15px">
		

		<div class="row" style="margin: 10px">
		    <div class="col-sm" style="padding: 10px 20px;">
					
					<?php if($resultCheck_profile > 0) { ?>
					<?php while($row_profile = mysqli_fetch_assoc($result_profile)){ ?>
		    			<!-- first name -->
			

		    			<div class="row" style="margin: 25px 5px">
		    				<div class="col col-acc">
		    					<label for=""><b>First Name:</b></label>
		    				</div>
		    				<div class="col" >
		    					<form method="POST" autocomplete="off" id="formsss">
		    					 <input class="border" type="text"  name="fname" id="fname" value="<?php echo $row_profile['customer_fname']; ?>" style="width: 230px;padding: 5px 0px 5px 10px;border-color: #dbdbdb">
								 

		    				</div>
		    			</div>
					    
					   
              	 
					   <!-- 	<label style="margin-left: 60px">Karl Laurenz Pacheco</label> -->
						<!-- last name -->
		    			<div class="row" style="margin: 25px 5px">
		    				<div class="col col-acc">
		    					<label for=""><b>Last Name:</b></label>
		    				</div>
		    				<div class="col" >
		    					 <input class="border" type="text" name="lname" id="lname" value="<?php echo $row_profile['customer_lname']; ?>" style="width: 230px;padding: 5px 0px 5px 10px;border-color: #dbdbdb">
		    				</div>
		    			</div>

		    			<!-- username -->
		    			<div class="row" style="margin: 25px 5px">
		    				<div class="col col-acc">
		    					<label for=""><b>Username:</b></label>
		    				</div>
		    				<div class="col" >
		    					 <input class="border" type="text" name="username" id="username" value="<?php echo $row_profile['username']; ?>" style="width: 230px;padding: 5px 0px 5px 10px;border-color: #dbdbdb">
		    				</div>
		    			</div>
					   
						<!-- email -->
		    			<div class="row" style="margin: 25px 5px">
		    				<div class="col col-acc">
		    					<label for=""><b>Email:</b></label>
		    				</div>
		    				<div class="col" >
		    					 <input class="border" type="text" name="email" value="<?php echo $row_profile['customer_email']; ?>" style="width: 230px;padding: 5px 0px 5px 10px;border-color: #dbdbdb">
		    				</div>
		    			</div>

		    			<!-- contact -->
		    			<div class="row" style="margin: 25px 5px">
		    				<div class="col col-acc">
		    					<label for=""><b>Contact:</b></label>
		    				</div>
		    				<div class="col" >
		    					 <input class="border" type="text" name="contact" value="<?php echo $row_profile['customer_phonenumber']; ?>" style="width: 230px;padding: 5px 0px 5px 10px;border-color: #dbdbdb">
		    				</div>
		    			</div>

					
				
					<input class="border" type="text" name="cus_id" value="<?php echo $row_profile['customer_id']; ?>" style="width: 230px;padding: 5px 0px 5px 10px;border-color: #;display: none;">
					<input class="border" type="text" name="acc_id" value="<?php echo $row_profile['account_id']; ?>" style="width: 230px;padding: 5px 0px 5px 10px;border-color: #;display: none;">

		    </div>
		  
		    <div class="col-sm" style="padding: 10px 20px;">
					

					<!-- contact -->
		    			<div class="row" style="margin: 25px 5px">
		    				<div class="col col-acc">
		    					<label for=""><b>House #:</b></label>
		    				</div>
		    				<div class="col" >
		    					 <input class="border" type="text" name="house" value="<?php echo $row_profile['house_no']; ?>" style="width: 230px;padding: 5px 0px 5px 10px;border-color: #dbdbdb">
		    				</div>
		    			</div>

		    		<!-- Barangay -->
		    			<div class="row" style="margin: 25px 5px">
		    				<div class="col col-acc" >
		    					<label for=""><b>Barangay:</b></label>
		    				</div>
		    				<div class="col" >
		    					 <input class="border" type="text" name="brgy" value="<?php echo $row_profile['barangay']; ?>" style="width: 230px;padding: 5px 0px 5px 10px;border-color: #dbdbdb">
		    				</div>
		    			</div>		

		    		<!-- City/Municipality -->
		    			<div class="row" style="margin: 25px 5px">
		    				<div class="col col-acc">
		    					<label for=""><b>City:</b></label>
		    				</div>
		    				<div class="col" >
		    					 <input class="border" type="text" name="city" value="<?php echo $row_profile['city']; ?>" style="width: 230px;padding: 5px 0px 5px 10px;border-color: #dbdbdb">
		    				</div>
		    			</div>
		    		<!-- Province -->
		    			<div class="row" style="margin: 25px 5px">
		    				<div class="col col-acc" >
		    					<label for=""><b>Province:</b></label>
		    				</div>
		    				<div class="col" >
		    					 <input class="border" type="text" name="province" value="<?php echo $row_profile['province']; ?>" style="width: 230px;padding: 5px 0px 5px 10px;border-color: #dbdbdb">
		    				</div>
		    			</div>
		

		    </div>
		      
		    <?php } ?>	
				<?php } ?>

		</div>
		<hr style="margin-top: 40px">
		<div class="row" style="margin: 10px">

		    <div class="col" style="padding: 10px 20px;">
					
		    	<button type="button" class="btn btn-primary" style="background-color: #cc7a00;color:white" data-toggle="modal" data-target="#exampleModal">
 				Change Password</button>	
				<!-- <button type="submit" name="pass" class="btn " style="background-color: #cc7a00;color:white">Change Password</button> -->
				
				
		    </div>
		    <div class="col" style="padding: 10px 20px;">
				
				<button type="submit" name="save_btn" class="btn" style="background-color: #170c82;color: white">Save Profile </button>
				
		    </div>
		   
		</div>
	
		
		
</div>

<div style="height: 150px"></div>
</body>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php if(isset($error)) { ?>
					<div class="alert alert-danger" role="alert">
							<?php echo $error; ?>
					</div>
			<?php } ?>
     
      <div class="modal-body">
       <!-- Password field -->
       <div class="row">
       	<div class="col" style="max-width: 200px">
<label>Current Password: </label>
</div>
	<div class="col">
<input type="password" name="current_pass" autocomplete="new-password" id="myInput">
</div>
</div>
 <div class="row">
       	<div class="col" style="max-width: 200px">
<label>New Password: </label>
</div>
	<div class="col">
	<input type="password" name="new_pass" id="myInput1">
</div>
</div>
 <div class="row">
       	<div class="col" style="max-width: 200px">
<label>Confirm New Password: </label>
</div>
	<div class="col">
<input type="password" name="confirm_pass" id="myInput2">
</div>
</div>
<!-- An element to toggle between password visibility -->
<input type="checkbox" onclick="myFunction()"> Show Password
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="save_pass" class="btn btn-primary" value="submit">
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
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <h4 class="modal-title">Password Changed!</h4>
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
