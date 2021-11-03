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

						$_SESSION['username'] = $user;
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
					header("location: login.php?error=Please verify your account");
				}

			}else{

				header("location: login.php?error=Invalid account");
			}

		}
		else{
			header("location: login.php?error=All field is required");
		}

	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>TradeBay</title>
	    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<style>
	label #sidebar_btn{
		display: none;
	}
	.right_area h5{
		display: none;
	}
	.content{
		margin: auto;
		margin-top: 100px;
		align-items: center;
	}
	.my_content{
		width: 100%;
		margin: auto;
	}
	.for_title h2{
		text-align: center;
	}
	.container{
		padding: 30px;
		width: 60%;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		background: #ffff;
	}
	.left_area h3 a{
		color: #fff;
		font-size: 30px;
	}
	.left_area h3 a:hover{
		text-decoration: none;
		color: #fff;
	}
</style>
<body>
	<input type="checkbox" id="check">
	<header>
		<label for="check">
			<i class="fa fa-bars" aria-hidden="true" id="sidebar_btn"></i>
		</label>
		<div class="left_area">
			<h3><a href="index.php">Trade<span>Bay</span></a></h3>
		</div>
	</header>
	<div class="content">
		<div class="container">
			<div class="text-center">
				<h2>User Login</h2>
				<?php if(isset($_GET['error'])) { ?>
					<div class="alert alert-danger" role="alert">
					  	<?php echo $_GET['error']; ?>
					</div>
				<?php } ?>
			</div>
			<div class="my_content">
				<form method="POST" autocomplete="off">
					  	<div class="form-group">
					    	<label for="username">Username:</label>
					    	<input type="username" class="form-control" name="username" placeholder="username">
					  	</div>
					  	<div class="form-group">
					    	<label for="password">Password:</label>
					   	 	<input type="password" class="form-control" name="password" placeholder="password">
					  	</div>

					 	 <div class="form-group">
					 	 	<button type="submit" name="login_btn" class="btn btn-primary" style="margin: auto; float: right; width: 30%;">Login</button>
					 	 	<a href="customer_register.php">Don't have an account?</a>
					  	</div>
				</form>
			</div>
		</div>
	</div>

