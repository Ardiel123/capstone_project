
<?php
use PHPMailer\PHPMailer\PHPMailer;

include('../include/dbconnection.php');


	if(isset($_POST['register_btn'])){

		if(!empty($_POST['id_num']) && !empty($_POST['email']) && !empty($_POST['lname']) && !empty($_POST['fname']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['con_password']) ){

			$id_num = $_POST['id_num'];
			$email = $_POST['email'];
			$lname = $_POST['lname'];
			$fname = $_POST['fname'];
			$user = $_POST['username'];
			$pass =  $_POST['password'];
			$con_pass = $_POST['con_password'];

			$verification_key = md5(time().$user);
		
			
			if ($pass == $con_pass) {
			
				$query = "SELECT * FROM admin_tbl ad INNER JOIN account_tbl ac  WHERE ac.username = '$user' OR ad.admin_email = '$email' ";
				$result = mysqli_query($db,$query);

				if(!mysqli_fetch_array($result)){
						
						require_once '../phpmailer/PHPMailer.php';
						require_once '../phpmailer/SMTP.php';
						require_once '../phpmailer/Exception.php';

						$mail = new PHPMailer();

						$mail->isSMTP();
						$mail->Host='smtp.gmail.com';
						$mail->Port=587;
						$mail->SMTPAuth=true;
						$mail->SMTPSecure='tls';

						$mail->Username='tradebay2021@gmail.com';
						$mail->Password='tradebay_123';

						$mail->setFrom('tradebay2021@gmail.com','TradeBay');
						$mail->addAddress($email);
						$mail->addReplyTo('tradebay2021@gmail.com');

						$mail->isHTML(true);
						$mail->Subject='TradeBay Admin Verification';
						$mail->Body='<h1>Verification Email</h1></br><h5>Click the log-in link provided below to activate your account and log-in.</h5></br> <a href="192.168.1.2/tradebay_project/admin/verify_email.php?vkey='.$verification_key.'">Log-in Account</a>';

						if(!$mail->send()){
							echo "Message not sent";
						}
						else
						{
							$password = md5($pass);

							$saveacc="INSERT INTO `account_tbl`(`verification_key`, `status`, `username`, `password`, `usertype`) VALUES ('$verification_key','0','$user','$password','admin')";
							mysqli_query($db,$saveacc);

							$last_id_query = "SELECT MAX(account_id) AS last_id FROM account_tbl";
							$execute_last_id = mysqli_query($db,$last_id_query);
							$show_last_id = mysqli_fetch_assoc($execute_last_id);

							$the_last_id = $show_last_id['last_id'];

							$saveresult = "INSERT INTO `admin_tbl`(admin_id,admin_fname,admin_lname,admin_email,account_id) VALUES ('$id_num','$fname','$lname','$email','$the_last_id')";
							mysqli_query($db,$saveresult);
							
							header("location:../include/thanks.php?yes=true");
						}
				}
				else
				{
					header("location: register.php?error=Email or Username already exist");
				}
			}
			else
			{
				header("location: register.php?error=Password do not match");
			}

		}
		else
		{
			header("location: register.php?error=All field is required");
		}
	}




	$check = "SELECT * FROM account_tbl WHERE usertype_id = 1 AND status = 1";
	$res = mysqli_query($db,$check);

	if(mysqli_num_rows($res)==0)
	{
	?>
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
		    <link rel="stylesheet" type="text/css" href="../style/style.css">
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
						<h2>Admin Register</h2>
						<?php if(isset($_GET['error'])) { ?>
							<div class="alert alert-danger" role="alert">
							  	<?php echo $_GET['error']; ?>
							</div>
						<?php } ?>
					</div>
					<div class="my_content">
						<form method="POST" autocomplete="off">
								<div class="form-group">
							    	<label for="fname">First name: <span>*</span></label>
							    	<input type="username" class="form-control" name="fname" placeholder="first name">
							  	</div>
							  	<div class="form-group">
							    	<label for="lname">Last name: <span>*</span></label>
							    	<input type="username" class="form-control" name="lname" placeholder="last name">
							  	</div>
							  	<div class="form-group">
							    	<label for="email">Email: <span>*</span></label> (Please use an active email to verify your account)
							    	<input type="email" class="form-control" name="email" placeholder="sample@email.com">
							  	</div>
							  	<div class="form-group">
							    	<label for="id_num">ID number: <span>*</span></label>
							    	<input type="text" class="form-control" name="id_num" placeholder="**********">
							  	</div>
							  	<div class="form-group">
							    	<label for="username">Username: <span>*</span></label> (This will be used for your log-in)
							    	<input type="username" class="form-control" name="username" placeholder="username">
							  	</div>
							  	<div class="form-group">
							    	<label for="password">Password: <span>*</span></label>
							   	 	<input type="password" class="form-control" name="password" placeholder="password">
							  	</div>
							  	<div class="form-group">
							    	<label for="con_password">Confirm Password: <span>*</span></label>
							   	 	<input type="password" class="form-control" name="con_password" placeholder="confirm password">
							  	</div>
							 	 <div class="form-group">
							 	 	<a href="../login.php">Back to Login</a>
							 	 	<button type="submit" name="register_btn" class="btn btn-primary" style="margin: auto; float: right; ">Register</button>
							  	</div>
						</form>
					</div>
				</div>
			</div>

		</body>
		</html>
	<?php
		}else{
			header("location: youhaveadmin.php");
		}
	?>