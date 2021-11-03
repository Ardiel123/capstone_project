<?php
	include('../include/dbconnection.php');
	include('../include/validate.php');
	include('../include/header.php');
	include('../include/navbar.php');

	$query3 = "SELECT * FROM customer_tbl";
	$result3 = mysqli_query($db,$query3);
	$show_cust = mysqli_fetch_assoc($result3);

	if (isset($_POST['delete'])) {

		$customer_id = $_POST['customer_id'];
		$query4 = "DELETE FROM `customer_tbl` WHERE customer_id = '$customer_id'";
		mysqli_query($db,$query4);
		header("location: customer.php");
	}

	if (isset($_POST['edit'])) {

		$customer_id = $_POST['customer_id']; 
		header("location: edit_customer.php?id=$customer_id");
	}
?>
	<div class="content">
		<div class="for_title">
			<h2>Users</h2>
		</div>
		<div class="my_content">

			<div class="panel panel-default">
			  	<div class="panel-heading" style="height: 55px">
			  		
			  	</div>
			  	<div class="panel-body">

			  		<div class="container" style="width: 100%; height: 600px; overflow: auto;">
			  			<table id="example" class="table table-striped">
			  				<thead>
			  					<tr>
			  						<th>Customer ID#</th>
			  						<th>Full name</th>
			  						<th>Address</th>
			  						<th>Email</th>
			  						<th>Phone number</th>
			  						<th>Actions</th>
			  					</tr>
			  				</thead>
			  				<tbody>
			  					<?php 
			  						if (mysqli_num_rows($result3) ==0) {
			  							?>
			  								<tr>
			  									<td colspan="6" class="text-center">No Entry<td>
			  								</tr>
			  							<?php
			  						}
			  						else{

			  							do{
			  						
			  					?>
			  						<tr>
			  							<td><?php echo $show_cust['customer_id']; ?></td>
			  							<td><?php echo ''.$show_cust['customer_fname'].' '.$show_cust['customer_lname'].''; ?></td>
			  							<td><?php echo '#'.$show_cust['house_no'].'/'.$show_cust['barangay'].'/'.$show_cust['city'].'/'.$show_cust['province'].''; ?></td>
			  							<td><?php echo $show_cust['customer_email']; ?></td>
			  							<td><?php echo $show_cust['customer_phonenumber']; ?></td>
			  							<td>
			  								<form method="POST">
				  								<input type="hidden" name="customer_id" value="<?php echo $show_cust['customer_id']; ?>">
				  								<button type="submit" name="edit" class="btn btn-success">
				  									<i class="fa fa-eraser" aria-hidden="true" ></i> Edit
				  								</button>
				  								<button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete <?php echo ''.$show_cust['customer_fname'].' '.$show_cust['customer_lname'].''; ?>?')">
				  									<i class="fa fa-ban" aria-hidden="true" ></i> Delete
				  								</button>
				  							</form>
			  							</td>
			  						</tr>
			  					<?php
			  							}while ($show_cust = mysqli_fetch_assoc($result3)); 
			  						}
			  					?>
			  				</tbody>
			  				
			  			</table>
			  		</div>
			  		
			  	</div>
			</div>
			
		</div>
	</div>

<script type="text/javascript">
	
$(document).ready( function () {
  var table = $('#example').DataTable();
} );

</script>