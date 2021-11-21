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
	<title>TradeBay</title>
	    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" type="text/css" href="style/my_style.css">
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
			width: 100%;
		}
	}

</style>
<body>

	<input type="checkbox" id="check">
	<header>
		<label for="check">
			<i class="fa fa-bars" aria-hidden="true" id="sidebar_btn"></i>
		</label>
		<div class="left_area">
			<h3>Trade <span>Bay</span></h3>
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
						<label for="usern">Enter your username</label>
						<input type="text" name="usern" class="form-control">
					</div>
					</center>
				
					<button type="submit" class="btn btn-primary" name="conf">Confirm</button><br></br>		
				</form>	

			</div>
		</div>
	</div>
</body>
</html>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>