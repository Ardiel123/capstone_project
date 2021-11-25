<?php 

	include('include/dbconnection.php');
	include('include/validate_user.php');
	include('include/header_user.php');

	$cus_id = $_SESSION['user_id'];

	if (isset($_GET['all'])){

		$sql_show_order = "SELECT * FROM order_details_tbl WHERE customer_id = '$cus_id'";
		$exe_show_order = mysqli_query($db, $sql_show_order);
		$show_order = mysqli_fetch_assoc($exe_show_order);

		?>
		<style>
			.but1 {
	  			background-color: #697272 ;
	  			color: #F4F8F8;
			}
		</style>
		<?php
	}

	else if (isset($_GET['pen'])) {

		$status = $_GET['pen'];

		$sql_show_order = "SELECT * FROM order_details_tbl WHERE customer_id = '$cus_id' AND status_id ='$status' ";
		$exe_show_order = mysqli_query($db,$sql_show_order);
		$show_order = mysqli_fetch_assoc($exe_show_order);

		?>
		<style>
			.but2 {
	  			background-color: #697272 ;
	  			color: #F4F8F8;
			}
		</style>
		<?php
	}

	else if (isset($_GET['acc'])) {

		$status = $_GET['acc'];

		$sql_show_order = "SELECT * FROM order_details_tbl od WHERE od.customer_id = '$cus_id' AND status_id ='$status' ";
		$exe_show_order = mysqli_query($db,$sql_show_order);
		$show_order = mysqli_fetch_assoc($exe_show_order);

		?>
		<style>
			.but3 {
	  			background-color: #697272 ;
	  			color: #F4F8F8;
			}
		</style>
		<?php
	}

	else if (isset($_GET['can'])) {

		$status = $_GET['can'];

		$sql_show_order = "SELECT * FROM order_details_tbl od WHERE od.customer_id = '$cus_id' AND status_id ='$status' ";
		$exe_show_order = mysqli_query($db,$sql_show_order);
		$show_order = mysqli_fetch_assoc($exe_show_order);

		?>
		<style>
			.but4 {
	  			background-color: #697272 ;
	  			color: #F4F8F8;
			}
		</style>
		<?php
	}

	else if (isset($_GET['com'])) {

		$status = $_GET['com'];

		$sql_show_order = "SELECT * FROM order_details_tbl od WHERE od.customer_id = '$cus_id' AND status_id ='$status' ";
		$exe_show_order = mysqli_query($db,$sql_show_order);
		$show_order = mysqli_fetch_assoc($exe_show_order);

		?>
		<style>
			.but5 {
	  			background-color: #697272 ;
	  			color: #F4F8F8;
			}
		</style>
		<?php
	}
	else if (isset($_GET['del'])) {

		$status = $_GET['del'];

		$sql_show_order = "SELECT * FROM order_details_tbl od WHERE od.customer_id = '$cus_id' AND status_id ='$status' ";
		$exe_show_order = mysqli_query($db,$sql_show_order);
		$show_order = mysqli_fetch_assoc($exe_show_order);

		?>
		<style>
			.but6 {
	  			background-color: #697272 ;
	  			color: #F4F8F8;
			}
		</style>
		<?php
	}


	if (isset($_POST['view_items'])) {

		$id = $_POST['view_id'];
		$stat_id = $_POST['stat_id'];

		$sql_view = "SELECT pd.product_image,pd.product_name,oi.current_price, oi.quantity, od.total, od.status_id, pv.product_variation_id,pv.weight_value,wu.abbreviation FROM product_details_tbl pd INNER JOIN product_variation_tbl pv ON pv.product_details_id = pd.product_details_id INNER JOIN order_items_tbl oi ON oi.product_variation_id = pv.product_variation_id INNER JOIN order_details_tbl od ON oi.order_details_id = od.order_details_id INNER JOIN weight_unit_tbl wu ON pv.weight_unit_id = wu.weight_unit_id WHERE od.order_details_id = '$id'";
		$exe_view = mysqli_query($db,$sql_view );
		$view = mysqli_fetch_assoc($exe_view);


		echo "<script type='text/javascript'>
				$(document).ready(function(){
				$('#view').modal('show');
				});
			</script>";
	}
	if (isset($_POST['cancel_ord'])) {

		$cancel_id = $_POST['cancel_order_id'];

		$sql_cncl_item = "UPDATE order_details_tbl SET status_id = 3 WHERE order_details_id ='$cancel_id'";
		mysqli_query($db,$sql_cncl_item);

		
		echo "<script>
				alert('Order Successfully cancelled');
				window.location.href='orders.php?all=0';
			</script>";
	}
	

?>
<style>
	
	
	@media (max-width: 960px) {
		.empty{width: 250px; height: 300px;}
	}
	
	
</style>

<hr class="hr1">
<div class="nav-div1">
  
<ul class="nav justify-content-center">
    <li class="nav-item navli" >
      <a class="nav-link nav2 " href="index.php" >Home</a>
    </li>
    <li class="nav-item navli" >
      <a class="nav-link nav2 " href="products.php">Products</a>
    </li>
    <li class="nav-item navli" >
      <a class="nav-link nav2" href="services.php">Services</a>
    </li>
    
    
  </ul>
</div>
<hr class="hr2">

<body class="bcolor">
	<div class="container-md">
	<h3 class="order-title" >My Orders</h3>
		
	</div>
<div class="container-sm order-div1" >
		<div class="my_content">

			<div class="panel panel-default">
			  	<div class="panel-heading order-panel" >
			  		
			  	</div>
			  	<div class="panel-body">
			  		<div class="container order-body" >
			  			<table>
			  				
			  				<thead>
			  					<tr>
			  						<form method="GET">
			  							<div class="row order1" >
			  								
			  										<div class="col-sm row-order" >
			  										<center>
					  								<button style="outline: none; border: none;" class="but1 btn btn-outline-secondary" type="submit" name="all" value="0">All</button>
							  						</center>
							  						</div>
							  						
							  						<div class="col-sm row-order">
							  						<center>
					  									<button style="outline: none; border: none;" class="but2 btn btn-outline-secondary" type="submit" name="pen" value="1">Pending</button>
					  								</center>
							  						</div>
							  						<div class="col-sm row-order">
					  								<center>	
							  						<button style="outline: none; border: none;" class="but3 btn btn-outline-secondary" type="submit" name="acc" value="2">Accepted</button>
							  						</center>
							  						</div>
			  								
			  								
			  								
			  										<div class="col-sm row-order" >
			  										<center>
			  										<button style="outline: none; border: none;" class="but6 btn btn-outline-secondary" type="submit" name="del" value="5">To recieve</button>
			  										</center>
							  						</div>
							  						<div class="col-sm row-order">
							  						<center>
					  									<button style="outline: none; border: none;" class="but4 btn btn-outline-secondary" type="submit" name="can" value="3">Cancelled</button>
					  								</center>
							  						</div>
							  						<div class="col-sm row-order">
							  						<center>
					  										<button style="outline: none; border: none;" class="but5 btn btn-outline-secondary" type="submit" name="com" value="4">Completed</button>
					  								</center>
							  						</div>
					  							
			  								
					  						

			  							</div>
			  							
			  						</form>
			  					</tr>
			  				</thead>
			  				<hr>
			  				<tbody>
			  					<?php
					  				if (mysqli_num_rows($exe_show_order) == 0) {
					  			?>
					  				
					  					<img class="empty" src="img/index/noorder.png" width="400" height="300" style="margin: auto; display: block;">
					  					
					  			<?php
					  				}
					  				else{	

					  					do{
			  					?>
			  						<tr>
			  							<center>
			  							<div class="row">
			  									
					  								<div class="col-sm row1-order">
					  									<?php echo "ORD_NUM".$show_order['order_details_id']; ?>
					  								</div>
					  								<div class="col-sm row1-order order3" >
					  									<?php echo $show_order['date_ordered']; ?>
					  								</div>
					  							
			  						
			  								
					  								<div class="col-sm row1-order">
					  									<?php

						  									$sql_count_item = "SELECT count(order_details_id) AS items FROM order_items_tbl WHERE order_details_id = '$show_order[order_details_id]'";
															$exe_count_item = mysqli_query($db,$sql_count_item);
															$count_item = mysqli_fetch_assoc($exe_count_item);

															echo "x".$count_item['items']." item";
						  								?>
					  								</div>
					  								<div class="col-sm row1-order">
					  									<?php

						  									$sql_total = "SELECT total FROM order_details_tbl WHERE order_details_id = '$show_order[order_details_id]'";
															$exe_total = mysqli_query($db,$sql_total);
															$total = mysqli_fetch_assoc($exe_total);

															echo "Total: ₱".number_format($total['total'],2,".",",");
						  								?>	
					  								</div>
					  						
			  							
			  								
					  								<div class="col-sm row1-order">
					  									<?php

						  									$sql_stat = "SELECT * FROM status_tbl WHERE status_id = '$show_order[status_id]'";
															$exe_stat = mysqli_query($db,$sql_stat);
															$stat = mysqli_fetch_assoc($exe_stat);

															if($stat['status_description'] == "pending"){
																?>
																	<button class="stat_but" type="button" style="background-color: #D67A0A;" disabled><?php echo $stat['status_description']; ?></button>
																<?php
															}else if($stat['status_description'] == "accepted"){
																?>
																	<button class="stat_but" type="button" style="background-color: #099707;" disabled><?php echo $stat['status_description']; ?></button>
																<?php
															}else if($stat['status_description'] == "to receive"){
																?>
																	<button class="stat_but" type="button" style="background-color: #2063E9;" disabled><?php echo $stat['status_description']; ?></button>
																<?php
															}else if($stat['status_description'] == "cancelled"){
																?>
																	<button class="stat_but" type="button" style="background-color: #B62517;" disabled><?php echo $stat['status_description']; ?></button>
																<?php
															}else if($stat['status_description'] == "completed"){
																?>
																	<button class="stat_but" type="button" style="background-color: #979897;" disabled><?php echo $stat['status_description']; ?></button>
																<?php
															}
															
															

						  								?>
					  								</div>
					  								<div class="col-sm row1-order">
					  									<form method="POST">
							  								<input type="hidden" name="view_id" value="<?php echo $show_order['order_details_id']; ?>">
							  								<input type="hidden" name="stat_id" value="<?php echo $show_order['status_id']; ?>">
							  								<button type="submit" name="view_items" style="border: none; background: none; outline: none; color: blue">View</button>
						  								</form>
					  								</div>
					  						
			  						</div>	
				  					</center>
			  						</tr>
			  						<hr>
			  					<?php	
			  							}while($show_order = mysqli_fetch_assoc($exe_show_order));
			  						}
			  					?>
			  				</tbody>
			  			</table>
			  	
			  		</div>
				</div>
			</div>
		</div>	
</div>
<?php 
		include('include/footer_user.php');
 ?>

<!-- Modal add order-->
			  <div id="view" class="modal fade" role="dialog">
			  <div class="modal-dialog" >

			    <div class="modal-content">
			      <div class="modal-header">
			      	<h4 class="modal-title">ORD_NUM<?php echo $id; ?></h4>
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			        	
			      </div>
			      	<!--form-->
			      	<form action="" method="POST">
			      		<div class="modal-body">
			      		<div class="container order-modal1" >
			  			<table class="table table-bordered">
			  				<thead>
			  					<tr>
			  						<th>Product</th>
			  						<th>Price</th>
			  						<th>Subtotal</th>
			  					</tr>
			  				</thead>
			  				<tbody>
			  					<?php
			  						$g_total = 0;
			  						do{
			  					?>
			  					<tr>	
			  							<?php 
			  								$subtotal = $view['current_price'] * $view['quantity'];
			  								$g_total += $subtotal;  
			  							?>
				  						<td>
				  							<div class="row">
				  							<div class="col">
				  						<?php echo '<img src="'.$view['product_image'].'" style="width: 60px; height: 60px;" >'; ?>
				  						</div>
				  						<div class="col" style="min-width: 120px; ">
				  							<div class="row">
				  								<div class="col" class="pname">
				  									<b><?php echo $view['product_name']; ?></b>
				  								</div>
				  							</div>
				  							<div class="row">
				  								<div class="col">
				  								<?php echo "x".$view['quantity']; ?>
				  								</div>
				  							</div>
				  							<div class="row">
				  								<div class="col">
				  								<?php echo "Size: ".$view['weight_value'].' '.$view['abbreviation']; ?>
				  								</div>
				  							</div>

				  							
				  							
				  						</div>
				  							</div>
				  						</td>
				  						
				  						<td style="vertical-align: middle;text-align: center;"><?php echo $view['current_price']; ?></td>
				  						
				  						<td style="vertical-align: middle;text-align: center;"><?php echo "₱".number_format($subtotal,2,".",","); ?></td>
				  				</tr>	
				  				<?php	
			  						}while($view = mysqli_fetch_assoc($exe_view));
			  					?>
			  					<tr>
			  						<td colspan="2" align="right"><?php echo "<b>Total:</b>"; ?></td>
			  						<td colspan="1" style="text-align: center;"><?php echo "<b>₱".number_format($g_total,2,".",",")."</b>"; ?></td>
			  					</tr>
			  					<tr>
			  						<td colspan="7" style="white-space: initial;">
			  							<p><i>You've agreed that if youre outside Cabanatuan city you will add additional <b>₱80</b> when the item is delivered.<i></p>
			  						</td>
			  					</tr>
			  					<tr>
			  						<?php if( $stat_id == 1){ ?>
			  							<form method="POST">
			  								<input type="hidden" name="cancel_order_id" value="<?php echo $id; ?>">
			  							<td colspan="7" align="right"><button type="submit" name="cancel_ord" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel order <?php echo "ORD_NUM".$id; ?>? you will repeat the process again if you want to order.')">Cancel order</button></td>
										</form>
			  						<?php }else
			  								{
			  									$sql_sts = "SELECT * FROM status_tbl st INNER JOIN order_details_tbl od ON od.status_id = st.status_id WHERE od.order_details_id = '$id'";
												$exe_sts = mysqli_query($db,$sql_sts);
												$sts = mysqli_fetch_assoc($exe_sts);
			  							?>
			  								<td colspan="7" align="right"><button type="button" name="cancel_ord" class="btn btn-outline-secondary" disabled><?php echo $sts['status_description']; ?></button></td>
			  							<?php
			  								}
			  						 ?>
			  					</tr>
			  				</tbody>
			  						
			  			</table>
			  	</div>
			  				<form method="POST">
			  				
					    <div class="modal-footer">
					        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        </form>
					    </div>
			    </div>
			    </form>
			  </div>
			</div>
			<!--end of modal-->

</body>



<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>