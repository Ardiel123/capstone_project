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
	<div class="container-sm mt-3 border account-container1" >
		
		<h3 class="account-title">My Profile</h3>
		<hr class="account-hr">
		

		<div class="row account-row1" >
		    <div class="col-sm account-col1" >
					
					<?php if($resultCheck_profile > 0) { ?>
					<?php while($row_profile = mysqli_fetch_assoc($result_profile)){ ?>
		    			<!-- first name -->
			

		    			<div class="row account-row2" >
		    				<div class="col col-acc">
		    					<label for=""><b>First Name:</b></label>
		    				</div>
		    				<div class="col" >
		    					<form method="POST" autocomplete="off" id="formsss">
		    					 <input class="border account-input1" type="text"  name="fname" id="fname" value="<?php echo $row_profile['customer_fname']; ?>" >
								 

		    				</div>
		    			</div>
					   
		    			<div class="row account-row2" >
		    				<div class="col col-acc">
		    					<label for=""><b>Last Name:</b></label>
		    				</div>
		    				<div class="col" >
		    					 <input class="border account-input1" type="text" name="lname" id="lname" value="<?php echo $row_profile['customer_lname']; ?>" >
		    				</div>
		    			</div>

		    			<!-- username -->
		    			<div class="row account-row2" >
		    				<div class="col col-acc">
		    					<label for=""><b>Username:</b></label>
		    				</div>
		    				<div class="col" >
		    					 <input class="border account-input1" type="text" name="username" id="username" value="<?php echo $row_profile['username']; ?>" >
		    				</div>
		    			</div>
					   
						<!-- email -->
		    			<div class="row account-row2" >
		    				<div class="col col-acc">
		    					<label for=""><b>Email:</b></label>
		    				</div>
		    				<div class="col" >
		    					 <input class="border account-input1" type="text" name="email" value="<?php echo $row_profile['customer_email']; ?>" >
		    				</div>
		    			</div>

		    			<!-- contact -->
		    			<div class="row account-row2">
		    				<div class="col col-acc">
		    					<label for=""><b>Contact:</b></label>
		    				</div>
		    				<div class="col" >
		    					 <input class="border account-input1" type="text" name="contact" value="<?php echo $row_profile['customer_phonenumber']; ?>" >
		    				</div>
		    			</div>

					
				
					<input class="border account-input2" type="text" name="cus_id" value="<?php echo $row_profile['customer_id']; ?>" >
					<input class="border account-input2" type="text" name="acc_id" value="<?php echo $row_profile['account_id']; ?>" >

		    </div>
		  
		    <div class="col-sm account-col1" >
					

					<!-- contact -->
		    			<div class="row account-row2" >
		    				<div class="col col-acc">
		    					<label for=""><b>House #:</b></label>
		    				</div>
		    				<div class="col" >
		    					 <input class="border account-input1" type="text" name="house" value="<?php echo $row_profile['house_no']; ?>" >
		    				</div>
		    			</div>

		    		<!-- Barangay -->
		    			<div class="row account-row2" >
		    				<div class="col col-acc" >
		    					<label for=""><b>Barangay:</b></label>
		    				</div>
		    				<div class="col" >
		    					 <input class="border account-input1" type="text" name="brgy" value="<?php echo $row_profile['barangay']; ?>" >
		    				</div>
		    			</div>		

		    		<!-- City/Municipality -->
		    			<div class="row account-row2" >
		    				<div class="col col-acc">
		    					<label for=""><b>City:</b></label>
		    				</div>
		    				<div class="col" >
		    					 <input class="border account-input1" type="text" name="city" value="<?php echo $row_profile['city']; ?>" >
		    				</div>
		    			</div>
		    		<!-- Province -->
		    			<div class="row account-row2" >
		    				<div class="col col-acc" >
		    					<label for=""><b>Province:</b></label>
		    				</div>
		    				<div class="col" >
		    					 <input class="border account-input1" type="text" name="province" value="<?php echo $row_profile['province']; ?>" >
		    				</div>
		    			</div>
		

		    </div>
		      
		    <?php } ?>	
				<?php } ?>

		</div>
		<hr class="account-hr1">
		<div class="row account-row1" >

		    <div class="col account-col2" >
					
		    	<button type="button" class="btn  abtn1"  data-toggle="modal" data-target="#exampleModal">
 				Change Password</button>	
				
				
				
		    </div>
		    <div class="col account-col2" >
				
				<button type="submit" name="save_btn" class="btn abtn2" >Save Profile </button>
				
		    </div>
		   
		</div>
	
		
		
</div>


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
