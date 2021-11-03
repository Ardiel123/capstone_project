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
			$size = $_POST['x'].'x'.$_POST['y'];
			$quantity = $_POST['quan'];
			$recipient_name = $_POST['recipient_name'];
			$recipient_number = $_POST['recipient_number'];
			$payment_option = $_POST['payment_option'];
			$status = 1;

			if ($service_type == "logo") {
					$total = $quantity * 200;
			}elseif ($service_type == "tarpaulin") {
					$total = $quantity * 800;
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

				$sql_add_det = "INSERT INTO `printing_service_tbl`(`service_type`,`print_service_image`,`print_service_size`,`print_service_quantity`,`print_service_total`,`customer_id`, `status_id`, `payment_type_id`, `shipping_details_id`) VALUES ('$service_type','$destination1','$size','$quantity','$total','$cus_id','$status','$payment_option','$the_ship_id')";
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

				$sql_add_det = "INSERT INTO `printing_service_tbl`(`service_type`,`print_service_image`,`print_service_size`,`print_service_quantity`,`print_service_total`,`customer_id`, `status_id`, `payment_type_id`, `shipping_details_id`) VALUES ('$service_type','$destination1','$size','$quantity','$total','$cus_id','$status','$payment_option','$the_ship_id')";
				$add_to_order = mysqli_query($db,$sql_add_det);

			}

	}


?>
<style>
	div .this{
		background: url("back.jpg");
		height: 500px;
		width: 100%;
		position: relative;
		background-repeat: no-repeat;
		background-size: 100% 100%;
	}
	.center {
	  margin: 0;
	  position: absolute;
	  top: 50%;
	  left: 50%;
	  -ms-transform: translate(-50%, -50%);
	  transform: translate(-50%, -50%);
	}
	.title_text{
    margin: 60px 0px 5px 20px;font-weight: 600;color: black;font-size: 40px;margin-bottom: 40px;font-family: 'Poppins';
  }
</style>
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
      <a class="nav-link nav2 active" href="services.php">Services</a>
    </li>
    
    
  </ul>
</div>
<hr style="margin: 0px;background-color: #dbdbdb;height: 1.5px;">

<body onload="calculate()" style="background-color: #f5f5f5">
<div class="container-md" style="height: 660px; margin-top: 70px;">
	<!-- <h3 class="title_text">Services</h3> -->
		<div class="this" style="margin-top: 30px">
			<div class="center">
				<form method="POST">
					<button type="submit" name="req" class="btn btn-primary" style="width: 200px; height: 60px;">Request Logo printing</button>
				</form>
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
        		<label for="serv_type">Service Type:</label>
        		<select name="serv_type" id="serv_type" class="form-control" onclick="calculate()">
        				<option value="tarpaulin">Tarpaulin Printing</option>
        				<option value="logo">Logo Printing</option>
        		</select>
        	</div>

        	<div class="form-group" >
        		<label for="image">Image:</label>
        		<input type="file" name="image" class="form-control">
        	</div>

        	<label for="size">Size (inches):</label>
        	<div class="form-group" >
        		<input type="number" name="x" class="form-control" value="2" style="float: left; width: 15%;" min="1" required>&nbsp;&nbsp;x&nbsp; 
        		<input type="number" name="y" class="form-control" value="2" style="width: 15%; float: right; margin-right: 65%" min="1" required>
        	</div>


        	<label for="quan">Sheets (Pcs):</label><br>
        	<button type="button" onclick="minus(); calculate();" style="padding: 5px 10px;margin-left: 0px"> - </button>
						<input type="text" id="quantity" name="quan" min="1" value="1" onchange="calculate()" onkeydown="return (event.keyCode!=13);" style="text-align: center; width: 15%;" readonly>
					<button type="button" onclick="add(); calculate();" style="padding: 5px 8px;">+</button>


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


	function calculate(){
		var service = document.getElementById("serv_type").value;

		if (service == "logo") {
			var quan = document.getElementById("quantity").value;
			document.getElementById("total").value = "₱"+Number(200 * quan).toFixed(2);
		} 
		else if (service =="tarpaulin") {
			var quan = document.getElementById("quantity").value;
			document.getElementById("total").value = "₱"+Number(800 * quan).toFixed(2);
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