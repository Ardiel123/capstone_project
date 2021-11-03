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
						<?php if(isset($_GET['error'])) { ?>
							<div class="alert alert-danger" role="alert">
							  	<?php echo $_GET['error']; ?>
							</div>
						<?php } ?>
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
		</html>