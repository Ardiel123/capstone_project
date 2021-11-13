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



		$sq3 = "SELECT round(SUM(total),2) AS product FROM order_details_tbl WHERE status_id = 4";
		$ex3 = mysqli_query($db, $sq3);
		$ye3 = mysqli_fetch_assoc($ex3);

		$sq4 = "SELECT round(SUM(print_service_total),2) AS print FROM printing_service_tbl WHERE status_id = 4";
		$ex4 = mysqli_query($db, $sq4);
		$ye4 = mysqli_fetch_assoc($ex4);



		$sq ="SELECT year(status_date) as year, SUM(total) as yearly_total FROM order_details_tbl Where status_id = 4 GROUP BY year(status_date) ORDER BY year(status_date)";
		$ex = mysqli_query($db, $sq);
		$ye = mysqli_fetch_assoc($ex);

		$xx_str = "";
		$yx_str = "";
		$colorstr = "";
		$border = "";

		do{
			
			$xx_str .= '"'.$ye['year'].'",';
			$yx_str .= ''.round($ye['yearly_total'],2).',';
			$colorstr .= '"#DC8927",';
			$border .= '"#060606",';

		}while ($ye = mysqli_fetch_assoc($ex));


		$sq2 ="SELECT year(status_date) as years, SUM(print_service_total) as yearly_totals FROM printing_service_tbl Where status_id = 4 GROUP BY year(status_date) ORDER BY year(status_date)";
		$ex2 = mysqli_query($db, $sq2);
		$ye2 = mysqli_fetch_assoc($ex2);

		$xx_strp = "";
		$yx_strp = "";
		$colorstrp = "";
		$borderp = "";

		do{
			
			$xx_strp .= '"'.$ye2['years'].'",';
			$yx_strp .= ''.round($ye2['yearly_totals'],2).',';
			$colorstrp .= '"#800000",';
			$borderp .= '"#060606",';

		}while ($ye2 = mysqli_fetch_assoc($ex2));

	
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
	.container-fluid{
		padding: 0;
	}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<div class="content">
		<div class="for_title">
			<h2>Dashboard</h2>
		</div>
		<div class="my_content">

			<div class="container-fluid">

				<div class="col-sm-5" style="min-width: 300px; border: solid 0.5px; border-color: lightgrey; padding: 20px; margin: 12px; ">
					<canvas id="myChart3"></canvas>
				</div>
			
				<div class="col-sm-6" style="min-width: 300px; margin-bottom: 20px; border: solid 0.5px; border-color: lightgrey; margin: 12px">

					<div class="data_view col-sm-10">
						<canvas id="myChart"></canvas>
					</div>

					<div class="col-sm-2" style="margin-top: 25px">
						<form id="show_chart" method="POST">

						<div class="form-group form-group-sm">
							<label>Show</label>
							<select class="form-control" id="choice" name="myChoice" onchange="showDiv()" >
								<option value="Yearly" <?php echo (isset($option)&&($option==1)?"selected":"")?>>Yearly</option>
								<option value="Monthly" <?php echo (isset($option)&&($option==2)?"selected":"")?>>Monthly</option>
								<option value="Weekly" <?php echo (isset($option)&&($option==3)?"selected":"")?>>Weekly</option>
							</select>
						</div>

						<div class="form-group form-group-sm" id="year" >	
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

						<div class="form-group form-group-sm" id="month">
							<label>Month</label>
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

						<div class="form-group form-group-sm">
							<input type="submit" name="sub_show" value="Show" class="form-control btn btn-primary">
						</div>
						</form>
					</div>
				</div>

				<div class="col-sm-6" style="min-width: 300px; margin-bottom: 20px; border: solid 0.5px; border-color: lightgrey; margin: 12px;">

					<div class="data_view2 col-sm-10">
						<canvas id="myChart2"></canvas>
					</div>

					<div class="col-sm-2" style="margin-top: 25px">
						<form id="show_chart2" method="POST">

						<div class="form-group form-group-sm">
							<label>Show</label>
							<select id="choice2" name="myChoice2" onchange="showDiv2()" class="form-control">
								<option value="Yearly" <?php echo (isset($option2)&&($option2==1)?"selected":"")?>>Yearly</option>
								<option value="Monthly" <?php echo (isset($option2)&&($option2==2)?"selected":"")?>>Monthly</option>
								<option value="Weekly" <?php echo (isset($option2)&&($option2==3)?"selected":"")?>>Weekly</option>
							</select>
						</div>

						<div id="year" class="form-group form-group-sm">	
							<label>Year</label>
							<select id="m_year2" name="m_year2" class="form-control m_year2" disabled="true">
								<?php 

									$show_y2 = "SELECT year(status_date) as y2 FROM printing_service_tbl Where status_id = 4 GROUP BY year(status_date)";
									$exx2 = mysqli_query($db,$show_y2);
									$shww2 = mysqli_fetch_assoc($exx2);
								do{?>
									<option value="<?php echo $shww2['y2']; ?>"  <?php echo (isset($year2)&&($year2==$shww2['y2'])?"selected":"")?>><?php echo $shww2['y2']; ?></option>
								<?php }while($shww2 = mysqli_fetch_assoc($exx2)); ?>
							</select>
						</div>

						<div class="form-group form-group-sm" id="month2">
							<label>Month</label>
							<select id="m_month2" name="m_month2" class="form-control m_month2" disabled="true">
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

						<div class="form-group form-group-sm">
							<input type="submit" name="sub_show2" value="Show" class="form-control btn btn-primary">
						</div>
						</form>
					</div>

				</div>

			</div>
			<div class="container-fluid">

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
	    $("#show_chart").submit(function(e) {
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
				label: 'Product Sales',
				data: [<?php echo $yx_str.'0'; ?>],
				backgroundColor: [<?php echo $colorstr; ?>],
				borderColor: [<?php echo $border; ?>],
				borderWidth: 1
				}]
			},
		options: {
			title: {
				      display: true,
				      text: "PRODUCT CHART SALES",
				      fontSize: 15
				    }
		}
	});


	/*for tradebay printing chart*/

	function showDiv2(){

		var sel = document.getElementById("choice2").value;
		if(sel== "Yearly"){

	    	m_year2.disabled = true;
	    	m_month2.disabled = true;

		}else if(sel=="Monthly"){
	    	m_year2.disabled = false;
	    	m_month2.disabled = true;

	   	}else if(sel=="Weekly"){
	    	m_year2.disabled = false;
	    	m_month2.disabled = false;
	   	}
	} 

	$(document).ready(function() {
	    $("#show_chart2").submit(function(e) {
	    	e.preventDefault();

	    	var choice2 = document.getElementById("choice2").value;
	    	var year2 = document.getElementById("m_year2").value;
	    	var month2 = document.getElementById("m_month2").value;

	        $.ajax({
				type: "POST",
				url: "chartproc2.php",
				data: {
					'subbtn2': true,
					'choice': choice2,
					'year': year2,
					'month': month2
				},
				success: function(response){
					$('.data_view2').html(response);
				}

			});	
	    });
	});

	var ctx = document.getElementById('myChart2');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: [<?php echo $xx_strp; ?>],
			datasets: [{
				label: 'Printing Sales',
				data: [<?php echo $yx_strp.'0'; ?>],
				backgroundColor: [<?php echo $colorstrp; ?>],
				borderColor: [<?php echo $borderp; ?>],
				borderWidth: 1
				}]
			},
		options: {
			title: {
				      display: true,
				      text: "PRINTING SERVICE CHART SALES",
				      fontSize: 15
				    }
		}
	});
	

	var xValues = ["Printing Service", "Product Sales"];
	var yValues = [<?php echo $ye3['product']; ?>,<?php echo $ye4['print']; ?>];
	var barColors = [
	  "#DC8927",
	  "#800000"
	];


	new Chart("myChart3", {
	  type: "doughnut",
	  data: {
	    labels: xValues,
	    datasets: [{
	      backgroundColor: barColors,
	      data: yValues
	    }]
	  },
	  options: {
	    title: {
	      display: true,
	      text: "PRINTING & PRODUCT SALES",
	      fontSize: 15
	    }
	  }
	});
</script>