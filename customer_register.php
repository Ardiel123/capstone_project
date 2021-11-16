<?php
	include('register_process.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>TradeBay</title>
	<link rel="stylesheet" type="text/css" href="style/register_style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>


	<div class="container">
		<img class="wave" src="img/login/waves.png">
		<div class="img">
			<img src="img/login/bg.png">
		</div>
		<div class="login-content">
			<form method="POST">
				<img src="img/login/avatar.png">
				<a href="index.php" class="fortitle"><h2 class="title">Trade<span class="bay">Bay</span> Registration</h2></a>
							<?php if(isset($error)) { ?>
								<div class="alert">
								  	<?php echo $error; ?>
								</div>
							<?php } ?>

           		<h3 style="text-align: left; margin-top: 50px;">Personal info <i class="fas fa-user-alt"></i></h3> 

							<div class="blocks">
           		<div class="input-div one">
           		   <div class="div">
           		   		<input type="text" class="input" name="firstname" value="<?php if(isset($firstname)) {echo $firstname;} ?>">
           		   		<h5>Firstname</h5>
           		   </div>
           		</div>
							</div>

							<div class="blocks">
           		<div class="input-div one">
           		   <div class="div">
           		    	<h5>Lastname</h5>
           		   		<input type="text" class="input" name="lastname" value="<?php if(isset($lastname)) {echo $lastname;} ?>">
            	   </div>
            	</div>
            	</div>

            	<div class="blocks">
            	<div class="input-div one">
           		   <div class="div">
           		   		<h5>Email</h5>
           		   		<input type="email" class="input" name="email_address" value="<?php if(isset($email_address)) {echo $email_address;} ?>">
           		   </div>
           		</div>
           		</div>

           		<div class="blocks">
            	<div class="input-div one">
           		   <div class="div">
           		   		<h5>Contact no.</h5>
           		   		<input type="number" class="input" name="contact" value="<?php if(isset($contact)) {echo $contact;} ?>">
           		   </div>
           		</div>
           		</div>

            	<h3 style="text-align: left;">Address <i class="far fa-address-card"></i></h3>

            	<div class="blocks">
            	<div class="input-div one">
           		   <div class="div">
           		   		<h5>House no.</h5>
           		   		<input type="number" class="input" name="house_no" value="<?php if(isset($house_no)) {echo $house_no;} ?>">
           		   </div>
           		</div>
           		</div>

           		<div class="blocks">
            	<div class="input-div one">
           		   <div class="div">
           		   		<h5>Barangay</h5>
           		   		<input type="text" class="input" name="brgy" value="<?php if(isset($brgy)) {echo $brgy;} ?>">
           		   </div>
           		</div>
           		</div>

            	<div class="blocks">
           		<div class="input-div one">
           		   <div class="div">
           		    	<h5>City/Municipality</h5>
           		   		<input type="text" class="input" name="city" value="<?php if(isset($city)) {echo $city;} ?>">
            	   </div>
            	</div>
            	</div>

            	<div class="blocks">
           		<div class="input-div one">
           		   <div class="div">
           		    	<h5>Province</h5>
           		   		<input type="text" class="input" name="province" value="<?php if(isset($province)) {echo $province;} ?>">
            	   </div>
            	</div>
            	</div>

            	<h3 style="text-align: left;">Login details <i class="fas fa-clipboard-list"></i></h3>

            	<div class="blocks">
           		<div class="input-div one">
           		   <div class="div">
           		    	<h5>Username</h5>
           		   		<input type="text" class="input" name="username" value="<?php if(isset($username)) {echo $username;} ?>">
            	   </div>
            	</div>
            	</div>

            	<div class="blocks">

           		</div>

            	<div class="blocks">
            	<div class="input-div one">
           		   <div class="div">
           		   		<h5>Password</h5>
           		   		<input type="password" class="input" name="password" id="myInput">
           		   </div>
           		</div>
           		</div>

           		<div class="blocks">
            	<div class="input-div one">
           		   <div class="div">
           		   		<h5>Confirm Password</h5>
           		   		<input type="password" class="input" name="confirm_password" id="myInput1">
           		   </div>
           		</div>
           		</div>

           		<div style="text-align: left; margin-bottom: 40px;">
								<input type="checkbox" onclick="myFunction()"> Show Password
           		</div>
           		
            	
            	<input type="submit" class="btn" name="register_btn" value="Signup">
							<a href="login.php" style="text-align:center; margin-bottom: 100px;">Already have an account?</a>
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

function myFunction() {
  var x = document.getElementById("myInput");
   var y = document.getElementById("myInput1");

  if (x.type === "password" && y.type === "password") {
    x.type = "text";
    y.type = "text";

  } else {
    x.type = "password";
    y.type = "password";

  }
}
</script>

<!-- <html>
		<head>
			<title>TradeBay</title>

		    <meta charset="utf-8">
		    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

		    <link rel="stylesheet" type="text/css" href="style.css">
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
			<div class="content" style="margin-bottom: 100px;">
				<div class="container">
					<div class="text-center">
						<h2>Customer Registration</h2>
						<?php //if(isset($_GET['error'])) { ?>
							<div class="alert alert-danger" role="alert">
							  	<?php //echo $_GET['error']; ?>
							</div>
						<?php //} ?>
					</div>
					<div class="my_content">
						<form action="register_process.php" method="POST" autocomplete="off">
							<div class="form-group">
								<label for="firstname">First Name:<span class="asterisk">*</span></label>
								<input type="firstname" class="form-control" name="firstname" placeholder="first name">
							</div>
							<div class="form-group">
								<label for="lastname">Last Name:<span>*</span></label>
								<input type="lastname" class="form-control" name="lastname" placeholder="last name">
							</div>
							<div class="form-group">
								<label for="address">House No#:<span>*</span></label>
								<input type="address" class="form-control" name="house_no" placeholder="#">
							</div>
							<div class="form-group">
								<label for="address">Barangay:<span>*</span></label>
								<input type="address" class="form-control" name="brgy" placeholder="ex. Sumacab este">
							</div>
							<div class="form-group">
								<label for="address">City:<span>*</span></label>
								<input type="address" class="form-control" name="city" placeholder="ex. Cabanatuan City">
							</div>
							<div class="form-group">
								<label for="address">Province:<span>*</span></label>
								<input type="address" class="form-control" name="province" placeholder="ex. Nueva Ecija">
							</div>
							<div class="form-group">
								<label for="email_address">Email Address:<span>*</span></label>
								<input type="email_address" class="form-control" name="email_address" placeholder="example@gmail.com">
							</div>
							<div class="form-group">
								<label for="contact">Contact No:<span>*</span></label>
								<input type="contact" class="form-control" name="contact" placeholder="+63xxxxxxxxx">
							</div>
							<div class="form-group">
								<label for="username">Username:<span>*</span></label>
								<input type="text" class="form-control" name="username" placeholder="username">
							</div>
							<div class="form-group">
								<label for="password">Password:<span>*</span></label>
								<input type="password" class="form-control" name="password" placeholder="password">				
							</div>
							<div class="form-group">
								<label for="password">Confirm Password:<span>*</span></label>
								<input type="password" class="form-control" name="confirm_password" placeholder="confirm password">
							</div>
							<div>
								<a href="login.php" style="color: #6781f5;">Already have an account?</a>
								<button type="submit" name="register_btn" class="btn btn-default" style="float: right">Register</button>
							</div>
						</form>
					</div>
				</div>
			</div>

		</body>
		</html> -->