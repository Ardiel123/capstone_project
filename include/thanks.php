
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
    <link rel="stylesheet" type="text/css" href="../style/my_style.css">
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
	<div class="content">
		<div class="container">
			<div class="text-center">
				<h3>We've sent an email to you, please verify your email to log in to page.<br>
				
				<span class="icon"><i class="fa fa-envelope fa-8x" aria-hidden="true"></i></span>
					
				<br>Thank you!</h3><br></br>		

				<a href="../login.php">Go back to Log-in</a>		
			</div>
		</div>
	</div>
</body>
</html>