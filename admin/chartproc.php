<?php
include('../include/dbconnection.php');


if(isset($_POST['subbtn'])){

			$option = $_POST['choice'];
			$x_str = "";
			$y_str = "";
			$colorstr = "";
			$border = "";

			if($option == "Yearly"){

				$sql_year ="SELECT year(status_date) as year, round(SUM(total),2) as yearly_total FROM order_details_tbl Where status_id = 4 GROUP BY year(status_date) ORDER BY year(status_date)";
				$exe_year = mysqli_query($db, $sql_year);
				$year = mysqli_fetch_assoc($exe_year);

				do{
					
					$x_str .= '"'.$year['year'].'",';
					$y_str .= ''.$year['yearly_total'].',';
					$colorstr .= '"#DC8927",';
					$border .= '"#060606",';

				}while ($year = mysqli_fetch_assoc($exe_year));

			}else if($option == "Monthly"){

				$year = $_POST['year'];
				$monthname = array("Jan","Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
				$zero = 0;

				for($x = 1; $x <= 12; $x++){

					$sql_month ="SELECT round(sum(total),2) AS monthly_total, month(status_date), MONTHNAME(status_date) as mname FROM order_details_tbl WHERE YEAR(status_date) = '$year' AND MONTH(status_date) = '$x' AND status_id = 4";
					$exe_month = mysqli_query($db, $sql_month);
					$month = mysqli_fetch_assoc($exe_month);
					
					if(!empty($month)) {
						$y_str .= ''.$month['monthly_total'].',';
					}
					else if(empty($month)){
						$y_str .= ''.$zero.',';
					}

					$x_str .= '"'.$monthname[$x-1].'",';
					$colorstr .= '"#DC8927",';
					$border .= '"#060606",';

				}
	
			}else if($option == "Weekly"){

				$years = $_POST['year'];
				$month = $_POST['month'];
				$zero = 0;

				$sql_week ="SELECT week(status_date) as week_num, round(sum(total),2) as week_total from order_details_tbl WHERE month(status_date) = '$month' AND year(status_date) = '$years' AND status_id = 4 group by week(status_date)";
				$exe_week = mysqli_query($db, $sql_week);
				$week = mysqli_fetch_assoc($exe_week);

				if($week != 0){

					do{	

						if($week['week_total'] != 0) {
							$y_str .= ''.$week['week_total'].',';
						}
						else{
							$y_str .= ''.$zero.',';
						}

						$colorstr .= '"#DC8927",';
						$border .= '"#060606",';
						$x_str .= '"Week'.$week['week_num'].'",';


					}while($week = mysqli_fetch_assoc($exe_week));

				}else{

				}

			}

			echo '<canvas id="Chart"></canvas>';

	}
?>
			<script>
					var ctx = document.getElementById('Chart');
					var myChart = new Chart(ctx, {
					    type: 'bar',
					    data: {
					        labels: [<?php echo $x_str; ?>],
					        datasets: [{
					            label: 'Tradebay Product Sales',
					            data: [<?php echo $y_str.'0'; ?>],
					            backgroundColor: [<?php echo $colorstr; ?>],
					            borderColor: [<?php echo $border; ?>],
					            borderWidth: 1
					        }]
					    },
					    options: {
					        title: {
						      display: true,
						      text: "PRODUCT ORDERED CHART SALES",
						      fontSize: 15
						    }
					    }
					});


					document.getElementById("myChart").style.display = "none";
			</script>