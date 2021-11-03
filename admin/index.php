<?php

	include('../include/dbconnection.php');
	include('../include/validate.php');
	include('../include/header.php');
	include('../include/navbar.php');

	$query = "SELECT count(customer_id) AS total_user FROM customer_tbl";
	$result = mysqli_query($db,$query);
	$total_user = mysqli_fetch_assoc($result);
 
	$query2 = "SELECT count(product_details_id) AS total_prod FROM product_details_tbl";
	$result2 = mysqli_query($db,$query2);
	$total_prod = mysqli_fetch_assoc($result2);

	$query3 = "SELECT count(order_details_id) AS total_order_pending FROM order_details_tbl WHERE status_id = 1";
	$result3 = mysqli_query($db,$query3);
	$total_ord1 = mysqli_fetch_assoc($result3);

	$query4 = "SELECT count(printing_service_id) AS total_print_pending FROM printing_service_tbl WHERE status_id = 1";
	$result4 = mysqli_query($db,$query4);
	$total_ord2 = mysqli_fetch_assoc($result4);


		$sq ="SELECT year(status_date) as year, SUM(total) as yearly_total FROM order_details_tbl Where status_id = 4 GROUP BY year(status_date) ORDER BY year(status_date)";
		$ex = mysqli_query($db, $sq);
		$ye = mysqli_fetch_assoc($ex);

		$xx_str = "";
		$yx_str = "";

		do{
			
			$xx_str .= '"'.$ye['year'].'",';
			$yx_str .= ''.round($ye['yearly_total'],2).',';

		}while ($ye = mysqli_fetch_assoc($ex));

	
?>
<style>
	.card-body
{
		display: inline-block;
		font-family: sans-serif;
		margin: 10px;
		padding: 20px;
		width: 300px;
		height: 100px;
		border-radius: 5px;
		border-left: solid 5px;
		border-color: #170c82;
		color: #170c22;
		box-shadow: 0 0 5px rgba(0,0,0,0.2);
}
	.float-left {
		float: left;
	}
	.float-right{
		float: right;
	}
	.card-body h1
	{
		margin-top: 5px;
		margin-bottom: 5px;

	}
	.count
	{
		font-size: 30px;
		font-weight: 500;
	}
	.card-body h4{
		font-size: 15px;
		margin-top: 0; 
	}
	.card-body i{
		font-size: 40px;
	
	}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<div class="content">
		<div class="for_title">
			<h2>Dashboard</h2>
		</div>
		<div class="my_content">
			<div class="container" style="margin-left: 0; width: 100%; ">
			
				<div style="float: left; margin-bottom: 50px; margin-left: 50px;margin-top: 50px;">
					<form id="yearly" method="POST" style="display: block;">

					<div class="form-group">
						<label>Show</label>
						<select id="choice" name="myChoice" onchange="showDiv()" class="form-control">
							<option value="Yearly" <?php echo (isset($option)&&($option==1)?"selected":"")?>>Yearly</option>
							<option value="Monthly" <?php echo (isset($option)&&($option==2)?"selected":"")?>>Monthly</option>
							<option value="Weekly" <?php echo (isset($option)&&($option==3)?"selected":"")?>>Weekly</option>
						</select>
					</div>

					<div id="year" class="form-group" style="margin-top: 20px; display: block; " >	
						<label>Year</label>
						<select id="m_year" name="m_year" class="form-control m_year" disabled="true">
							<?php 

								$show_y = "SELECT year(status_date) as y FROM order_details_tbl Where status_id = 4 GROUP BY year(status_date)";
								$exx = mysqli_query($db,$show_y);
								$shww = mysqli_fetch_assoc($exx);
							do{?>
								<option value="<?php echo $shww['y']; ?>"  <?php echo (isset($year)&&($year==$shww['y'])?"selected":"")?>><?php echo $shww['y']; ?></option>
							<?php }while($shww = mysqli_fetch_assoc($exx)); ?>
						</select>
					</div>

					<div class="form-group" id="month" style="margin-top: 20px; display: block;">
						<label style="margin-left: 10px;">Month</label>
						<select id="m_month" name="m_month" class="form-control m_month" disabled="true">
							<option value="1">Jan</option>
							<option value="2">Feb</option>
							<option value="3">Mar</option>
							<option value="4">Apr</option>
							<option value="5">May</option>
							<option value="6">Jun</option>
							<option value="7">Jul</option>
							<option value="8">Aug</option>
							<option value="9">Sep</option>
							<option value="10">Oct</option>
							<option value="11">Nov</option>
							<option value="12">Dec</option>
						</select>
					</div>

					<div class="form-group">
						<input type="submit" name="sub_show" value="Show" class="form-control btn btn-primary">
					</div>
					</form>
				</div>

				<div class="data_view" style="width:100%; max-width: 900px; display: block; margin: auto;">
					<!---<canvas id="Chart"></canvas>--->
					<canvas id="myChart"></canvas>
				</div>
				<script>
					function showDiv(){

						var sel = document.getElementById("choice").value;
						if(sel== "Yearly"){

					    	m_year.disabled = true;
					    	m_month.disabled = true;

						}else if(sel=="Monthly"){
					    	m_year.disabled = false;
					    	m_month.disabled = true;

					   	}else if(sel=="Weekly"){
					    	m_year.disabled = false;
					    	m_month.disabled = false;
					   	}
					} 

					$(document).ready(function() {
					    $("#yearly").submit(function(e) {
					    	e.preventDefault();

					    	var choice = document.getElementById("choice").value;
					    	var year = document.getElementById("m_year").value;
					    	var month = document.getElementById("m_month").value;

					        $.ajax({
								type: "POST",
								url: "chartproc.php",
								data: {
									'subbtn': true,
									'choice': choice,
									'year': year,
									'month': month
								},
								success: function(response){
									$('.data_view').html(response);
								}

							});	
					    });
					});

					var ctx = document.getElementById('myChart');
					var myChart = new Chart(ctx, {
					    type: 'bar',
					    data: {
					        labels: [<?php echo $xx_str; ?>],
					        datasets: [{
					            label: 'Tradebay Sales',
					            data: [<?php echo $yx_str.'0'; ?>],
					            backgroundColor: ['#DC8927'],
					            borderColor: ['rgba(0, 0, 0, 1)'],
					            borderWidth: 1
					        }]
					    },
					    options: {
					        scales: {
					            y: {

					                beginAtZero: true
					            }
					        }
					    }
					});
					
				</script>
			</div>
			<div class="container" style="margin-left: 0; width: 100%; ">

				<hr>
				<div class="card-body">
					<div class="float-left">
						<h1>
							<span class="count">
								<?php echo $total_user['total_user']; ?>
							</span>
						</h1>
						<h4>Registered Customer</h4>
					</div>
					<div class="float-right">
						<i class="fa fa-users" aria-hidden="true"></i>
					</div>
				</div>

				<div class="card-body">
					<div class="float-left">
						<h1>
							<span class="count"><?php echo $total_prod['total_prod']; ?></span>
						</h1>
						<h4>Total Products</h4>
					</div>
					<div class="float-right">
						<i class="fa fa-shopping-bag" aria-hidden="true"></i>
					</div>
				</div>

				<div class="card-body">
					<div class="float-left">
						<h1>
							<span class="count">
								<?php echo $total_ord1['total_order_pending']; ?>
							</span>
						</h1>
						<h4>Pending Orders</h4>
					</div>
					<div class="float-right">
						<i class="fas fa-cart-arrow-down"></i>
					</div>
				</div>

				<div class="card-body">
					<div class="float-left">
						<h1>
							<span class="count">
								<?php echo $total_ord2['total_print_pending']; ?>
							</span>
						</h1>
						<h4>Pending Printing</h4>
					</div>
					<div class="float-right">
						<i class="fas fa-print"></i>
					</div>
				</div>

			</div>



		</div>
	</div>
<script>
	if ( window.history.replaceState ) {
  		window.history.replaceState( null, null, window.location.href );
	}
	
</script>