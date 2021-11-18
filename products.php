<?php
	
	include('include/dbconnection.php');
	include('include/header_user.php');

	
		if (isset($_POST['search_btn'])) {
$search = $_POST['search'];

$sql = "SELECT * FROM product_details_tbl WHERE available = 1 and product_name like '%$search%'";
$result = mysqli_query($db,$sql);
$resultCheck = mysqli_num_rows($result);



 } 
 else{
$sql = "SELECT * FROM product_details_tbl WHERE available = 1;";
  $result = mysqli_query($db,$sql);
  $resultCheck = mysqli_num_rows($result);

 }


	$sql2 = "SELECT * FROM category_tbl;";
	$result2 = mysqli_query($db,$sql2);
	$resultCheck2 = mysqli_num_rows($result2);
?>

<hr class="hr1" >
<div class="nav-div1">
  
<ul class="nav justify-content-center">
    <li class="nav-item navli" >
      <a class="nav-link nav2 " href="index.php" >Home</a>
    </li>
    <li class="nav-item navli" >
      <a class="nav-link nav2 active" href="products.php">Products</a>
    </li>
    <li class="nav-item navli" >
      <a class="nav-link nav2" href="services.php">Services</a>
    </li>
    
    
  </ul>
</div>
<hr class="hr2">


<body class="bcolor">

<!-- show products -->
<div class="container-md product-div1" >
		

<div class="row">
	<div class="col-sm">
		<form  method="POST">  
		<div class="input-group col-md-4 product-col1" >
             
             
              <select style="" class="selectss cat-product">
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

    	<div class="col-sm try-product box <?php echo $row['category_id']; ?>" >
    		<div class="product1 zoom-product1">
    			<a href="view_product.php?id=<?php echo $proid; ?>" style="text-decoration: none;">

    			<!-- product image -->
    			<img class="view-img-product" src="<?php echo $row['product_image']?>" > 

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
		 		<div class="col product-col2" >
		 		<h3 style="color: black" class="Poppin-product"><?php echo "No Results Found";  ?></h3>
		 		
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