<?php
	include('../include/dbconnection.php');
	include('../include/validate.php');
	include('../include/header.php');
	include('../include/navbar.php');

	include('product_processes.php');
?>
<style>
	.form-group span{
		color: red;
	}
	table
	{
		table-layout: fixed;
	} 
	table td
	{
    	text-overflow:ellipsis;
    	overflow:hidden;
    	white-space:nowrap;
	}
</style>
	<div class="content">
		<div class="for_title">
			<h2>Products</h2>
		</div>
		<!-- Modal for add product-->
			  <div id="add_products" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <div class="modal-content">
			      <div class="modal-header">
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			        	<h4 class="modal-title">Add Product</h4>
			      </div>
			      	<!--form-->
			      	<form action="" method="POST" enctype="multipart/form-data">
			      		<div class="modal-body">

			      				<h4>Product Information</h4>
			        			<div class="form-group">
					    		<label for="category">Category: <span>*</span></label>
					    		<select name="category" class="form-control" style="width: 100%">
						  			<option>Select category</option>
						  			<?php do{ ?>
						  				<option value="<?php echo $categories['category_id'] ?>"><?php echo $categories['category_name'];?></option>
						  			<?php }while($categories = mysqli_fetch_assoc($result2)) ?>
						  		</select>
							  	</div>
							  	<div class="form-group">
							    	<label for="name">Name: <span>*</span></label>
							   	 	<input type="text" class="form-control" name="name" placeholder="product name">
							  	</div>
							  	<div class="form-group">
							    	<label for="description">Description: <span>*</span></label>
							   	 	<textarea type="text" class="form-control" name="description" placeholder="description" rows="3" style="resize: vertical;"></textarea>
							  	</div>
							  	<div class="form-group">
							    	<label for="img">Display Image: <span>*</span></label>
							   	 	<input type="file" class="form-control" name="img">
							  	</div>
							  	<div class="form-group" style="width: 40%; display: inline-block; margin: auto">
							    	<label for="size">Unit: <span>*</span></label>
							   	 	<select name="size" class="form-control">
									  			<option>Select unit:</option>
									  			<?php do{ ?>
									  				<option value="<?php echo $weight_unit['weight_unit_id'] ?>">
									  					<?php echo ''.$weight_unit['abbreviation'].' - '.$weight_unit['description'].'';?>	
									  				</option>
									  			<?php }while($weight_unit = mysqli_fetch_assoc($result4)) ?>
									</select>
							  	</div>
							  	<div class="form-group" style="width: 40%; display: inline-block; margin: auto;">
							    	<label for="value">Value: <span>*</span></label>
							   	 	<input type="number" class="form-control" name="value" step="any" value="1">
							  	</div>
							  	<div class="form-group">
							    	<label for="per_price">Price: <span>*</span></label>
							   	 	<input type="number" class="form-control" step="any" name="per_price">
							  	</div>		     
					    </div>
					    <div class="modal-footer">
					        	<button type="button" class="btn-sm btn-default" data-dismiss="modal">Close</button>
					        	<button type="submit" class="btn-sm btn-primary" name="add_btn">Add</button>
					    </div>
			    </div>
			    </form>
			  </div>
			</div>
			<!--end of modal-->

		<div class="my_content">

			<div class="panel panel-default" style="width: 100%; min-width: 350px">
			  <div class="panel-heading" style="height: 55px">
			  	<div style="float: left;">
			  		Filter by: <select name="cat" id="mylist" class="form-control" style="width: 90px; display: inline-block;" onchange="myFunction()">
						  	<option value="All">All</option>
						  	<?php do{ ?>
						  		<option value="<?php echo $category5['category_name'];?>"><?php echo $category5['category_name'];?></option>
						  	<?php }while($category5 = mysqli_fetch_assoc($result5)) ?>
						  	</select>
			  	</div>
			  	<button type="button" class="btn-sm btn-primary" style="margin-left: -50%; float:right;" data-toggle="modal" data-target="#add_products"><i class="fas fa-plus-circle"></i></i> Add</button>
			  </div>


			  <div class="panel-body">
			  	<div class="container" style="width: 100%; height: 100%;">
           
				  <table id="example" class="table table-striped " style="width: 100%">
				    <thead>
				      <tr>
				      	<th>Product ID#</th>
				        <th>Image</th>
				        <th>Category</th>
				        <th>Product Name</th>
				        <th>Description</th>
				        <th>Date_posted</th>
				       	<th>Actions</th>
				      </tr>
				    </thead>

				    <tbody>

				      	<?php 
				      		if (mysqli_num_rows($result) == 0) {
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
						  		<td><?php echo $show_products['product_details_id']; ?></td>
						  		<td>	
						  			<?php echo '<img src="../'.$show_products['product_image'].'" style="width: 50px; height: 50px;" >' ?>
						  		</td>
						  		<td><?php echo $show_products['category_name']; ?></td>
						  		<td><?php echo $show_products['product_name']; ?></td>
							  	<td><?php echo $show_products['product_description']; ?></td>
							  	<td><?php echo $show_products['date_posted']; ?></td>
							  	<td>
							  
								  		<a href="manage_product.php?id=<?php echo $show_products['product_details_id']; ?>" style="text-decoration: none; color: white;">
								  			<button type="button" class="btn-sm btn-success" name="manage">
								  				<i class="fas fa-edit"></i> Update
											</button>
								  		</a>
								  		
							  	</td>
				  		   	</tr>
						<?php 
								}while($show_products = mysqli_fetch_assoc($result));
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
  var table = $('#example').DataTable({
  	"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
  	"scrollX": true,
  	"bScrollCollapse": true
  });
});

function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("mylist");
  filter = input.value.toUpperCase();
  table = document.getElementById("example");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {

	  if(filter == "ALL"){
	    tr[i].style.display = "";
	  }else{
	  	td = tr[i].getElementsByTagName("td")[2];
	    if (td) {
	      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
	        tr[i].style.display = "";
	      } else {
	        tr[i].style.display = "none";
	      }
	    }
	  }       
 	}
}
</script>