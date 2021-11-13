<?php
	include('../include/dbconnection.php');
	include('../include/validate.php');
	include('../include/header.php');
	include('../include/navbar.php');

	$query = "SELECT * FROM category_tbl";
	$result = mysqli_query($db,$query);
	$show_categories = mysqli_fetch_assoc($result);



	if (isset($_POST['add_cat'])) {
		$cat_name = $_POST['cat_name'];

		$query3 = "SELECT category_name FROM `category_tbl` WHERE category_name = '$cat_name'";
		$result3 = mysqli_query($db, $query3);
	

		if (mysqli_num_rows($result3)){

			echo '<script> alert("Category already exist!")</script>';

		}else{
			$query2 = "INSERT INTO category_tbl(category_name) VALUES('$cat_name')";
			$result2 = mysqli_query($db, $query2);
			header("location: category.php");
		}
	}

	if (isset($_POST['edit'])) {

		$cat_id = $_POST['cat_id']; 
		header("location: edit_category.php?id=$cat_id");
	}

?>
<!-- The Modal -->
<div class="modal" id="add_category">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
	
	<form action="" method="POST">
      <!-- Modal body -->
      <div class="modal-body">
     		
			  <div class="form-group">
			    <label for="cat_name">Category name:</label>
			    <input type="text" class="form-control" placeholder="Enter category" name="cat_name">
			  </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      	<button type="submit" class="btn btn-primary" name="add_cat">Add</button>
      </div>
	</div>

    </form>

      </div>
</div>



	<div class="content">
		<div class="for_title">
			<h2>Categories</h2>
		</div>
		<div class="my_content">

			<div class="panel panel-default" style="width: 100%; min-width: 350px">
			  	<div class="panel-heading" style="height: 55px">
			  		<button type="button" class="btn-sm btn-primary" style="margin-left: -50%; float:right;" data-toggle="modal" data-target="#add_category"><i class="fas fa-plus-circle"></i> Add</button>
			  	</div>
			  	<div class="panel-body">
			  		<div class="container" style="width: 100%; height: 100%;">
			  			<table id="example" class="table table-striped display nowrap" style="width: 100%">
			  				<thead>
			  					<tr>
			  						<th>Category ID#</th>
			  						<th>Category name</th>
			  						<th>Actions</th>
			  					</tr>
			  				</thead>
			  				<tbody>
			  					<?php
					  				if (mysqli_num_rows($result) ==0) {
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
			  						<td><?php echo $show_categories['category_id']; ?></td>
			  						<td><?php echo $show_categories['category_name']; ?></td>
			  						<td>
			  							<form method="POST">
			  								<input type="hidden" name="cat_id" value="<?php echo $show_categories['category_id']; ?>">
				  							<button type="submit" class="btn-sm btn-success" name="edit">
												<i class="fas fa-edit"></i> Update
											</button>
										</form>
			  						</td>
			  					</tr>
			  					<?php
			  							}while($show_categories = mysqli_fetch_assoc($result));
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
  	"scrollX": true
  });
	});

</script>