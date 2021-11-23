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
