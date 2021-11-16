<?php
	include('../include/dbconnection.php');
	include('../include/validate.php');
	include('../include/header.php');
	include('../include/navbar.php');

	$admin_id = $_SESSION['adm_id'];

	$sql = "SELECT * FROM admin_tbl WHERE admin_id = '$admin_id'";
	$result = mysqli_query($db, $sql);
	$show_admin = mysqli_fetch_assoc($result);

	if (isset($_POST['save_change'])) {

		$fname = $_POST['firstname'];
		$lname = $_POST['lastname'];
		$id = $_POST['admin_id'];
		$email = $_POST['Email'];

			$sql2 = "UPDATE `admin_tbl` SET `admin_fname`='$fname',`admin_lname`='$lname',`admin_email`='$email' WHERE admin_id = '$admin_id'";
			mysqli_query($db, $sql2);

			echo  '<script> window.location.href="admin_acc.php";</script>';
	}

	if (isset($_POST['save_pass'])) {

		$acc_id = $show_admin['account_id'];
		
		$current_pass = $_POST['cur_pass'];
		$new_pass = $_POST['new_pass'];
		$confirm_pass = $_POST['con_pass'];


		if(empty($current_pass)){
				$error = "Current password cannot be empty";
				echo  '<script> 
					$(document).ready(function(){
					$("#myModal").modal("show");
					});
				</script>';
		}
		else if(empty($new_pass)){
				$error = "Please Input new password";
				echo  '<script> 
					$(document).ready(function(){
					$("#myModal").modal("show");
					});
				</script>';
		}
		else if(empty($confirm_pass)){
				$error = "Please Confirm new password";
				echo  '<script> 
					$(document).ready(function(){
					$("#myModal").modal("show");
					});
				</script>';

		}
		else if($new_pass != $confirm_pass){
				$error = "New Password do not match";
				echo  '<script> 
					$(document).ready(function(){
					$("#myModal").modal("show");
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
						$("#successmodal").modal("show");
						});
					</script>';

				}
				else{
					$error = "You've entered wrong current password";
					echo  '<script> 
						$(document).ready(function(){
						$("#myModal").modal("show");
						});
					</script>';
				}

		}


	}
?>

<div class="content">
		<div class="for_title">
			<h2>Account</h2>
		</div>

		<div class="my-content">
			<div class="panel panel-default">
			  <div class="panel-heading">Profile</div>
			  <div class="panel-body">

					<form method="post">

						<div class="form-row">

					  	<div class="form-group col-md-12">
					    	<hr><h4>Admin Name <i class="fas fa-address-card" style="font-size: 20px"></i></h4> 
					    </div>

					    <div class="form-group col-md-4">
					    	<label for="firstname"> Firstname</label>
					      <input type="text" name="firstname" class="form-control" value="<?php echo $show_admin['admin_fname']; ?>" required>
					    </div>

					    <div class="form-group col-md-4"> 
					     <label for="lastname"> Lastname</label>
					      <input type="text" name="lastname" class="form-control" value="<?php echo $show_admin['admin_lname']; ?>" required>
					    </div>

					    <div class="form-group col-md-12">
					    	<hr><h4>Contact Information <i class="fas fa-phone-square" style="font-size: 20px"></i></h4>
					    </div>

					    <div class="form-group col-md-4">
					      <label for="Email">Email</label>
					      <input type="text"  name="Email" class="form-control" value="<?php echo $show_admin['admin_email']; ?>" required>
					    </div>

					    <div class="form-group col-md-12">
					    	<hr><h4>Security <i class="fas fa-lock" style="font-size: 20px"></i></h4> 
					    </div>

					    <div class="form-group col-md-4">
					    	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Change Password</button>
					    </div>

					    <div class="form-group col-md-12">
					    	<hr>
					    </div>

					    <div class="form-group col-md-12">
					      <label for="date">Admin ID: </label>
					      <?php echo $show_admin['admin_id']; ?>
					    </div>

					    <div class="form-group col-md-12">
					      <label for="date">Date Created: </label>
					      <?php echo $show_admin['date_created']; ?>
					    </div>

					    <div class="form-group col-md-12">
					    	<button type="submit" name="save_change" class="btn btn-primary float-right">Save Changes</button>
					    	<button class="btn float-right" style="margin-right: 10px;"><a href="#" onclick="history.back();" style="text-decoration: none; color: black">Back</a></button>
					    </div>

					 	</div>
					 
					</form>

			  </div>
			</div>
		</div>
</div>

<!-- Modal Alert-->
  <div class="modal fade" id="successmodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Password Changed!</h4>
        </div>
        <div class="modal-body">
          <p>Use the password for your next login</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Password</h4>
      </div>
       	<?php if(isset($error)) { ?>
					<div class="alert alert-danger" role="alert">
							<?php echo $error; ?>
					</div>
				<?php } ?>
      <div class="modal-body">
      	<form method="POST">

      		<div class="form-group">
					  <label for="cur_pass">Current Password: </label>
					  <input type="password" name="cur_pass" class="form-control" id="myInput">
					</div>

					<div class="form-group">
					  <label for="new_pass">New Password: </label>
					  <input type="password" name="new_pass" class="form-control" id="myInput1">
					</div>

					<div class="form-group">
					  <label for="con_pass">Confirm New Password: </label>
					  <input type="password" name="con_pass" class="form-control" id="myInput2">
					</div>

					<div class="form-group">
						<input type="checkbox" onclick="myFunction()"> Show Password
					</div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="save_pass">Save</button>
      </div>
      	</form>
    </div>

  </div>
</div>


<script>

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

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

</script>