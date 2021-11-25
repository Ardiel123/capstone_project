<?php
		require_once('include/dbconnection.php');
	
		if(isset($_POST['register_btn'])){
			$firstname = $_POST['firstname'];
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

			if(empty($firstname)){
				$error = 'Firstname is required';
			}
			else if(empty($lastname)){
				$error = 'Lastname is required';
			}
			else if(empty($house_no)){
				$error="House_no is required";
			}
			else if(empty($brgy)){
				$error= "Barangay is required";
			}
			else if(empty($city)){
				$error="City is required";
			}
			else if(empty($province)){
				$error="Province is required";
			}
			else if(empty($email_address)){
				$error="Email address is required";
			}
			else if(empty($contact)){
				$error="Contact number is required";
			}
			else if(empty($username)){
				$error="Username is required";
			}
			else if(empty($password)){
				$error="Password is required";
			}
			else if(empty($confirm_pass)){
				$error="Please Confirm password";
			}
			else if($password != $confirm_pass){
				$error="Password do not match";

			}else{

				$verification_key = md5(time().$username);
				$host = getHostByName(getHostName());

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
						$mail->Body='<h1>Verification Email</h1></br><h5>Click the log-in link provided below to activate your account and log-in.</h5></br> <a href="'.$host.'/capstone_project/verify_user_email.php?vkey='.$verification_key.'">Log-in Account</a>';

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
					$error = "Email or Username already exist";
				}

			}

		}
	
?>