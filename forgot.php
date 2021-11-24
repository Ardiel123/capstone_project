<?php
	include('include/dbconnection.php');

	$usern = $_GET['username'];

	$sql = "SELECT ct.customer_email, ac.username, ac.account_id FROM account_tbl ac INNER JOIN customer_tbl ct ON ac.account_id = ct.account_id WHERE username = '$usern'";
	$res = mysqli_query($db, $sql);
	$show_email = mysqli_fetch_assoc($res);

	if ($show_email) {

		$email = $show_email['customer_email'];
		list($first, $last) = explode("@", $email);
   	 	$len = floor(strlen($first)/2);
    	$the_email = substr($first, 0, $len) . str_repeat('*', $len) . "@" . $last;

	}else{
		$error = "Username not exist";
	}

	if(isset($_POST['conf'])){
		$email = $_POST['email'];
		$id = $show_email['account_id'];

		if ($show_email['customer_email'] == $email) {

		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr( str_shuffle( $chars ), 0, 8 );

			
						require_once 'phpmailer/PHPMailer.php';
						require_once 'phpmailer/SMTP.php';
						require_once 'phpmailer/Exception.php';

						$mail = new PHPMailer\PHPMailer\PHPMailer();;

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
						$mail->Subject='TradeBay Password Recovery';
						$mail->Body='<h1>Account recovery</h1></br><h3>Here is your new Login Password.</h3></br> <h2>'.$password.'</h2>';

						if(!$mail->send()){
							echo "Message not sent";
						}
						else
						{
							$pass = md5($password);

							$saveacc="UPDATE `account_tbl` SET `password`='$pass' WHERE `account_id`='$id'";
							mysqli_query($db,$saveacc);
							
							header("location: sent.php");
						}
		}
		else{
			$error = "Email address do not match";
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
		margin-top: 77px;
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

	<input type="checkbox" id="check">
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
		<div class="container text-center" >

				<h2>Account recovery</h2><hr>


					<h6>Enter complete email address shown below</h6>
					<h6><?php echo $the_email; ?></h6>
					
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
						<label for="usern">Enter here:</label>
						<input type="email" name="email" class="form-control">
					</div>
					</center>
				
					<button type="submit" class="btn btn-primary" name="conf">Send Login Info</button><br></br>		
					</form>	


		</div>
	</div>
</body>
<?php 
	include('include/footer_user.php');
 ?>

