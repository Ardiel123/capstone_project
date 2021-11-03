<?php
	require_once('include/dbconnection.php');
	
		if(isset($_POST['register_btn'])){
			// $firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$house_no = $_POST['house_no'];
			$brgy = $_POST['brgy'];
			$city = $_POST['city'];
			$province = $_POST['province'];
			$email_address = $_POST['email_address'];
			$contact = $_POST['contact'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$confirm_pass = $_POST['confirm_password'];
			$error = '';
			$errorl = '';
			 $firstname = '';

			if(empty($_POST["firstname"])){
				$error = 'Firstname is required';
				
			}else{
				$firstname = $_POST["firstname"];
			}
			 if(empty($lastname)){
				$errorl = 'Lastname is required';
				// header("location: customer_register.php?error=Lastname is required");
			}
			else if(empty($house_no)){
				header("location: customer_register.php?error=House_no is required");
			}
			else if(empty($brgy)){
				header("location: customer_register.php?error=Barangay is required");
			}
			else if(empty($city)){
				header("location: customer_register.php?error=City is required");
			}
			else if(empty($province)){
				header("location: customer_register.php?error=Province is required");
			}
			else if(empty($email_address)){
				header("location: customer_register.php?error=Email address is required");
			}
			else if(empty($contact)){
				header("location: customer_register.php?error=Contact number is required");
			}
			else if(empty($username)){
				header("location: customer_register.php?error=Username is required");
			}
			else if(empty($password)){
				header("location: customer_register.php?error=Password is required");
			}
			else if(empty($confirm_pass)){
				header("location: customer_register.php?error=Please Confirm password");
			}
			else if($password != $confirm_pass){
				header("location: customer_register.php?error=Password do not match");

			}else{

				$verification_key = md5(time().$username);

				$query = "SELECT ac.username, ct.customer_email FROM account_tbl ac INNER JOIN customer_tbl ct WHERE ac.username = '$username' OR ct.customer_email = '$email_address' LIMIT 1";
				$result = mysqli_query($db,$query);

				if(mysqli_num_rows($result) == 0){
						
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
						$mail->addAddress($email_address);
						$mail->addReplyTo('tradebay2021@gmail.com');

						$mail->isHTML(true);
						$mail->Subject='TradeBay Customer Verification';
						$mail->Body='<h1>Verification Email</h1></br><h5>Click the log-in link provided below to activate your account and log-in.</h5></br> <a href="192.168.1.2/tradebay_project/verify_user_email.php?vkey='.$verification_key.'">Log-in Account</a>';

						if(!$mail->send()){
							echo "Message not sent";
						}
						else
						{
							$pass = md5($password);

							$saveacc="INSERT INTO `account_tbl`(`verification_key`, `status`, `username`, `password`, `usertype`) VALUES ('$verification_key','0','$username','$pass','customer')";
							mysqli_query($db,$saveacc);

							$last_id_query = "SELECT MAX(account_id) AS last_id FROM account_tbl";
							$execute_last_id = mysqli_query($db,$last_id_query);
							$show_last_id = mysqli_fetch_assoc($execute_last_id);

							$the_last_id = $show_last_id['last_id'];

							$saveresult = "INSERT INTO customer_tbl (`customer_fname`, `customer_lname`, `house_no`, `barangay`, `city`, `province`, `customer_email`, `customer_phonenumber`,`account_id`) VALUES ('$firstname','$lastname','$house_no', '$brgy','$city','$province','$email_address','$contact','$the_last_id')";
							mysqli_query($db,$saveresult);
							
							header("location: include/thanks.php?yes=true");
						}
				}
				else{
					header("location: customer_register.php?error=Email or Username already exist");
				}

				/*$user_check = "SELECT * FROM customer_tbl WHERE customer_email = '$email_address'";
				$email_result = mysqli_query($db, $user_check);

				$user_check = "SELECT * FROM customer_tbl WHERE customer_phonenumber = '$contact'";
				$phone_result = mysqli_query($db, $user_check);

				$user_check = "SELECT * FROM customer_tbl WHERE customer_username = '$username'";
				$user_result = mysqli_query($db, $user_check);

				if(mysqli_num_rows($email_result) > 0) {
					header("location: customer_register.php?error=Email address already exist");
				}
				else if(mysqli_num_rows($phone_result) > 0) {
					header("location: customer_register.php?error=Phone number already exist");
				}
				else if(mysqli_num_rows($user_result) > 0) {
					header("location: customer_register.php?error=Username already exist");
				}
				else{
					$pass = md5($password);

					$saveresult = "INSERT INTO customer_tbl (`customer_fname`, `customer_lname`, `house_no`, `barangay`, `city`, `province`, `customer_email`, `customer_phonenumber`, `customer_username`, `customer_password`) VALUES ('$firstname','$lastname','$house_no', '$brgy','$city','$province','$email_address','$contact','$username','$pass')";
					mysqli_query($db,$saveresult);

					header("location: login.php");
				}
				*/
			}
			header("location: customer_register.php?errorf=".$error."&fname=".$firstname."&errorl=".$errorl);
		}
	
?>