<?php
	include('../include/dbconnection.php');
	include('../include/validate.php');
	include('../include/header.php');
	include('../include/navbar.php');

	$admin_id = $_SESSION['adm_id'];

	$sql = "SELECT * FROM `announcement_tbl` WHERE admin_id = '$admin_id'";
	$res = mysqli_query($db, $sql);
	$show_announce = mysqli_fetch_assoc($res);

	if (isset($_POST['add_btn'])) {

		$content = mysqli_real_escape_string($db, $_POST['content']);
		$file = $_FILES['image']['name'];

		if(empty($file)){
			$error = "Image cannot be empty";
			echo  '<script> 
					$(document).ready(function(){
					$("#myModal").modal("show");
					});
				</script>';
		}
		if(empty($content)){
			$error = "Content cannot be empty";
			echo  '<script> 
					$(document).ready(function(){
					$("#myModal").modal("show");
					});
				</script>';
		}
		else{

			$tmp_name = $_FILES['image']['tmp_name'];

			$div = explode('.', $file);
			$ext = strtolower(end($div));
			$unique_name = md5($div[0].time()).'.'.$ext;

			$destination ="../img/announcement/".$unique_name;
			$destination1 = "img/announcement/".$unique_name;
			move_uploaded_file($tmp_name, $destination);

			$insert_announcement = "INSERT INTO `announcement_tbl`(`content`, `image`, `admin_id`) VALUES ('$content','$destination1','$admin_id')";
			mysqli_query($db, $insert_announcement);

			echo  '<script> window.location.href="announcement.php";</script>';

		}
	}

	if (isset($_POST['remove'])) {
		$remove_id = $_POST['remove_id'];

		$sql1 = "DELETE FROM `announcement_tbl` WHERE announcement_id = '$remove_id'";
		mysqli_query($db, $sql1);

		echo  '<script> window.location.href="announcement.php";</script>';
	}

	if (isset($_POST['update'])) {
		
		$announcement_id = $_POST['ann_id'];
		echo  '<script> window.location.href="update_announcement.php?id='.$announcement_id.'";</script>';
	}



?>

<div class="content">
	<div class="for_title">
		<h2>Announcement</h2>
	</div>
	<div class="my_content">
		<div class="panel panel-default">
		  	<div class="panel-heading" style="height: 55px">
		  		<button type="button" class="btn-sm btn-primary" style="margin-left: -50%; float:right;" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus-circle"></i></i> Add</button>
			</div>
		 	<div class="panel-body">
		 		<table id="example" class="table table-striped" style="width: 100%">
				    <thead>
				      <tr>
				      	<th>Announcement ID</th>
				        <th>Date Published</th>
				        <th>Image</th>
				        <th>Content</th>
				        <th>Actions</th>
				      </tr>
				    </thead>
				    <tbody>
				    <?php 
				      	if (mysqli_num_rows($res) == 0) {
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
							        <td><?php echo $show_announce['announcement_id']; ?></td>
							        <td><?php echo date('Y-m-d', strtotime($show_announce['date_published'])); ?></td>
							        <td><?php echo '<img src="../'.$show_announce['image'].'" style="width: 50px; height: 50px;" >' ?></td>
							        <td class="announcement-content"><?php echo $show_announce['content']; ?></td>
							        <td>
							        	<form method="POST">
							        		<input type="hidden" name="ann_id" value="<?php echo $show_announce['announcement_id']; ?>">
							        	<button type="submit" class="btn-sm btn-success up upd" name="update"><i class="fas fa-edit ic"></i><span class="icon_text"> Update</span></button>
							        	<button type="button" class="btn-sm btn-danger rmv rem"><i class="fas fa-trash-alt ic"></i><span class="icon_text"> Remove<span></button>
							        	</form>
											</td>
							    </tr>
				    	<?php 
							}while($show_announce = mysqli_fetch_assoc($res));
						}
					?>
				    </tbody>
				  </table>
		 	</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add announcement</h4>
      </div>
	      <?php if(isset($error)) { ?>
					<div class="alert alert-danger" role="alert">
						<?php echo $error; ?>
					</div>
				<?php } ?>
      <div class="modal-body">

        <form method="POST" enctype="multipart/form-data">
		    <div class="form-group">
		      <label for="content">Content:</label>
		      <textarea class="form-control" placeholder="content here" name="content" rows="6"><?php if(isset($content)){ echo $content; } ?></textarea>
		    </div>
		    <div class="form-group">
		      <label for="preimage">Image:</label><br>
		      <img id="preimage" width="150px" height="150px" style="display: none;"><br>
		      <input type="file" class="form-control" placeholder="Image" name="image" onchange="preview(event)">
		    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-sm btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn-sm btn-primary" name="add_btn">Add</button>
      </div>

  		</form>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="removeModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Remove confirmation</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to remove this announcement.</p>
      </div>
      <div class="modal-footer">
      	<form method="POST">
      	<input type="hidden" name="remove_id" id="remove_id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="remove">Confirm</button>
        </form>
      </div>
    </div>

  </div>
</div>


<script>
	
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

function preview(event){
	var output = document.getElementById('preimage');
	output.src = URL.createObjectURL(event.target.files[0]);
	document.getElementById("preimage").style.display = "block";
};

$(document).ready( function () {
  var table = $('#example').DataTable({
  	"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
  	"scrollX": true,
  	"bScrollCollapse": true
  });
});


$(document).ready(function(){
    $(".rmv").on("click", function () {

    var currentRow = $(this).closest("tr"); 
		var val =currentRow.find("td:eq(0)").text(); 
               
		document.getElementById('remove_id').value = val;

				$(document).ready(function(){
					$("#removeModal").modal("show");
				});
    });
});

</script>