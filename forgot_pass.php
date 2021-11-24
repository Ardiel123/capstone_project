<?php
	include('include/dbconnection.php');

	if (isset($_POST['conf'])) {
		$usern = $_POST['usern'];

		$sql = "SELECT ct.customer_email, ac.username, ac.account_id FROM account_tbl ac INNER JOIN customer_tbl ct ON ac.account_id = ct.account_id WHERE username = '$usern'";
		$res = mysqli_query($db, $sql);
		$show_email = mysqli_fetch_assoc($res);

		if ($show_email) {
			echo  '<script> window.location.href="forgot.php?username='.$usern.'";</script>';
		}else{
			$error = "Username not exist";
		}

		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>TradeBay</title>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="style/Customerstyle.css">

	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Rubik+Mono+One&display=swap" rel="stylesheet">
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<style>

	label #sidebar_btn{
		display: none;
	}
	.left_area{
		margin-top: 20px;
	width: 30%;
	float: left;
	height: 70px;
	transition: 0.5s;
}
.right_area{
	width: 30%;
	float: right;
	height: 70px;
	padding: 20px;
}
.left_area h3{
	position: absolute;
	color: #fff;
	margin-left: 50px;
	text-transform: uppercase;
	font-size: 30px;
	font-weight: 900;
}
.left_area span{
	color: #cc7a00;
	font-size: 30px;
}
.right_area h6{
	margin-top: 10px;
	position: absolute;
	color: #fff;
}
	.content{
		margin: auto;
		margin-top: 100px;
		height: 1000px;
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
		width: 50%;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}

	.inputs{
		width: 40%;
	}

	@media screen and (max-width: 900px){
		.inputs{
			width: 100%;
		}
		.container{
			width: 97%;
		}
	}

</style>
<body>


	<header>
		<label for="check">
			<i class="fa fa-bars" aria-hidden="true" id="sidebar_btn"></i>
		</label>
		<div class="left_area">
			<a href="index.php"><h3>Trade <span>Bay</span></h3></a>
		</div>
		<div class="right_area">
			<a href="login.php"><h6><i class="fa fa-sign-in-alt"></i>&nbsp;&nbsp;Login</h6></a>
		</div>
	</header>
	<div class="content">
		<div class="container">
			<div class="text-center">
				<h2>Account recovery</h2><hr>
				
				<form method="POST">
					<center>
					<div class="form-group inputs">
						<?php if(isset($error)){ ?>
						<div class="alert alert-danger">
							<?php echo $error;?>
						</div>
						<?php } ?>
					</div>

					<div class="form-group inputs">
						<h6>Enter your username</h6>
						<input type="text" name="usern" class="form-control">
					</div>
					</center>
				
					<button type="submit" class="btn btn-primary" name="conf">Confirm</button><br></br>		
				</form>	

			</div>
		</div>
	</div>
</body>
<?php 
	include('include/footer_user.php');
 ?>
</html>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>