<?php  include('include/dbconnection.php');
include('include/header_user.php'); ?> <style> @media only screen and
(max-width: 579px){ .container-sm{ max-width: 550px; } } @media only screen
and (max-width: 559px){ .container-sm{ max-width: 540px; } } </style>

 <hr style="margin: 0px;background-color: #dbdbdb;height: 2px;">
<div style="background-color: white;height: 60px; width: 100%">
  
<ul class="nav justify-content-center" style="padding: 10px 0px">
    <li class="nav-item " style="font-size: 19px;">
      <a class="nav-link nav2 " href="index.php" >Home</a>
    </li>
    <li class="nav-item" style="font-size: 19px;">
      <a class="nav-link nav2 " href="products.php">Products</a>
    </li>
    <li class="nav-item" style="font-size: 19px;">
      <a class="nav-link nav2" href="services.php">Services</a>
    </li>
    
    
  </ul>
</div>
<hr style="margin: 0px;background-color: #dbdbdb;height: 1.5px;">

<body style="background-color: #f5f5f5">
	<div class="container-md" style="margin-bottom: 30px">
	<h3 class="play" style="margin: 60px 0px 5px 20px;font-weight: 500;color: black;">Announcements</h3>
				
	</div>
	
	<div class="container-sm" style="min-height: 470px">
	<div class="row" style="background-color: white;padding-top: 30px;padding-bottom: 30px">
		<div class="col-md">
			<img src="img/kape.jpg" style="width: 350px;height: 350px;display: block;margin: auto;">
		</div>
		<div class="col-md" style="margin-top: 10px">
			<p style="text-indent: 50px">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
	</div>
				
	</div>


</body>
<?php 
	include('include/footer_user.php');
 ?>