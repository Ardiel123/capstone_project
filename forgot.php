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
		margin-top: 40px;
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
		<div class="container text-center" >

				<h2>Account recovery</h2><hr>


					<h3>Enter complete email address shown below</h3>
					<h4><?php echo $the_email; ?></h4>
					
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
</html>
