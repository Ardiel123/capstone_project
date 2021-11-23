<?php
	include('../include/dbconnection.php');
	include('../include/validate.php');
	include('../include/header.php');
	include('../include/navbar.php');

	$query3 = "SELECT * FROM customer_tbl";
	$result3 = mysqli_query($db,$query3);
	$show_cust = mysqli_fetch_assoc($result3);

?>
	<div class="content">
		<div class="for_title">
			<h2>Customers</h2>
		</div>
		<div class="my_content">

			<div class="panel panel-default">
			  	<div class="panel-heading" style="height: 55px">
			  		
			  	</div>
			  	<div class="panel-body">

			  		<div class="container" style="width: 100%; height: 600px; overflow: auto;">
			  			<table id="example" class="table table-striped" style="width: 100%">
			  				<thead>
			  					<tr>
			  						<th>Customer ID#</th>
			  						<th>Lastname</th>
			  						<th>Firstname</th>
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
			  							<td><?php echo $show_cust['customer_lname']; ?></td>
			  							<td><?php echo $show_cust['customer_fname']; ?></td>
			  							<td>
			  								<form method="POST">
				  								<button type="submit" name="view" class="btn-sm btn-link view">
				  									<i class="fas fa-search"></i> <span class="actions">View</span>
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

<!-- Modal -->
<div class="modal fade" id="view_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" name="cus_id">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
      	</h4>
      </div>
      <div class="modal-body">
        <div class="data_view">
        	
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
	
$(document).ready( function () {
  var table = $('#example').DataTable({
  	"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
  	"scrollX": true,
  	"bScrollCollapse": true
  });
});

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

$(document).ready(function(){
	$("#example").on('click','.view',function(e){
			e.preventDefault();

		var currentRow = $(this).closest("tr"); 
		var cus = currentRow.find("td:eq(0)").text(); 

			$.ajax({
				type: "POST",
				url: "view_customer.php",
				data: {
					'viewbtn': true,
					'cus_ID': cus,
				},
				success: function(response){
					$('h4[name="cus_id"]').text("Customer #"+cus);
					$('.data_view').html(response);
					$('#view_modal').modal('show');
				}
			});	
		});
});

</script>