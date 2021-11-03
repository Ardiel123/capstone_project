<?php
	
	include('include/dbconnection.php');
	include('include/header_user.php');

	
		if (isset($_POST['search_btn'])) {
$search = $_POST['search'];

$sql = "SELECT * FROM product_details_tbl WHERE product_name like '%$search%'";
$result = mysqli_query($db,$sql);
$resultCheck = mysqli_num_rows($result);



 } 
 else{
$sql = "SELECT * FROM product_details_tbl;";
  $result = mysqli_query($db,$sql);
  $resultCheck = mysqli_num_rows($result);

 }


	$sql2 = "SELECT * FROM category_tbl;";
	$result2 = mysqli_query($db,$sql2);
	$resultCheck2 = mysqli_num_rows($result2);
?>
<style type="text/css">
	
.zoom{
  transform: scale(1);
  transition: 0.1s ease-in-out;

}
.zoom:hover{
  transform: scale(1.03);
}
.product{
	border-style: solid;
	border-color: #c0c0c0;
	padding: 4px;
	border-width: 0.5px;
	margin-top: 20px;
  background-color: white;
  border-radius: 5px;
}
.product:hover{
	background-color: #FCFCFC;
	font-weight: 800px
}
.btn-product{
	margin: 5px 0 10px 0;
	border: none;
	background-color: #cc7a00;
	color: white;
}
/*Font style*/
.Poppin{
font-family: 'Poppins';
}
.product h5{
	color: #333333;
	margin-top: 10px;
	word-break: break-word;
	overflow: hidden;
   text-overflow: ellipsis;
    display: -webkit-box;
   -webkit-line-clamp: 1; /* number of lines to show */
   -webkit-box-orient: vertical;
}
.product h6{
	color: #cc7a00;
	font-family: 'Poppins';
}
.home-img{
	width: 100%;height: 700px;
}
.try{
	max-width: 270px;
}
.view-img{
	height: 243px;
	width: 230px;
}
.cat{
	border: 1px solid;border-color: #dbdbdb;height: 38px; width: 150px;text-align: center;
}
@media only screen and (max-width: 800px){
	.home-img{
		width: 100%;height: 500px;
	}
}
@media only screen and (max-width: 600px){
	.home-img{
		width: 100%;height: 400px;
	}
	.try{
	max-width: 180px;
	}
	.view-img{
	height: 153px;
	width: 140px;
	}
	.product h5{
	font-size: 16px;
	max-width: 190px;

	
	}
	.product h6{
	font-size: 14px;
	}
	.cat{
		width: 110px
	}
}

</style>

<hr style="margin: 0px;background-color: #dbdbdb;height: 2px;">
<div style="background-color: white;height: 60px; width: 100%">
  
<ul class="nav justify-content-center" style="padding: 10px 0px">
    <li class="nav-item " style="font-size: 19px;">
      <a class="nav-link nav2 " href="index.php" >Home</a>
    </li>
    <li class="nav-item" style="font-size: 19px;">
      <a class="nav-link nav2 active" href="products.php">Products</a>
    </li>
    <li class="nav-item" style="font-size: 19px;">
      <a class="nav-link nav2" href="services.php">Services</a>
    </li>
    
    
  </ul>
</div>
<hr style="margin: 0px;background-color: #dbdbdb;height: 1.5px;">


<body style="background-color:#f5f5f5">

<!-- show products -->
<div class="container-md" style="margin-top: 40px;min-height: 660px">
		<!-- <h3 class="play" style="margin: 60px 0px 5px 20px;font-weight: 500;color: black;">Products</h3> -->

<div class="row">
	<div class="col-sm">
		<form  method="POST">  
		<div class="input-group col-md-4" style="margin-top: 20px;min-width: 350px; max-width: 400px;float: right;">
             
             
              <select style="" class="selectss cat">
		          	<option value="all">All category</option>
		          	<?php if($resultCheck2 > 0) { ?>
					<?php while($row2 = mysqli_fetch_assoc($result2)){ ?>
		          	<option value="<?php echo $row2['category_id']?>"><?php echo $row2['category_name']?></option>

              	 <?php } ?>	
			<?php } ?>
              
            
            <input class="form-control py-2 border-right-0 border" type="text" name="search" autocomplete="off" value="<?php echo (isset($search))?$search:'';?>" placeholder="Search" id="example-search-input">
            <span class="input-group-append">
              <button class="btn btn-outline-secondary border-left-0 border search" type="submit" name="search_btn">
                    <i class="fa fa-search"></i>
              </button>
            </span>
            
     	</div>
     	 </form>
	</div>
</div>

		<center>
  <div class="row">
  
  	<?php if($resultCheck > 0) { ?>
	<?php while($row = mysqli_fetch_assoc($result)){ ?>

				<?php 
				$proid = $row['product_details_id'];
				$sql1 = "SELECT MIN(price),MAX(price) FROM product_variation_tbl WHERE product_details_id = $proid;";
				$result1 = mysqli_query($db,$sql1);
				$row1 = mysqli_fetch_assoc($result1);
				 ?>

    	<div class="col-sm try box <?php echo $row['category_id']; ?>" >
    		<div class="product zoom">
    			<a href="view_product.php?id=<?php echo $proid; ?>" style="text-decoration: none;">

    			<!-- product image -->
    			<img class="view-img" src="<?php echo $row['product_image']?>" > 

    			<!-- product name -->
    			<h5 ><?php echo $row['product_name']; ?></h5>

    			<!-- product price -->
    			<h6 >&#8369; <?php echo $row1['MIN(price)']; ?> <?php if($row1['MIN(price)']!=$row1['MAX(price)']){
				 echo("- &#8369; "); echo $row1['MAX(price)']; 
				} ?></h6>
    			</a>
    		</div>

    	</div>
    	
		 <?php 
				}
		 	} 
		 	else{
		 	?>
		 		<div class="col" style="margin-top: 50px">
		 		<h3 style="color: black" class="Poppin"><?php echo "No Results Found";  ?></h3>
		 		
		 		</div>
				
		<?php 	
			}
		 ?>	
		



		

		</center>
	</div>
	</div>

</body>

<?php 
	include('include/footer_user.php');
 ?>

 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $(".selectss").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            
            if(optionValue != "all"){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            }else if(optionValue == "all"){
            		$(".box").show();
            }
            else{
                $(".box").hide();
            }
        });
    }).change();
});
</script>