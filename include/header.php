<!DOCTYPE html>
<html>
<head>
	<title>TradeBay</title>
	    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link rel="stylesheet" type="text/css" href="../style/cardstyle.css">
</head>
<body>
	<input type="checkbox" id="check" class="chk">
	<header>
		<label for="check">
			<i class="fa fa-bars" aria-hidden="true" id="sidebar_btn"></i>
		</label>
		<div class="left_area">
			<a href="index.php"><h3>Trade <span style="font-size: 30px;">Bay</span></h3></a>
		</div>
		
		<div class="right_area">

						<h5 class="dropdown">	
							<a class="dropdown-toggle" href="#" data-toggle="dropdown" style="text-decoration: none; color: #fff">
								<i class="fa fa-user-circle" aria-hidden="true"></i>
								<?php
									echo ''.$_SESSION['username'].'';
								?> <span class="caret"></span>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li>
									<a  href="admin_acc.php">
										<i class="fas fa-cog" style="margin-right: 20px"></i>Account
									</a>
				
									<a  href="logout_process.php">
										<i class='bx bx-log-out' style="margin-right: 20px"></i> Logout
									</a>
								</li>
								
							</ul>
						</h5>
				
		</div>
	</header>