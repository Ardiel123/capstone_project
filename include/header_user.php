<?php
	include ('include/dbconnection.php');
?>

<!DOCTYPE html> 
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>TradeBay</title>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="styleCustomer.css">

	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Rubik+Mono+One&display=swap" rel="stylesheet">

	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>	
	<style>
		h3{
			color: #fff;
		}
		.play{
  font-family: 'Playfair Display';
  font-style: italic;
  font-size: 46px;
}
	</style>

<div class="header">
		
	<div class="container">
		
		<div class="navbar">
		<div class="logo" style="margin-top: 10px">
			<a style="text-decoration: none;font-family: 'Rubik Mono One';font-weight: 200" class="headers" href="index.php"><h2 style="color: white">TRADE<span style="color: #cc7a00">BAY</span></h2></a>
		</div>
		<nav>

			<ul id="MenuItems">

				 	<li class="nav-item dropdown" >
				 		

				      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" style="margin-right: 0px;padding-right: 0px;"
				      >
				      	<i class="icon fa fa-user-circle" aria-hidden="true" style="font-size: 23px;"></i>
				      </a>
				      		 <div class="dropdown-menu dropdown-menu-right">
				      		 	<?php if(!isset($_SESSION['cus_name'])){ ?>
							<a class="dropdown-item" href="login.php">Login</a>

						<?php }else{ ?>
        						<a class="dropdown-item" href="account.php">Account</a>
        						<a class="dropdown-item" href="orders.php?all=0">Orders</a>
								<a class="dropdown-item" href="service_cart.php?all=0">Services</a>
      							<a class="dropdown-item" href="cus_logout_process.php">Logout</a>
    					 <?php } ?>
   							 </div>
   							
    				</li>

    				<li class="nav-item dropdown" >
    				
				      <a class="nav-link dropdown-toggle"  href="cart.php" style="margin-right: 0px;padding-right: 0px;padding-left: 0px">
				      	<i class=" icon fa fa-shopping-cart" aria-hidden="true"></i>

				      	<!-- count for cart -->
				      	<!-- <span style="color: #cc7a00;top:0;position: absolute;margin-left: 3px;font-size: 15px;">22</span> -->
				      	
				      </a>
				      		 <!-- <div class="dropdown-menu dropdown-menu-right" style="width: 370px;height: 350px;">

				      		 	<div class="row" style="max-width: 350px; margin: 5px 5px;">
								    <div class="col-3" >
								      	
								    </div>
								    <div class="col">
								      <h6 style="padding: 5px;text-align: center;">Product Name</h6>
								    </div>
								    <div class="col-3" >
								      <h6 style="padding: 5px;text-align: center;">Price</h6>
								    </div>
								</div>
								 <hr style="margin: 5px 7px;background-color: #cc7a00">

								<div class="row" style="max-width: 350px; margin: 5px 5px;">
								    <div class="col-3" >
								      	<img src="water.jpg" style="width: 60px; height: 60px;">
								    </div>
								    <div class="col">
								      <h6 style="padding: 5px;text-align: center;font-family: 'Poppins';">Ecija Fresh Sample product Sample</h6>
								    </div>
								    <div class="col-3" >
								      <h6 style="padding: 5px;text-align: center;color: #cc7a00;font-size: 15px">&#8369; 2500</h6>
								    </div>
								</div>

								 <hr style="margin: 5px 7px;">

								<div class="row" style="max-width: 350px; margin: 5px 5px;">
								    <div class="col-3" >
								      	<img src="kape.jpg" style="width: 60px; height: 60px;">
								    </div>
								    <div class="col">
								      <h6 style="padding: 5px;text-align: center;font-family: 'Poppins';">Kape Ecija</h6>
								    </div>
								    <div class="col-3" >
								      <h6 style="padding: 5px;text-align: center;color: #cc7a00;font-size: 15px">&#8369; 250</h6>
								    </div>
								</div>

									<hr style="margin: 5px 7px;">

								<div class="row" style="max-width: 350px; margin: 5px 5px;">
								    <div class="col-3" >
								      	<img src="mushroom.jpg" style="width: 60px; height: 60px;">
								    </div>
								    <div class="col">
								      <h6 style="padding: 5px;text-align: center;font-family: 'Poppins';">Mushroom</h6>
								    </div>
								    <div class="col-3" >
								      <h6 style="padding: 5px;text-align: center;color: #cc7a00;font-size: 15px">&#8369; 50</h6>
								    </div>
								</div>

   							 </div> -->
   							
    				</li>
    				
			</ul>
		</nav>
		<div class="menu-icon">
			<i class="fas fa-bars"  onclick="menutoggle()"></i>
		</div>

		</div>

	</div>
</div>

<script>
	var MenuItems = document.getElementById("MenuItems");

	 MenuItems.style.maxHeight = "0px";

	 function menutoggle(){
	 	if(MenuItems.style.maxHeight == "0px")
	 	{
	 		MenuItems.style.maxHeight = "200px";
	 	}
	 	else
	 	{
	 		MenuItems.style.maxHeight = "0px";
	 	}
	 }

</script>
 <style>

 	.icon{
 		color: white;font-size: 22px
 	}
 	.icon:hover{
 		color:  #cc7a00;
 	}
 	.nav2{
 		color: #170c82;font-family: 'Poppins';
 	}
 	.nav2:hover, .active{
 		color:  #cc7a00;
 	}
 	.dropdown-toggle::after {
    display:none;
	}
	.dropdown:hover>.dropdown-menu {
 	 display: block;
}
 </style>
</body>
</html>