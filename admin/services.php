<?php
	include('../include/dbconnection.php');
	include('../include/validate.php');
	include('../include/header.php');
	include('../include/navbar.php');

	if (isset($_GET['all'])) {
		$show_orders_query = "SELECT ps.printing_service_id, ps.date_placed, ps.print_service_total, ps.status_id, ps.status_date, st.status_description, pt.payment_description, sd.recipient_name, sd.recipient_number, sd.ship_or_pickup_address, sd.date_to_receive FROM printing_service_tbl ps INNER JOIN status_tbl st ON ps.status_id = st.status_id INNER JOIN shipping_details_tbl sd ON ps.shipping_details_id = sd.shipping_details_id INNER JOIN payment_type_tbl pt ON ps.payment_type_id = pt.payment_type_id ORDER BY ps.date_placed ASC";
		$execute_orders = mysqli_query($db,$show_orders_query);
		$show_orders = mysqli_fetch_assoc($execute_orders);
	}

	if(isset($_GET['show'])){

		$check = $_GET['show'];

		$show_orders_query = "SELECT ps.printing_service_id, ps.date_placed, ps.print_service_total, ps.status_id, ps.status_date, st.status_description, pt.payment_description, sd.recipient_name, sd.recipient_number, sd.ship_or_pickup_address, sd.date_to_receive FROM printing_service_tbl ps INNER JOIN status_tbl st ON ps.status_id = st.status_id INNER JOIN shipping_details_tbl sd ON ps.shipping_details_id = sd.shipping_details_id INNER JOIN payment_type_tbl pt WHERE ps.payment_type_id = pt.payment_type_id AND ps.status_id = '$check' ORDER BY ps.date_placed ASC";
		$execute_orders = mysqli_query($db,$show_orders_query);
		$show_orders = mysqli_fetch_assoc($execute_orders);
	}


	if(isset($_POST['accept'])) {

		if(empty($_POST['selected_ids'])){
				echo "<script>
    						alert('You select nothing!');
    					</script>";
		}
		else
		{

			$check = true;
			$to_explode_ids = $_POST['selected_ids'];
			$explde = explode(",", $to_explode_ids);

			$count = count($explde);

			for ($x=0; $x < $count; $x++) 
			{ 
					$sql_qry ="SELECT status_id FROM `printing_service_tbl` WHERE printing_service_id = '$explde[$x]'";
					$exe_sql_qry = mysqli_query($db,$sql_qry);
					$status = mysqli_fetch_assoc($exe_sql_qry);

					if($status['status_id'] != 1){
							$check = false;
					}
			}
		
					if($check == true)
					{
						for ($i=0; $i < $count; $i++) 
						{ 
								$sql_acc = "UPDATE `printing_service_tbl` SET `status_id`= '2' WHERE printing_service_id = '$explde[$i]'";
								$exe_sql_acc = mysqli_query($db,$sql_acc);
						}

							echo "<script>
		    						alert('All items moved to accepted orders.');
										window.location.href='services.php?show=2';
		    					</script>";
		    	}
		    	else
		    	{
		    		echo "<script>
		    						alert('Please Accept only Pending orders.');
		    					</script>";
		    	}

		}

		
	}

	if(isset($_POST['deliver'])) {

		if(empty($_POST['selected_ids'])){
				echo "<script>
    						alert('You select nothing!');
    					</script>";
		}
		else
		{

			$check = true;
			$to_explode_ids = $_POST['selected_ids'];
			$explde = explode(",", $to_explode_ids);

			$count = count($explde);

			for ($x=0; $x < $count; $x++) 
			{ 
					$sql_qry ="SELECT status_id FROM `printing_service_tbl` WHERE printing_service_id = '$explde[$x]'";
					$exe_sql_qry = mysqli_query($db,$sql_qry);
					$status = mysqli_fetch_assoc($exe_sql_qry);

					if($status['status_id'] != 2){
							$check = false;
					}
			}
		
					if($check == true)
					{
						for ($i=0; $i < $count; $i++) 
						{ 
								$sql_acc = "UPDATE `printing_service_tbl` SET `status_id`= '5' WHERE printing_service_id = '$explde[$i]'";
								$exe_sql_acc = mysqli_query($db,$sql_acc);
						}

							echo "<script>
		    						alert('All items are to deliver.');
										window.location.href='services.php?show=5';
		    					</script>";
		    	}
		    	else
		    	{
		    		echo "<script>
		    						alert('Please Deliver only Accepted orders.');
		    					</script>";
		    	}

		}

	}

	if(isset($_POST['complete'])) {

		if(empty($_POST['selected_ids'])){
				echo "<script>
    						alert('You select nothing!');
    					</script>";
		}
		else
		{

			$check = true;
			$to_explode_ids = $_POST['selected_ids'];
			$explde = explode(",", $to_explode_ids);

			$count = count($explde);

			for ($x=0; $x < $count; $x++) 
			{ 
					$sql_qry ="SELECT status_id FROM `printing_service_tbl` WHERE printing_service_id = '$explde[$x]'";
					$exe_sql_qry = mysqli_query($db,$sql_qry);
					$status = mysqli_fetch_assoc($exe_sql_qry);

					if($status['status_id'] != 5){
							$check = false;
					}
			}
		
					if($check == true)
					{
						for ($i=0; $i < $count; $i++) 
						{ 
								$sql_acc = "UPDATE `printing_service_tbl` SET `status_id`= '4' WHERE printing_service_id = '$explde[$i]'";
								$exe_sql_acc = mysqli_query($db,$sql_acc);
						}

							echo "<script>
		    						alert('All items are marked as completed.');
										window.location.href='services.php?show=4';
		    					</script>";
		    	}
		    	else
		    	{
		    		echo "<script>
		    						alert('Please Mark as complete only Delivered orders.');
		    					</script>";
		    	}

		}

	}

	if(isset($_POST['cancel'])) {

		if(empty($_POST['selected_ids'])){
				echo "<script>
    						alert('You select nothing!');
    					</script>";
		}
		else
		{

			$check = true;
			$to_explode_ids = $_POST['selected_ids'];
			$explde = explode(",", $to_explode_ids);

			$count = count($explde);

			for ($x=0; $x < $count; $x++) 
			{ 
					$sql_qry ="SELECT status_id FROM `printing_service_tbl` WHERE printing_service_id = '$explde[$x]'";
					$exe_sql_qry = mysqli_query($db,$sql_qry);
					$status = mysqli_fetch_assoc($exe_sql_qry);

					if($status['status_id'] != 4){
							$check = false;
					}
			}
		
					if($check == true)
					{
						for ($i=0; $i < $count; $i++) 
						{ 
								$sql_acc = "UPDATE `printing_service_tbl` SET `status_id`= '3' WHERE printing_service_id = '$explde[$i]'";
								$exe_sql_acc = mysqli_query($db,$sql_acc);
						}

							echo "<script>
		    						alert('All items are cancelled.');
										window.location.href='services.php?show=4';
		    					</script>";
		    	}
		    	else
		    	{
		    		echo "<script>
		    						alert('Please cancel only pending orders.');
		    					</script>";
		    	}

		}
	}

	if (isset($_POST['searchdate'])) {

			  			$start = date("Y-m-d", strtotime($_POST['datefrom']." 00:00:00"));
			  			$end = date("Y-m-d", strtotime($_POST['dateto']." 24:00:00"));
			  			$search_by = $_POST['search_by'];

			  			if ($search_by == 1) {
			  				$search = "sd.date_to_receive";
			  				$order_by = "sd.date_to_receive ASC";
			  			}
							else if ($search_by == 2) {
			  				$search = "ps.date_placed";
			  				$order_by = "ps.date_placed ASC";
			  			}
			  			else if ($search_by == 3) {
			  				$search = "ps.status_date";
			  				$order_by = "ps.status_date ASC";
			  			}

			  			if (isset($_GET['all'])) {
			  					$show_orders_query = "SELECT ps.printing_service_id, ps.date_placed, ps.print_service_total, ps.status_id, ps.status_date, st.status_description, pt.payment_description, sd.recipient_name, sd.recipient_number, sd.ship_or_pickup_address, sd.date_to_receive FROM printing_service_tbl ps INNER JOIN status_tbl st ON ps.status_id = st.status_id INNER JOIN shipping_details_tbl sd ON ps.shipping_details_id = sd.shipping_details_id INNER JOIN payment_type_tbl pt ON ps.payment_type_id = pt.payment_type_id WHERE $search BETWEEN '$start' AND '$end' ORDER BY $order_by";
									$execute_orders = mysqli_query($db,$show_orders_query);
									$show_orders = mysqli_fetch_assoc($execute_orders);		



			  			}else if(isset($_GET['show'])){

			  					$st = $_GET['show'];

			  					$show_orders_query = "SELECT ps.printing_service_id, ps.date_placed, ps.print_service_total, ps.status_id, ps.status_date, st.status_description, pt.payment_description, sd.recipient_name, sd.recipient_number, sd.ship_or_pickup_address, sd.date_to_receive FROM printing_service_tbl ps INNER JOIN status_tbl st ON ps.status_id = st.status_id INNER JOIN shipping_details_tbl sd ON ps.shipping_details_id = sd.shipping_details_id INNER JOIN payment_type_tbl pt ON ps.payment_type_id = pt.payment_type_id WHERE $search BETWEEN '$start' AND '$end' AND ps.status_id = '$st' ORDER BY $order_by";
									$execute_orders = mysqli_query($db,$show_orders_query);
									$show_orders = mysqli_fetch_assoc($execute_orders);
			  			}	
			  						  					  		
			  	}
			

?>

<style>
	.stat_but{
		border:none; 
		border-radius: 5px; 
		width: 90px;
		height: 18px; 
		color: white;
		font-size: 10px;
	}
	.buttons .btn-link{
		border: none;
		outline: none;
	}
	@media (max-width: 960px) {
  	.menu ul .text { display: none; }
	}

	.tabs .nav-pills {
  	display: none;
	}
	.tabs .filter_small{
		display: none;
	}
	@media (max-width: 960px) {
  	.tabs ul  { display: none; }
  	.tabs .nav-pills { display: inline-block; }
  	.tabs .filter_small {display: inline-block; margin-top: 10px;}
  	div .filter{display: none;}
	}

</style>

<div class="content">
		<div class="for_title">
			<h2>Printing</h2>
		</div>

<nav class="tabs"> 

  <ul class="nav nav-tabs">
    <li><a href="services.php?all">All</a></li>
    <li><a href="services.php?show=1">Pending</a></li>
    <li><a href="services.php?show=2">Accepted</a></li>
    <li><a href="services.php?show=5">To Receive</a></li>
    <li><a href="services.php?show=4">Completed</a></li>
    <li><a href="services.php?show=3">Cancelled</a></li>
  </ul> 
  
  <ul class="nav nav-pills nav-stacked">
    <li class="dropdown">
      <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">Show <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="services.php?all">All</a></li>
		    <li><a href="services.php?show=1">Pending</a></li>
		    <li><a href="services.php?show=2">Accepted</a></li>
		    <li><a href="services.php?show=5">To Receive</a></li>
		    <li><a href="services.php?show=4">Completed</a></li>
		    <li><a href="services.php?show=3">Cancelled</a></li>                        
      </ul>
    </li>

  </ul>

  			<div class="filter_small">
						<form method="POST">
							<input class="form-control" type="text" id="datepicker1" name="datefrom" value="<?php echo (isset($_POST['datefrom']))?$_POST['datefrom']:'';?>" placeholder="Date from" style="width: 100px; display: inline-block;" required>
							 to <input class="form-control" type="text" id="datepicker2" name="dateto" value="<?php echo (isset($_POST['dateto']))?$_POST['dateto']:'';?>" placeholder="Date to" style="width: 100px; display: inline-block;" required>
							By: <select name="search_by" style="width: 20px; display: inline-block;">
								<option value="2" <?php echo (isset($search_by)&&($search_by==2)?"selected":"")?>>Date placed</option>
								<option value="1" <?php echo (isset($search_by)&&($search_by==1)?"selected":"")?>>to receive</option>
								<option value="3" <?php echo (isset($search_by)&&($search_by==3)?"selected":"")?>>Status Date</option>
							</select>
							<input type="submit" class="btn" name="searchdate" value="Filter">
						</form>
				</div>

</nav>
 
		<div class="my_content">

			<div class="panel panel-default" style="width: 100%; min-width: 350px">
			  	<div class="panel-heading" style="height: 55px">
				  	
						<div style="float: left;" class="filter">
						<form method="POST">
							<input class="form-control" type="text" id="datepicker1" name="datefrom" value="<?php echo (isset($_POST['datefrom']))?$_POST['datefrom']:'';?>" placeholder="Date from" style="width: 100px; display: inline-block;" required>
							 to <input class="form-control" type="text" id="datepicker2" name="dateto" value="<?php echo (isset($_POST['dateto']))?$_POST['dateto']:'';?>" placeholder="Date to" style="width: 100px; display: inline-block;" required>
							By: <select name="search_by" style="width: 20px; display: inline-block;">
								<option value="2" <?php echo (isset($search_by)&&($search_by==2)?"selected":"")?>>Date placed</option>
								<option value="1" <?php echo (isset($search_by)&&($search_by==1)?"selected":"")?>>to receive</option>
								<option value="3" <?php echo (isset($search_by)&&($search_by==3)?"selected":"")?>>Status Date</option>
							</select>
							<input type="submit" class="btn" name="searchdate" value="Filter">
						</form>
						</div>
						<div class="buttons" style="float: right;">
							<form method="POST">
								<nav class="menu"> 
								  <ul> 
								  	<input type="hidden" name="selected_ids" id="show">
								    <button type="submit" name="accept" class="btn btn-link" onclick="return confirm('Are you sure you want to accept all selected items')"><i class="fas fa-thumbs-up"></i> <span class="text">Accept</span></button>
								    <button type="submit" name="deliver" class="btn btn-link" onclick="return confirm('Are you sure you want to deliver all selected items')"><i class="fas fa-truck"></i> <span class="text">To Receive</span></button>
								    <button type="submit" name="complete" class="btn btn-link" onclick="return confirm('Are you sure you want to mark as complete all selected items')"><i class="fas fa-clipboard-check"></i> <span class="text">Mark as complete</span></button>
								   	<button type="submit" name="cancel" class="btn btn-link" onclick="return confirm('Are you sure you want to cancel all selected items')"><i class="fas fa-ban"></i> <span class="text">Cancel</span></button>
								  </ul> 

								</nav>
							</form>
						</div>
			  	</div>
			<div class="panel-body">
			<div class="container" style="width: 100%; height: 100%;">

				<table id="example" class="display nowrap" style="width: 100%;">
				    <thead>
				      <tr>
				      	<td><input type="checkbox" name="all_che" class="select_all" onClick="toggle(this); myFunc()"></td>
				      	<th>Service ID</th>
				      	<th>Date Placed</th>
				      	<th>Recipient Name</th>
				      	<th>Contact Number</th>
				      	<th>To Receive</th>
				      	<th>Address (House/Brgy/City/Province)</th>
				      	<th>Payment Type</th>
				        <th>Total</th>
				        <th>Status</th>
				       	<th>Actions</th>
				      </tr>
				    </thead>

				    <tbody>

				      	<?php 
				      		if (mysqli_num_rows($execute_orders) == 0) {
			  			?>
			  					<tr>
			  						<td colspan="10" class="text-center">Empty<td>
			  					</tr>
			  			<?php
			  				}
			  				else{
				      			do{ 

				      	?>
						  	<tr>
						  		<td class="text-center"><input type="checkbox" onclick="myFunc()" name="ids" value="<?php echo $show_orders['printing_service_id']; ?>"></td>
						  		<td class="my_id"><?php echo $show_orders['printing_service_id']; ?></td>
						  		<td><?php echo date("Y-m-d", strtotime($show_orders['date_placed'])); ?></td>
						  		<td><?php echo $show_orders['recipient_name']; ?></td>
						  		<td><?php echo $show_orders['recipient_number']; ?></td>
						  		<td><?php echo date("Y-m-d @ h:i A", strtotime($show_orders['date_to_receive'])); ?></td>
						  		<td><?php echo $show_orders['ship_or_pickup_address']; ?></td>
						  		<td><?php echo $show_orders['payment_description']; ?></td>	
							  	<td><?php echo number_format($show_orders['print_service_total'],2,".",","); ?></td>
							  	<td class="text-center">
							  		<?php
							  					if($show_orders['status_description'] == "pending"){
														?>
															<?php echo date("Y-m-d", strtotime($show_orders['status_date'])); ?><br>
															<button class="stat_but" type="button" style="background-color: #D67A0A;" disabled><?php echo $show_orders['status_description']; ?></button>	
														<?php
													}else if($show_orders['status_description'] == "accepted"){
														?>
															<?php echo date("Y-m-d", strtotime($show_orders['status_date'])); ?><br>
															<button class="stat_but" type="button" style="background-color: #099707;" disabled><?php echo $show_orders['status_description']; ?></button>
															
														<?php
													}else if($show_orders['status_description'] == "to receive"){
														?>
															<?php echo date("Y-m-d", strtotime($show_orders['status_date'])); ?><br>
															<button class="stat_but" type="button" style="background-color: #2063E9;" disabled><?php echo $show_orders['status_description']; ?></button>
															
														<?php
													}else if($show_orders['status_description'] == "cancelled"){
														?>
															<?php echo date("Y-m-d", strtotime($show_orders['status_date'])); ?><br>
															<button class="stat_but" type="button" style="background-color: #B62517;" disabled><?php echo $show_orders['status_description']; ?></button>
															
														<?php
													}else if($show_orders['status_description'] == "completed"){
														?>
															<?php echo date("Y-m-d", strtotime($show_orders['status_date'])); ?><br>
															<button class="stat_but" type="button" style="background-color: #979897;" disabled><?php echo $show_orders['status_description']; ?></button>
															
														<?php
													}
										?>
							  	</td>
							  	<td>
				  						<input type="hidden" name="view_id" value="<?php echo $show_orders['printing_service_id']; ?>">
				  						<input type="hidden" name="stat_id" value="<?php echo $show_orders['status_id']; ?>">
				  						<button class="view" type="button" name="view_items" id="view_items" style="border: none; background: none; outline: none; color: blue">View</button>
							  	</td>
				  		   	</tr>
						<?php 
								}while($show_orders = mysqli_fetch_assoc($execute_orders));
							}
						?>
				    </tbody>


				  	</table>

			</div>
		</div>
	</div>
</div>



</div>

<!-- Modal add order-->
			  <div id="view" class="modal fade" role="dialog">
			  <div class="modal-dialog" >

			    <div class="modal-content">
			      <div class="modal-header">
			      	<h4 class="modal-title" id="service_id">
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			        </h4>	
			      </div>

			      <div class="modal-body">
			      	<table class="table">
			  				<thead>
			  					<tr>
			  						<th>Image</th>
			  						<th>Service Type</th>
			  						<th>Size</th>
			  						<th>Qty</th>
			  						<th>Price/Sheet</th>
			  					</tr>
			  				</thead>
			  				<tbody class="data_view">

			      		</tbody>			
			  			</table>
			  		</div>		
					   <div class="modal-footer">
					        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        </form>
					    </div>
			    </div>
			    </form>
			  </div>
			</div>
			<!--end of modal-->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

$( function() {
	$( "#datepicker1" ).datepicker();
	$( "#datepicker2" ).datepicker();
} );

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

$(function($){
  let url = window.location.href;
  $('li a').each(function() {
    if (this.href === url) {
      $(this).closest('li').addClass('active');
    }
  });
});

$('input[name="ids"]').click(function(){
   if (!$(this).is(':checked')) {
       $('.select_all').prop('checked', false);
   }else if ($('input[name="ids"]:checked').length == $('input[name="ids"]').length){
   			$('.select_all').prop('checked', true);
   }
});


function toggle(source){
  checkboxes = document.getElementsByName('ids');

  	for(var i=0, n=checkboxes.length;i<n;i++) {
    	checkboxes[i].checked = source.checked;
  	}

}

function myFunc(){
    const checkboxes = document.querySelectorAll('input[name="ids"]:checked');

		let ord_id = [];
		checkboxes.forEach((checkbox) => {
		    ord_id.push(checkbox.value);
		});

  	document.getElementById("show").value = ord_id;
}

$(document).ready( function () {
  var table = $('#example').DataTable({
  	"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
  	"scrollX": true
  });

} );

	
$(document).ready(function(){
	$("#example").on('click','.view',function(e){
			e.preventDefault();

		var currentRow = $(this).closest("tr"); 
		var service =currentRow.find("td:eq(1)").text(); 

			$.ajax({
				type: "POST",
				url: "view_service.php",
				data: {
					'checking_viewbtn': true,
					'service_ID': service,
				},
				success: function(response){
					$('h4[id="service_id"]').text("#"+service);
					$('.data_view').html(response);
					$('#view').modal('show');
				}

			});	
		});
});
</script>