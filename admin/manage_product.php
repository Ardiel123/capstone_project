<?php

	include('../include/dbconnection.php');
	include('../include/validate.php');
	include('../include/header.php');
	include('../include/navbar.php');
	include('manage_product_process.php');

?>
<style>
	.product{
		width: 48%;
		float: left;
		margin-right: 20px;
	}
	.variation{
		float: left;
		width: 48%;
	}

	@media (max-width: 960px) {
		.product{width: 100%; float: none; margin-right: 0;}
		.variation{width: 100%; float: none;}
	}
</style>

<div class="content">
		<div class="for_title">
			<h2>Update Product</h2>
		</div>
		<div class="my_content">

			<div class="panel panel-default product">
				<div class="panel-heading" style="height: 55px">
					<h5 class="float-left">Product #: <?php echo $products['product_details_id']; ?></h5>
					<input type="hidden" id="prod_id" value="<?php echo $products['product_details_id']; ?>">
					<div class="data_view">
						<?php if($products['available'] == 1){ ?>
							<button class="btn-sm btn-primary stat float-right" id="stats" value="<?php echo $products['available']; ?>">Available</button>
						<?php }else if($products['available'] == 0){ ?>
							<button class="btn-sm stat float-right" id="stats" value="<?php echo $products['available']; ?>">Not Available</button>
						<?php } ?>
					</div>
					
				</div>
				<div class="panel-body prods">
					<form method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="category">Category:</label><br>
							<select name="category" class="form-control">
									<?php do{ ?>
									<option value="<?php echo $categories['category_id'] ?>"
										<?php
									  		if($categories['category_id'] == $products['category_id']){
									  			echo "selected";
									  		}
									  	?>
									><?php echo $categories['category_name'];?></option>
									<?php }while($categories = mysqli_fetch_assoc($result1)) ?>
							</select><br>
						</div>
						<div class="form-group">
							<label for=name>Product name:</label><br>
							<input class="form-control" type="text" name="name" value="<?php echo $products['product_name']; ?>"><br>
						</div>
						<div class="form-group">
							<label for=description>Description:</label><br>
							<textarea class="form-control" rows="3" type="text" name="description" style="resize: vertical;"><?php echo $products['product_description']; ?></textarea><br>
						</div>
						<div class="form-group">
							<label for=img>Image:</label><br>
							<img id="preimage" width="150px" height="150px" src="../<?php echo $products['product_image']; ?>"><br>
							<input class="form-control" type="file" name="img" id="img" onchange="preview(event)"><br>
						</div>
							<script>
								function preview(event){
									var output = document.getElementById('preimage');
									output.src = URL.createObjectURL(event.target.files[0]);
								};
							</script> 
						<div class="form-group">
							<input type="submit" name="back" value="Back" class="btn-sm btn-default">
							<input type="submit" name="save_all" value="Save" class="btn-sm btn-primary">
						</div>
					</form>
				</div>
			</div>

			<div class="panel panel-default variation">
				<div class="panel-heading" style="height: 55px">
					 
					<form method="POST">
						<h5 style="float: left;">Variations</h5>
						<button style="margin-left: -50%; float:right;" type="button" name="add" data-toggle="modal" data-target="#add" class="btn-sm btn-primary">
							<i class="fa fa-plus" aria-hidden="true"></i> Add
						</button>
					</form>
				</div>
				<div class="panel-body">
					<div class="container" style="width: 100%; height: 350px; overflow: auto;">
					<table class="table table-striped">
						<thead >
							<tr>
								<th>Unit/Weight</th>
								<th>Price</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if (mysqli_num_rows($result2) ==0) {
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
								<td><?php echo ''.$product_details['weight_value'].''.$product_details['abbreviation'].''; ?></td>
								<td><?php echo '₱'.$product_details['price'].''; ?></td>
								<td>
									<form method="POST">
										<input type="hidden" name="details_id" value="<?php echo $product_details['product_variation_id']; ?>">

										<button type="submit" class="btn-sm btn-success" name="edit">
											<i class="fa fa-eraser" aria-hidden="true" ></i> Edit
										</button>
									</form>
								</td>
							</tr>
							<?php 
									}while($product_details = mysqli_fetch_assoc($result2));
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
			<!-- Modal for add size-->
						  <div id="add" class="modal fade" role="dialog">
						  <div class="modal-dialog">

						    <div class="modal-content">
						      <div class="modal-header">
						      	<button type="button" class="close" data-dismiss="modal">&times;</button>
						        	<h4 class="modal-title">Add size</h4>
						      </div>
						      	<!--form-->
						      	<form method="POST">
						      		<div class="modal-body">
						        			<div class="form-group" style="width: 40%; display: inline-block;">
								    		<label for="category">Unit:</label>
								    		<select name="size" class="form-control" style="width: 100%">
									  			<option>Select unit:</option>
									  			<?php do{ ?>
									  				<option value="<?php echo $weight_unit['weight_unit_id'] ?>">
									  					<?php echo ''.$weight_unit['abbreviation'].' - '.$weight_unit['description'].'';?>
									  				</option>
									  			<?php }while($weight_unit = mysqli_fetch_assoc($result3)) ?>
									  		</select>
										  	</div>
										  	<div class="form-group" style="width: 40%; display: inline-block;">
										    	<label for="per_value">Value:</label>
										   	 	<input type="number" class="form-control" name="per_value" placeholder="0.00">
										  	</div>
										  	<div class="form-group">
										    	<label for="price_persize">Price:</label>
										   	 	<input type="number" class="form-control" step="any" name="price_persize" placeholder="0.00">
										  	</div>

								    </div>
								    <div class="modal-footer">
								        	<button type="button" class="btn-sm btn-default" data-dismiss="modal">Close</button>
								        	<button type="submit" class="btn-sm btn-primary" name="add_size_btn">Add</button>
								    </div>
						    </div>
						    </form>
						  </div>
						</div>
			<!--end of modal-->

		</div>
	</div>

<script>

$('.stat').click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "available.php",
        data: { 
        	stat_but: true,
        	product_id: document.getElementById("prod_id").value,
            id: $(this).val() 
        },
        success: function(response) {
            $('.data_view').html(response);
        }
    });
});


  	// $(document).ready(function(e){
   //      var id = document.getElementById("stats").value;

   //      if(id == 0){
   //      	$(".variation").css({ "pointer-events": 'none', "opacity": '0.7'});
   //      	$(".prods").css({ "pointer-events": 'none', "opacity": '0.7'});
   //      }else if(id == 1){
   //      	$(".variation").css({ "pointer-events": 'auto', "opacity": '1'});
   //      	$(".prods").css({ "pointer-events": 'auto', "opacity": '1'});
   //      }
   //  });
</script>