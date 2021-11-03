<?php
include('../include/dbconnection.php');
include('../include/validate.php');
include('../include/header.php');
include('../include/navbar.php');

include('edit_variant_process.php');

?>
	<div class="content">
		<div class="for_title">
			<h2>Edit Variant</h2>
		</div>
		<div class="my_content">

			<div class="panel panel-default" style="width: 50%;">
			  	<div class="panel-heading" style="height: 55px">

			  	</div>
			  	<div class="panel-body">

					<form method="POST">
						<div class="form-group">
							<label for=size >Size:</label><br>
							<select name="size" class="form-control">
								<?php do{?>
								<option value="<?php echo $show['weight_unit_id']; ?>"
										<?php
											if ( $show['weight_unit_id'] == $show1['weight_unit_id']){
												echo "selected";
											}
										?>
									>
									<?php echo ''.$show['abbreviation'].' - '.$show['description'].'';?>
								</option>
							<?php }while($show = mysqli_fetch_assoc($result))?>
							</select>
						</div>
						<div class="form-group">
							<label for=value >Value:</label><br>
							<input type="number" class="form-control" name="value" step="any" value="<?php echo $show1['weight_value']; ?>">
						</div>
						<div class="form-group">
							<label for=price >Price:</label><br>
							<input type="number" class="form-control" name="price" step="any" value="<?php echo $show1['price']; ?>">
						</div>
						<div class="form-group">
							<input type="hidden" name="id" value="<?php echo $show1['product_variation_id']; ?>">
							<input type="hidden" name="product_id" value="<?php echo $show1['product_details_id']; ?>">
							
							<input type="submit" class="btn btn-default" name="back" value="Back">
							<input type="submit" class="btn btn-primary" name="save" value="Save">
						</div>
					</form>
				</div>
			</div>
			
		</div>
	</div>
<?php
	include('include/footer.php');
?>