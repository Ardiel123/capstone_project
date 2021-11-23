<?php
include('../include/dbconnection.php');
include('../include/validate.php');
include('../include/header.php');
include('../include/navbar.php');

$id = $_GET['id'];

$query = "SELECT * FROM category_tbl WHERE category_id = '$id'";
$result = mysqli_query($db,$query);
$show_cat = mysqli_fetch_assoc($result);

if (isset($_POST['save'])) {

	$new_name = $_POST['name'];

	$query3 = "SELECT category_name FROM `category_tbl` WHERE category_name = '$new_name'";
	$result3 = mysqli_query($db, $query3);

	if(mysqli_num_rows($result3)){

		echo '<script> window.location.href="edit_category.php?id='.$id.'&err=Category already exist!";</script>';

	}else{

		$query3 = "UPDATE `category_tbl` SET `category_name`='$new_name' WHERE category_id = '$id'";
		mysqli_query($db,$query3);
		echo  '<script> window.location.href="category.php";</script>';	
	}

}

if (isset($_POST['back'])) {
	echo  '<script> window.location.href="category.php";</script>';
}

?>
	<div class="content">
		<div class="for_title">
			<h2>Edit Category</h2>
		</div>
		<?php if(isset($_GET['err'])) { ?>
			<div class="alert alert-danger" role="alert">
				<?php echo $_GET['err']; ?>
			</div>
		<?php } ?>
		<div class="my_content">

			<div class="panel panel-default" style="width: 50%;">
			  	<div class="panel-heading" style="height: 55px">

			  	</div>
			  	<div class="panel-body">

					<form method="POST">
						
						<div class="form-group">
							<label for=name >Category name:</label><br>
							<input type="text" class="form-control" name="name" value="<?php echo $show_cat['category_name']; ?>">
						</div>
					
						<div class="form-group">
							
							<input type="submit" class="btn-sm btn-default" name="back" value="Back">
							<input type="submit" class="btn-sm btn-primary" name="save" value="Save">
						</div>
					</form>
				</div>
			</div>
			
		</div>
	</div>
