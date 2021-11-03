<?php 

	include('include/dbconnection.php');
	include('include/header_user.php');

	$product_id = $_GET['id'];

	$sql = "SELECT * FROM product_details_tbl WHERE product_details_id = $product_id";
	$result = mysqli_query($db,$sql);
	$show_product = mysqli_fetch_assoc($result);

	$sql3 = "SELECT product_variation_tbl.product_variation_id,weight_unit_tbl.weight_unit_id,product_variation_tbl.weight_value,product_variation_tbl.product_details_id,weight_unit_tbl.abbreviation,product_variation_tbl.price FROM weight_unit_tbl JOIN product_variation_tbl ON weight_unit_tbl.weight_unit_id = product_variation_tbl.weight_unit_id WHERE product_details_id = $product_id;";
	$res3 = mysqli_query($db,$sql3);
	$row3 = mysqli_fetch_assoc($res3);

	$query_payment = "SELECT * FROM payment_type_tbl";
	$res4 = mysqli_query($db,$query_payment);
	$payment = mysqli_fetch_assoc($res4);


	if (isset($_POST['to_cart'])) {

		if (isset($_SESSION['user_id'])) {
		
			$id_to_explode = $_POST['size'];
			$explde = explode("|", $id_to_explode);

			$variation_id = $explde[1];
			$product_det_id = $explde[2];
			$quanti = $_POST['quantity'];

			$query_variation = "SELECT product_details_tbl.product_name, product_variation_tbl.price, product_variation_tbl.weight_value, weight_unit_tbl.abbreviation FROM product_details_tbl INNER JOIN product_variation_tbl ON product_details_tbl.product_details_id = product_variation_tbl.product_details_id INNER JOIN weight_unit_tbl ON product_variation_tbl.weight_unit_id = weight_unit_tbl.weight_unit_id AND product_variation_id = '$variation_id'";
			$query_variation_execute = mysqli_query($db,$query_variation);
			$show_variation = mysqli_fetch_assoc($query_variation_execute);

			$total = $show_variation['price'] * $quanti;

			echo "<script type='text/javascript'>
					$(document).ready(function(){
					$('#add_to_order').modal('show');
					});
				</script>";
		}
		else{
			echo  '<script> window.location.href="login.php";</script>';
		}
	}

	if(isset($_POST['add_to_order'])){
		
			$customer_id = $_POST['customer_id'];
			$variation_id = $_POST['variation_id_num'];
			$quantity = $_POST['quantity'];
			$total = $_POST['totprice'];
			$current_price = $_POST['price'];
			$recipient_name = $_POST['recipient_name'];
			$recipient_number = $_POST['recipient_number'];
			$payment_option = $_POST['payment_option'];
			$status = 1;

			date_default_timezone_set('Asia/Manila');

			if ($payment_option == 1) {

				$startTime = date("Y-m-d h:i:sa");
				$date_to_receive = date('Y-m-d h:i:sa',strtotime('+5 day',strtotime($startTime)));
				$address = $_POST['houseno'].'/'.$_POST['brgy'].'/'.$_POST['city'].'/'.$_POST['province'];

				$sql_add_ship = "INSERT INTO `shipping_details_tbl`(`recipient_name`, `recipient_number`, `ship_or_pickup_address`, `date_to_receive`) VALUES ('$recipient_name','$recipient_number','$address','$date_to_receive')";
				mysqli_query($db,$sql_add_ship);

				$ship_id = "SELECT MAX(shipping_details_id) AS ship_id FROM shipping_details_tbl";
				$execute_ship_id = mysqli_query($db,$ship_id);
				$show_ship_id = mysqli_fetch_assoc($execute_ship_id);

				$the_ship_id = $show_ship_id['ship_id'];

				$sql_add_det = "INSERT INTO `order_details_tbl`(`total`, `status_id`, `customer_id`, `payment_type_id`, `shipping_details_id`) VALUES ('$total','$status','$customer_id','$payment_option','$the_ship_id')";
				$add_to_order = mysqli_query($db,$sql_add_det);

				$last_id_query = "SELECT MAX(order_details_id) AS last_id FROM order_details_tbl";
				$execute_last_id = mysqli_query($db,$last_id_query);
				$show_last_id = mysqli_fetch_assoc($execute_last_id);

				$the_last_id = $show_last_id['last_id'];

				$sql_add_item = "INSERT INTO `order_items_tbl`(`quantity`, `current_price`, `product_variation_id`, `order_details_id`) VALUES ('$quantity', '$current_price','$variation_id','$the_last_id')";
				$add_to_order = mysqli_query($db,$sql_add_item);
				
			}
			else if($payment_option == 2){

				$to_receive = $_POST['to_receive'];
				$address = $_POST['campus'];


				$sql_add_ship = "INSERT INTO `shipping_details_tbl`(`recipient_name`, `recipient_number`, `ship_or_pickup_address`, `date_to_receive`) VALUES ('$recipient_name','$recipient_number','$address','$to_receive')";
				mysqli_query($db,$sql_add_ship);

				$ship_id = "SELECT MAX(shipping_details_id) AS ship_id FROM shipping_details_tbl";
				$execute_ship_id = mysqli_query($db,$ship_id);
				$show_ship_id = mysqli_fetch_assoc($execute_ship_id);

				$the_ship_id = $show_ship_id['ship_id'];

				$sql_add_det = "INSERT INTO `order_details_tbl`(`total`, `status_id`, `customer_id`, `payment_type_id`, `shipping_details_id`) VALUES ('$total','$status','$customer_id','$payment_option','$the_ship_id')";
				$add_to_order = mysqli_query($db,$sql_add_det);

				$last_id_query = "SELECT MAX(order_details_id) AS last_id FROM order_details_tbl";
				$execute_last_id = mysqli_query($db,$last_id_query);
				$show_last_id = mysqli_fetch_assoc($execute_last_id);

				$the_last_id = $show_last_id['last_id'];

				$sql_add_item = "INSERT INTO `order_items_tbl`(`quantity`, `product_variation_id`, `order_details_id`) VALUES ('$quantity','$variation_id','$the_last_id')";
				$add_to_order = mysqli_query($db,$sql_add_item);
			}
	}

	if (isset($_POST['to_array'])) {

		if (isset($_SESSION['user_id'])) {
		
			if(!isset($_SESSION['cart'])){
				$_SESSION['cart']= array();
			}

			if (isset($_POST['to_array'])) {
				
				$id_to_explode = $_POST['size'];
				$explde = explode("|", $id_to_explode);

				$variation_id = $explde[1];
				$quanti = $_POST['quantity'];
				$unitprice = $_POST['unit_pri'];


					if(isset($_SESSION['cart'][$variation_id])){
						$_SESSION['cart'][$variation_id] += $quanti;
					}
					else if(!isset($_SESSION['cart'][$variation_id])){
						$_SESSION['cart'][$variation_id] = $quanti;
					}

			}
		}
		else{

			echo  '<script> window.location.href="login.php";</script>';

		}
	}


?>
<style>
	.rowpad{
		padding-left: 1px;
	}
	.img-prod{
		width: 400px; height: 450px;
		}
	.title_text{
		margin: 60px 0px 5px 20px;font-weight: 600;color: black;font-size: 40px;margin-bottom: 40px;font-family: 'Poppins';
	}
	.size-1{
		width: 130px;text-align: center;border-color: #dbdbdb;
	}
	.button-1{
		width:150px;background-color: #cc7a00;color: white;
	}
	.button-2{
		width: 150px;background-color: #170c82;color: white;
	}
	@media only screen and (max-width: 600px){
		.rowpad{
			padding-left: 25px;
		}
		.title_text{
			font-size: 35px;
		}
		.prod_name{
			font-size: 30px;
		}
	}
	@media only screen and (max-width: 991px){
		.prod_name{
				margin-top: 10px;
		}
	}
	@media only screen and (max-width: 425px){
		.img-prod{
			width: 300px;height: 320px;
		}
		.size-1{
		width: 100px;
		}
		.button-1,.button-2{
			width: 130px;
		}
		.title_text{
			font-size: 30px;
		}
	}


</style>
<hr style="margin: 0px;background-color: #dbdbdb;height: 2px;">
<div style="background-color: white;height: 60px; width: 100%">
  
<ul class="nav justify-content-center" style="padding: 10px 0px">
    <li class="nav-item " style="font-size: 19px;">
      <a class="nav-link nav2 " href="index.php" >Home</a>
    </li>
    <li class="nav-item" style="font-size: 19px;">
      <a class="nav-link nav2 active" href="products.php">Products</a>
    </li>
    <li class="nav-item" style="font-size: 19px;">
      <a class="nav-link nav2" href="services.php">Services</a>
    </li>
    
    
  </ul>
</div>

<hr style="margin: 0px;background-color: #dbdbdb;height: 1.5px;">


<body onload="calculate()" style="background-color:#F5F5f5">
<div class="container-sm" style="margin-top: 50px;min-height: 660px">

	<h3  class="title_text" style="">Product Detail</h3>

	<div class="row" style="text-align: center">
  		<div class="col-lg">
  			<?php echo '<img class="img-prod" src="'.$show_product['product_image'].'"  >'; ?>
  		</div>
  		<div class="col-lg">
  			<!-- product name -->
  			<div class="row">
  				<div class="col-lg">
  				<h1 class="prod_name" style="color: black;"><?php echo $show_product['product_name'] ?></h1>
  				</div>
  			</div>

  			<!-- price -->
  			<div class="row rowpad" style="margin-bottom: 10px">
  				<div class="col-lg" style="text-align: left">
  					<div class="row">
  						<div class="col-lg">
  							<label for="price" style="font-size: 18px"><b>Price: </b></label> 
				
  						</div>
  					</div>
  					<div class="row" >
  						<div class="col-lg">
  							<input type="text" name="price_total" id="display" style="padding: 10px; font-weight: bold; width: 130px;border-style: none;color: #cc7a00;font-size: 23px;background-color: #f5f5f5;font-family: ''" disabled>
  						</div>
  					</div>
  				</div>
  			</div>	

  			<!-- description -->
  			<div class="row rowpad">
  				<div class="col-lg">
	  			<p style="text-align: left;">
	  				<b style="font-size: 18px;">Product Description:</b><br>
	  				<textarea rows=5 style="padding: 10px; resize: none; width: 100%;border-style: none;margin-top: 8px;margin-bottom: 0px;background-color: #f5f5f5;" disabled><?php echo $show_product['product_description']; ?></textarea>
	  			</p>
  				</div>
  			</div>


  			<form style="text-align: left" method="POST" name="price_form">
  				<input type="hidden" name="unit_pri" value="<?php echo $row3['price']; ?>">

  			
  			<div class="row" style="margin-top: 0px">
  				<!-- size -->
  				<div class="col">
  				<div class="form-group">
  					<div class="row rowpad">
  						<div class="col-lg">
						<label for="size"> <b style="font-size: 18px;">Size:</b></label>
						</div>
					</div>
					<div class="row rowpad">
						<div class="col-lg">
						<select class="form-control size-1" name="size" id="size" onchange="calculate()" style="">
						
						<?php do{?>
							<option value="<?php echo $row3['price'].'|'.$row3['product_variation_id'].'|'.$row3['product_details_id']; ?> ">
								<?php echo " ",$row3['weight_value'],$row3['abbreviation']," "; ?>
							</option>
						<?php }while($row3 = mysqli_fetch_assoc($res3)); ?>	
						</select>
						</div>
					</div>
				</div>
				</div>

				<!-- Quantity -->
				<div class="col">

  				<div class="form-group">
					<div class="row">
						<div class="col-lg" >					
						<label for="quantity" > <b style="font-size: 18px;">Quantity:</b></label>
						</div>
					</div>	
					<div class="row ">
						<div class="col-lg">
				<button type="button" onclick="minus(); calculate();" style="padding: 5px 10px;margin-right: 0px;height: 40px;background-color: #ffffff;border-style: solid;border-right-style: none;border-color: #dbdbdb"> <b>-</b> </button>
					<input type="text" id="quantity" name="quantity" min="1" value="1" size="5" onchange="calculate()" onkeydown="return (event.keyCode!=13);" style="text-align: center;margin-left: 0px;height: 40px;border-style: solid;border-color: #dbdbdb;border-left-style: none;border-right-style: none;" readonly>
				<button type="button" onclick="add(); calculate();" style="padding: 5px 8px;height: 40px;background-color: #ffffff;border-style: solid;border-left-style: none;border-color: #dbdbdb"><b>+</b></button>
						</div>
					</div>
					</div>
				</div>
			</div>
			
				

				
				<div class="row ">
				<div class="col">
					<div class="row rowpad">
						<div class="col">
							<div class="form-group">
							   	<button type="submit" name="to_array" class="form-control btn button-1" style="">Add to Cart</button>
							</div>
						</div>
					</div>
					
				</div>
				<div class="col">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<button type="submit" name="to_cart" class="form-control btn button-2" style="">Buy Now</button>
							</div>
						</div>
					</div>
					
				</div>
				</div>
  			</form>
  		</div>
	</div>
</div>

	<!-- Modal add order-->
			  <div id="add_to_order" class="modal fade" role="dialog">
			  <div class="modal-dialog">
			  	<?php
			  		$get_cus_info = "SELECT * FROM customer_tbl WHERE customer_id = '$_SESSION[user_id]'";
					$info = mysqli_query($db,$get_cus_info);
					$show_info = mysqli_fetch_assoc($info);
			  	?>

			    <div class="modal-content">
			      <div class="modal-header">
			      	<h4 class="modal-title">Order Details</h4>
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			        	
			      </div>
			      	<!--form-->
			      	<form action="" method="POST">
			      		<div class="modal-body">
			      			<input type="hidden" name="customer_id" value="<?php echo $_SESSION['user_id']; ?>">
			      			<input type="hidden" name="variation_id_num" value="<?php echo $variation_id; ?>">
				      		<div class="form-group">
				      			<label for="var_id">Product Name:</label>
								<input type="text" name="var_id" class="form-control" value="<?php echo $show_variation['product_name']; ?>" readonly>
							</div>
							<div class="form-group">
				      			<label for="size">Size:</label>
				        		<input type="text" name="size" class="form-control" value="<?php echo $show_variation['weight_value'].''.$show_variation['abbreviation']; ?>" readonly>
				     		</div>
				     		<label for="price" style="margin-right: 24%"> Unit Price: ₱</label>
				     		<label for="quantity">Quantity:</label>
				      		<div class="form-group">
				        		<input style="width: 40%; float: left; margin-right: 5px" type="text" name="price" class="form-control" value="<?php echo $show_variation['price']; ?>" readonly>
				        		<input style="width: 40%" type="text" name="quantity" class="form-control" value="<?php echo $quanti; ?>" readonly>
				     		</div>
				     	
				     		<div class="form-group">
				      			<label for="totprice">Total: ₱</label>
				        		<input type="text" name="totprice" class="form-control" value="<?php echo $total; ?>" readonly>
				     		</div>

				     		<hr><h5>Contact information</h5>
				     		<div class="form-group">
				     			<label for="recipient_name">Recipient Name:</label>
				     			<input type="text" name="recipient_name" class="form-control" value="<?php echo $show_info['customer_fname'].' '.$show_info['customer_lname'] ?>">
				     		</div>
				     		<div class="form-group">
				     			<label for="recipient_number">Contact number:</label>
				     			<input type="text" name="recipient_number" class="form-control" value="<?php echo $show_info['customer_phonenumber'] ?>">
				     		</div>

				     		<div class="form-group">
				      			<label for="payment_option">Payment option:</label><br>
				        		<select name="payment_option" id="payment_option" class="form-control" onchange="showDiv(this)">
				        			<?php do{ ?>
				        				<option value="<?php echo $payment['payment_type_id']; ?>"><?php echo $payment['payment_description']; ?></option>
				        			<?php }while($payment=mysqli_fetch_assoc($res4))?>
				        		</select>
				     		</div>
				     		

				     		<div id="hidden_div" style="display:block;">
				     		<hr><h5>Shipping Information</h5>
				     			<label for="houseno" style="margin-right: 27%">House #:</label>
				     			<label for="brgy">Barangay:</label>
				     			<div class="form-group">
				     				<input type="text" name="houseno" class="form-control" style="width: 40%; float: left; margin-right: 5px" value="<?php echo $show_info['house_no']; ?>">
				     				<input type="text" name="brgy" class="form-control" style="width: 50%; float: left; margin-right: 5px" value="<?php echo $show_info['barangay']; ?>">
				     			</div>

				     			<label for="city" style="margin-right: 15%">City/Municipality:</label>
				     			<label for="brgy">Province:</label>
				     			<div class="form-group">
				     				<input type="text" name="city" class="form-control" style="width: 40%; float: left; margin-right: 5px" value="<?php echo $show_info['city']; ?>">
				     				<input type="text" name="province" class="form-control" style="width: 50%; float: left; margin-right: 5px" value="<?php echo $show_info['province']; ?>">

				     				<br><br>
				     				<p><i>Important: The customer will pay for the shipping cost charged by the courier.<br><span style="color: red">By clicking checkout you've agreed to this policy.</span><i></p>
				     			</div>
				     		</div>

				     		<div id="for_pick" style="display:none;">
				     		<hr><h5>Pick-up Information </h5>
				     		<label for="houseno" style="margin-right: 27%">Select campus:</label>
				     			<select class="form-control" name="campus">
				     				<option value="Sumacab campus">Sumacab Campus</option>
				     				<option value="Gabaldon campus">Gabaldon Campus</option>
				     				<option value="General Tinio campus">General Tinio Campus</option>
				     			</select>

				     			<div class="form-group">
				     				<label for="to_receive">Date and Time of pick up:</label>
				     				<input type="datetime-local" id="to_receive" name="to_receive" class="form-control">
				     			</div>
				     		</div>


					    </div>
					    <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					        <button type="submit" class="btn btn-primary" name="add_to_order">Checkout</button>
					    </div>
			    </div>
			    </form>
			  </div>
			</div>
			<!--end of modal-->

			

</body>

<?php 
		include('include/footer_user.php');
 ?>

<script>

	function calculate(){

		var size = document.getElementById("size").value;
		var price_str = size.toString();
		const price = price_str.split("|");
		
		var quan = document.getElementById("quantity").value;
		document.getElementById("display").value = "₱ "+Number(price[0] * quan).toFixed(2);
	}
	function add(){
		var count = document.getElementById("quantity").value;
		count++;
		document.getElementById("quantity").value = count;
	}
	function minus(){
		var count = document.getElementById("quantity").value;

		if (count != 1) {
			count--;
			document.getElementById("quantity").value = count;
		}else{
			count = 1;
			document.getElementById("quantity").value = count;
		}
	}
	
	function showDiv(select){

	   if(select.value==1){
	    document.getElementById('hidden_div').style.display = "block";
	    document.getElementById('for_pick').style.display = "none";
	    to_receive.removeAttribute("required");
	   } else if(select.value==2){
	    document.getElementById('for_pick').style.display = "block";
	    document.getElementById('hidden_div').style.display = "none";
	    to_receive.setAttribute("required", "");
	   }
	} 


	//prevent form submit (modal popup) on refreshing the page
	if ( window.history.replaceState ) {
  		window.history.replaceState( null, null, window.location.href );
	}
	
</script>