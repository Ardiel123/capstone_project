<?php
	include('../include/dbconnection.php');
	include('../include/validate.php');
	include('../include/header.php');
	include('../include/navbar.php');

	$ann = $_GET['id'];

	$sql = "SELECT * FROM `announcement_tbl` WHERE announcement_id = '$ann'";
	$res = mysqli_query($db, $sql);
	$show_announce = mysqli_fetch_assoc($res);

	if (isset($_POST['update'])) {
		
		$up_content = mysqli_real_escape_string($db, $_POST['content']);

		$sql2 = "UPDATE `announcement_tbl` SET `content`='$up_content' WHERE announcement_id = '$ann'";
		mysqli_query($db, $sql2);

		if($_FILES['image']['name'] != ""){

			$up_file = $_FILES['image']['name'];
			$tmp_name = $_FILES['image']['tmp_name'];
			$div = explode('.', $up_file);
			$ext = strtolower(end($div));
			$unique_name = md5($div[0].time()).'.'.$ext;

			$destination ="../img/announcement/".$unique_name;
			$destination1 = "img/announcement/".$unique_name;
			move_uploaded_file($tmp_name, $destination);

			$sql3 = "UPDATE `announcement_tbl` SET `image`='$destination1' WHERE announcement_id = '$ann'";
			mysqli_query($db, $sql3);

			echo  '<script> window.location.href="update_announcement.php?id='.$ann.'";</script>';

		}

		echo  '<script> window.location.href="update_announcement.php?id='.$ann.'";</script>';
	}
?>
<style>
	.b{
		margin-right: 10px;
	}
	.my_div{width: 70%;}

	@media (max-width: 860px){

	 .my_div{width: 100%;}
	}
</style>

<div class="content">
	<div class="for_title">
		<h2>Update Announcement</h2>
	</div>
	<div class="my_content">
		<div class="panel panel-default my_div">
		  	<div class="panel-heading" style="height: 55px"></div>
		  	<div class="panel-body">

		  		<form method="POST" enctype="multipart/form-data">


		  			<div class="form-group">
		  				<label for="content">Content</label>
		  				<textarea class="form-control" placeholder="content here" name="content" rows="6"><?php echo $show_announce['content']; ?></textarea>
		  			</div>

		  			<div class="form-group">
				      	<label for="preimage">Image:</label><br>
				      	<img id="preimage" width="150px" height="150px" src="../<?php echo $show_announce['image']; ?>"><br>
				      	<input type="file" class="form-control" placeholder="Image" name="image" onchange="preview(event)">
				    </div>

				    <button type="submit" class="btn-sm btn-primary float-right" name="update">Update</button>
				    <button type="button" class="btn-sm btn-default float-right b" onclick="history.back();">Back</button>
				    
		  		</form>

		  	</div>
		</div>
	</div>
</div>

<script>
function preview(event){
	var output = document.getElementById('preimage');
	output.src = URL.createObjectURL(event.target.files[0]);
};
</script>