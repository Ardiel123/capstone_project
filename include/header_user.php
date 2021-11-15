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

	<link rel="stylesheet" type="text/css" href="Customerstyle1.css">

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
<body>	
	

<div class="header">
		
	<div class="container">
		
		<div class="navbar">
		<div class="logo" >
			<a  class="header1" href="index.php"><h2 style="color: white">TRADE<span style="color: #cc7a00">BAY</span></h2></a>
		</div>
		<nav>

			<ul class="header-ul">

				 	<li class="nav-item dropdown">
				 		

				      <a class="nav-link dropdown-toggle header-a1" data-toggle="dropdown" href="#" 
				      >
				      	<i class="icon fa fa-user-circle" aria-hidden="true" ></i>
				      </a>
				      		 <div class="dropdown-menu dropdown-menu-right">
				      		 	<?php if(!isset($_SESSION['cus_name'])){ ?>
							<a class="dropdown-item" href="login.php">Login</a>

						<?php }else{ ?>
        						<a class="dropdown-item" href="account.php">
        							<i class='bx bxs-user-rectangle' style="margin-right: 15px"></i>
        							Account
        						</a>
        						<a class="dropdown-item" href="orders.php?all=0">
        							<i class='bx bxs-shopping-bag' style="margin-right: 15px"></i>
        						Orders</a>
								<a class="dropdown-item" href="service_cart.php?all=0">
								<i class='bx bxs-wrench' style="margin-right: 15px"></i>Services
								</a>
      							<a class="dropdown-item" href="cus_logout_process.php">
      								<i class='bx bx-log-out' style="margin-right: 15px"></i>
      							Logout</a>
    					 <?php } ?>
   							 </div>
   							
    				</li>

    				<li class="nav-item dropdown" >
    				
				      <a class="nav-link dropdown-toggle header-a2"  href="cart.php" >
				      	<i class=" icon fa fa-shopping-cart" aria-hidden="true"></i>
				      	
				      </a>
				      		
   							
    				</li>
    				
			</ul>
		</nav>
		

		</div>

	</div>
</div>
</body>
</html>