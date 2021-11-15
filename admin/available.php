<?php
	
	include('../include/dbconnection.php');

	if(isset($_POST['stat_but'])){

		$availability = $_POST['id'];
		$product_id = $_POST['product_id'];

		if($availability == 0){

			$sql_1 = "UPDATE `product_details_tbl` SET `available`='1' WHERE product_details_id = '$product_id'";
			mysqli_query($db, $sql_1);

			$return = '<button class="btn-sm btn-primary stat float-right" id="stats" value="1">Availabe</button>';

		}else if($availability == 1){

			$sql_2 = "UPDATE `product_details_tbl` SET `available`='0' WHERE product_details_id = '$product_id'";
			mysqli_query($db, $sql_2);

			$return = '<button class="btn-sm stat float-right" id="stats" value="0">Not Available</button>';

		}

		echo $return;
	}
?>
<script>
	$('.stat').click(function(e) {
	    e.preventDefault();
	    $.ajax({
	        type: "POST",
	        url: "available.php",
	        data: { 
	        	stat_but: true,
	        	product_id: document.getElementById("prod_id").value,
	            id: $(this).val() 
	        },
	        success: function(response) {
	            $('.data_view').html(response);
	        }
	    });
	});


  	// $(document).ready(function(e){
   //      var id = document.getElementById("stats").value;

   //      if(id == 0){
   //      	$(".variation").css({ "pointer-events": 'none', "opacity": '0.7'});
   //      	$(".prods").css({ "pointer-events": 'none', "opacity": '0.7'});
   //      }else if(id == 1){
   //      	$(".variation").css({ "pointer-events": 'auto', "opacity": '1'});
   //      	$(".prods").css({ "pointer-events": 'auto', "opacity": '1'});
   //      }
   //  });

</script>