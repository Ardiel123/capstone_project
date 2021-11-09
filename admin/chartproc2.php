<?php
include('../include/dbconnection.php');


if(isset($_POST['subbtn2'])){

			$option2 = $_POST['choice'];
			$x_str = "";
			$y_str = "";
			$colorstr = "";
			$border = "";

			if($option2 == "Yearly"){

				$sql_year ="SELECT year(status_date) as year, round(SUM(print_service_total),2) as yearly_total FROM printing_service_tbl Where status_id = 4 GROUP BY year(status_date) ORDER BY year(status_date)";
				$exe_year = mysqli_query($db, $sql_year);
				$year = mysqli_fetch_assoc($exe_year);

				do{
					
					$x_str .= '"'.$year['year'].'",';
					$y_str .= ''.$year['yearly_total'].',';
					$colorstr .= '"#800000",';
					$border .= '"#060606",';

				}while ($year = mysqli_fetch_assoc($exe_year));

			}else if($option2 == "Monthly"){

				$year = $_POST['year'];
				$monthname = array("Jan","Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
				$zero = 0;

				for($x = 1; $x <= 12; $x++){

					$sql_month ="SELECT round(sum(print_service_total),2) AS monthly_total, month(status_date), MONTHNAME(status_date) as mname FROM printing_service_tbl WHERE YEAR(status_date) = '$year' AND MONTH(status_date) = '$x' AND status_id = 4";
					$exe_month = mysqli_query($db, $sql_month);
					$month = mysqli_fetch_assoc($exe_month);
					
					if(!empty($month)) {
						$y_str .= ''.$month['monthly_total'].',';
					}
					else if(empty($month)){
						$y_str .= ''.$zero.',';
					}

					$x_str .= '"'.$monthname[$x-1].'",';
					$colorstr .= '"#800000",';
					$border .= '"#060606",';

				}
	
			}else if($option2 == "Weekly"){

				$years = $_POST['year'];
				$month = $_POST['month'];
				$weeks = array("Week0", "Week1","Week2", "Week3", "Week4");
				$zero = 0;

				for($x = 0; $x <= 4; $x++){

					$sql_week ="SELECT round(sum(print_service_total),2) as week_total from printing_service_tbl WHERE week(status_date) = '$x' AND month(status_date) = '$month' AND year(status_date) = '$years' AND status_id = 4 group by week(status_date)";
					$exe_week = mysqli_query($db, $sql_week);
					$week = mysqli_fetch_assoc($exe_week);
					
					if(!empty($week)) {
						$y_str .= ''.$week['week_total'].',';
					}
					else if(empty($week)){
						$y_str .= ''.$zero.',';
					}

					$x_str .= '"'.$weeks[$x].'",';
					$colorstr .= '"#800000",';
					$border .= '"#060606",';

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
					            label: 'Tradebay Printing Sales',
					            data: [<?php echo $y_str.'0'; ?>],
					            backgroundColor: [<?php echo $colorstr; ?>],
					            borderColor: [<?php echo $border; ?>],
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


					document.getElementById("myChart2").style.display = "none";
			</script>