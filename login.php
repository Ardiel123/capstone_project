<?php
	include('include/dbconnection.php');
	

	if (isset($_POST['login_btn'])) {
		
		if(!empty($_POST['username']) && !empty($_POST['password'])){

			$user = $_POST['username'];
			$pass = $_POST['password'];
			$password = md5($pass);

			$query1 = "SELECT * FROM account_tbl WHERE username = '$user' AND password = '$password'";
			$result1 = mysqli_query($db,$query1);
			$get_usertype = mysqli_fetch_assoc($result1);

			if(mysqli_num_rows($result1) == 1){

				$check_if_verified = "SELECT * FROM account_tbl WHERE username = '$user' AND password = '$password' AND status = 1";
				$result2 = mysqli_query($db,$check_if_verified);
				$row = mysqli_fetch_assoc($result2);

				if(mysqli_num_rows($result2) == 1) {
					
					$usertype = $get_usertype['usertype'];

					if($usertype == "admin"){

						$acc_id = $get_usertype['account_id'];

						$getid = "SELECT * FROM admin_tbl WHERE account_id = '$acc_id'";
						$exeget_id = mysqli_query($db,$getid);
						$getid_res = mysqli_fetch_assoc($exeget_id);

						$_SESSION['username'] = $user;
						$_SESSION['adm_id'] = $getid_res['admin_id'];
						header("location: admin/index.php");
					}
					else if($usertype == "customer"){

						$account_id = $get_usertype['account_id'];

						$get_id = "SELECT * FROM customer_tbl WHERE account_id = '$account_id'";
						$exe_get_id = mysqli_query($db,$get_id);
						$get_id_res = mysqli_fetch_assoc($exe_get_id);

						$_SESSION['cus_name'] = $row['username'];
						$_SESSION['user_id'] = $get_id_res['customer_id'];
						header("location: index.php");
					}
				}
				else{
					$error = "Please verify your account";
				}

			}else{

				$error = "Invalid account";
			}

		}
		else{
			$error = "All field is required";
		}

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>TradeBay</title>
	<link rel="stylesheet" type="text/css" href="style/loginstyle.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<img class="wave" src="img/login/waves.png">
	<div class="container">
		<div class="img">
			<img src="img/login/bg.png">
		</div>
		<div class="login-content">
			<form method="POST">
				<img src="img/login/avatar.png">
				<a href="index.php" class="fortitle"><h2 class="title">Trade<span class="bay">Bay</span> Login</h2></a>
							<?php if(isset($error)) { ?>
								<div class="alert">
								  	<?php echo $error; ?>
								</div>
							<?php } ?>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" name="username" class="input" >
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" name="password" class="input" id="id_password" style="width: 95%;">
            	   </div>
            	</div>

            	<div style="float:  right; margin-top: -45px; margin-left: 10px;  position: relative;">
            		<i class="far fa-eye show" id="togglePassword" style="font-size: 20px;"></i>
            	</div>
            	
            	<input type="submit" class="btn" name="login_btn" value="Login" style="margin-top: 60px;">
            	<a href="customer_register.php" class="fortitle"><input type="button" class="btn" value="Signup"></a>
            	<a href="forgot_pass.php" class="forpass">Forgot Password?</a>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
 
 const togglePassword = document.querySelector('#togglePassword');
 const password = document.querySelector('#id_password');
 
  togglePassword.addEventListener('click', function (e) {

    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    this.classList.toggle('fa-eye-slash');
});
</script>


