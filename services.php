<?php
	include('include/dbconnection.php');
	include('include/header_user.php');



	$query_payment = "SELECT * FROM payment_type_tbl";
	$res4 = mysqli_query($db,$query_payment);
	$payment = mysqli_fetch_assoc($res4);

	if (isset($_POST['req'])) {
		
		if (isset($_SESSION['user_id'])) {

			echo "<script type='text/javascript'>
					$(document).ready(function(){
					$('#myModal').modal('show');
					});
				</script>";
		}
		else{

			header("location: login.php");
		}
	}

	if (isset($_POST['place'])) {

		$file = $_FILES['image']['name'];
		$tmp_name = $_FILES['image']['tmp_name'];

		$div = explode('.', $file);
		$ext = strtolower(end($div));
		$unique_name = md5($div[0].time()).'.'.$ext;

		$destination ="printimg/".$unique_name;
		$destination1 = "printimg/".$unique_name;
		move_uploaded_file($tmp_name, $destination);

			$cus_id = $_POST['customer_id'];
			$service_type = $_POST['serv_type'];
			$quantity = $_POST['quan'];
			$recipient_name = $_POST['recipient_name'];
			$recipient_number = $_POST['recipient_number'];
			$payment_option = $_POST['payment_option'];
			$status = 1;

			if ($service_type == 2) {
					$price = 200;
					$total = $quantity * $price;
					$size = $_POST['x'].'x'.$_POST['y'].' INCH';

			}elseif ($service_type == 1) {
					$explode_price = $_POST['size_tarp'];
					$expl = explode("|", $explode_price);

					$price = $expl[0];
					$size = $expl[1];

					$total = $quantity * $price;
			}

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

				$sql_add_det = "INSERT INTO `printing_service_tbl`(`service_type`,`print_service_image`,`print_service_price`,`print_service_size`,`print_service_quantity`,`print_service_total`,`customer_id`, `status_id`, `payment_type_id`, `shipping_details_id`) VALUES ('$service_type','$destination1','$price','$size','$quantity','$total','$cus_id','$status','$payment_option','$the_ship_id')";
				$add_to_order = mysqli_query($db,$sql_add_det);
				
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

				$sql_add_det = "INSERT INTO `printing_service_tbl`(`service_type`,`print_service_image`,`print_service_price`,`print_service_size`,`print_service_quantity`,`print_service_total`,`customer_id`, `status_id`, `payment_type_id`, `shipping_details_id`) VALUES ('$service_type','$destination1','$price','$size','$quantity','$total','$cus_id','$status','$payment_option','$the_ship_id')";
				$add_to_order = mysqli_query($db,$sql_add_det);

			}

	}


?>
<style>
	
</style>

<hr class="hr1">
<div class="nav-div1">
  
<ul class="nav justify-content-center">
    <li class="nav-item navli" >
      <a class="nav-link nav2 " href="index.php" >Home</a>
    </li>
    <li class="nav-item navli" >
      <a class="nav-link nav2 " href="products.php">Products</a>
    </li>
    <li class="nav-item navli" >
      <a class="nav-link nav2" href="services.php">Services</a>
    </li>
    
    
  </ul>
</div>
<hr class="hr2">

<body class="bcolor" onload="calculate()">
<div class="container services-container" >
		<div class="this">
			<div class="center-services">

					<button type="button" name="req" class="btn btn-primary btn-services" data-toggle="modal" data-target="#myModal" >Request for Printing</button>

			</div>
		</div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

    	<?php
				$get_cus_info = "SELECT * FROM customer_tbl WHERE customer_id = '$_SESSION[user_id]'";
				$info = mysqli_query($db,$get_cus_info);
				$show_info = mysqli_fetch_assoc($info);
			?>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Printing Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
        	<input type="hidden" name="customer_id" value="<?php echo $_SESSION['user_id']; ?>">

        	<div class="form-group" >
        		<label for="image">Image:</label>
        		<input type="file" name="image" class="form-control">
        	</div>

        	<div class="form-group" >
        		<label for="serv_type">Service Type:</label>
        		<select name="serv_type" id="serv_type" class="form-control" onchange="showsize(this)" onclick="calculate()">
        				<option value="1">Tarpaulin Printing</option>
        				<option value="2">Logo Printing</option>
        		</select>
        	</div>

        	<div id="for_tarp" style="display:block;">
        		<label for="size_tarp">Size (Feet):</label>
        			<select name="size_tarp" id="pri" class="form-control" onclick="calculate()">
        				<option value="1000|2x2 FT">2x2 FT</option>
        				<option value="2000|3x3 FT">3x3 FT</option>
        			</select>
        	</div>

        	<div id="for_logo" style="display:none;">
        			<label for="size_logo">Size (inches):</label>
		        	<div class="form-group" >
		        		<input type="number" name="x" class="form-control services-x" value="2"  min="1" required>&nbsp;&nbsp;x&nbsp; 
		        		<input type="number" name="y" class="form-control services-y" value="2"  min="1" required>
		        	</div>
        		
        	</div>


        	<label for="quan">Sheets (Pcs):</label><br>
        	<button type="button" onclick="minus(); calculate();" class="services-minus"> - </button>
						<input type="text" id="quantity" name="quan" min="1" value="1" onchange="calculate()" onkeydown="return (event.keyCode!=13);" class="services-quan" readonly>
					<button type="button" onclick="add(); calculate();" class="services-plus">+</button>


        	<div class="form-group" >
        		<label for="total">Total:</label>
        		<input style="font-weight: bold;" type="text" id="total" name="total" class="form-control" value="" readonly>
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
				     			<label for="houseno" class="label1-services">House #:</label>
				     			<label for="brgy">Barangay:</label>
				     			<div class="form-group">
				     				<input type="text" name="houseno" class="form-control input1-services"  value="<?php echo $show_info['house_no']; ?>">
				     				<input type="text" name="brgy" class="form-control input2-services"  value="<?php echo $show_info['barangay']; ?>">
				     			</div>

				     			<label for="city" class="label2-services">City/Municipality:</label>
				     			<label for="brgy">Province:</label>
				     			<div class="form-group">
				     				<input type="text" name="city" class="form-control input3-services"  value="<?php echo $show_info['city']; ?>">
				     				<input type="text" name="province" class="form-control input4-services"  value="<?php echo $show_info['province']; ?>">

				     				<br><br>
				     				<p><i>Important: The customer will pay for the shipping cost charged by the courier.<br><span style="color: red">By clicking checkout you've agreed to this policy.</span><i></p>
				     			</div>
				     		</div>

				     		<div id="for_pick" style="display:none;">
				     		<hr><h5>Pick-up Information </h5>
				     		<label for="houseno" class="label3-services">Select campus:</label>
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

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="place" class="btn btn-primary">Submit</button>
      </div>
      	</form>
    </div>
  </div>
</div>
</body>
<?php 
  include('include/footer_user.php');
 ?>

<script>

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

	function showsize(select){

	   if(select.value==1){
	    document.getElementById('for_tarp').style.display = "block";
	    document.getElementById('for_logo').style.display = "none";
	   } else if(select.value==2){
	    document.getElementById('for_logo').style.display = "block";
	    document.getElementById('for_tarp').style.display = "none";
	   }
	}

	function calculate(){
		var service = document.getElementById("serv_type").value;

		if (service == 2) {
			var quan = document.getElementById("quantity").value;
			document.getElementById("total").value = "???"+Number(200 * quan).toFixed(2);
		} 
		else if (service == 1) {
			var quan = document.getElementById("quantity").value;
			var val = document.getElementById("pri").value;
			var pri = val.split("|");

			document.getElementById("total").value = "???"+Number(pri[0] * quan).toFixed(2);
		}
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
	
	//prevent form submit (modal popup) on refreshing the page
	if ( window.history.replaceState ) {
  		window.history.replaceState( null, null, window.location.href );
	}
</script>