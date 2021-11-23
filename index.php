<?php
  include('include/dbconnection.php');
  include('include/header_user.php');
  
 $sql = "SELECT pv.product_details_id, COUNT(oi.product_variation_id) as Ordered FROM product_variation_tbl pv INNER JOIN order_items_tbl oi ON pv.product_variation_id = oi.product_variation_id GROUP BY pv.product_details_id ORDER BY Ordered DESC LIMIT 4";
  $result = mysqli_query($db, $sql);
  $resultCheck = mysqli_num_rows($result);


?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<body class="bcolor" >
<hr class="hr1" >
<div class="nav-div1">
  
<ul class="nav justify-content-center" >
    <li class="nav-item navli" >
      <a class="nav-link nav2 active" href="index.php" >Home</a>
    </li>
    <li class="nav-item navli" >
      <a class="nav-link nav2 " href="products.php">Products</a>
    </li>
    <li class="nav-item navli">
      <a class="nav-link nav2" href="services.php">Services</a>
    </li>
    
    
  </ul>
</div>

<hr class="hr2" >


  <center>
    

<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators" >
    <li  data-slide-to="0" class="active"  ></li>
    <li  data-slide-to="1"  ></li>
    <li  data-slide-to="2"  ></li>
  
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="home-img-index" src="img/index/water.jpg">
    </div>
    <div class="carousel-item">
      <img class="home-img-index" src="img/index/mushroom.jpg">
    </div>
    <div class="carousel-item">
      <img class="home-img-index" src="img/index/fertilizer.jpg">
    </div>
     
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <i class="fa fa-chevron-circle-left icon-index" aria-hidden="true" ></i>
    <span > </span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <i class="fa fa-chevron-circle-right icon-index" aria-hidden="true" ></i>
    <span ></span>
  </a>
</div>


<div class="container-md">
   <center><?php if($resultCheck > 0) { ?>   
  <h2 class="title-index" >Our Best Sellers Product</h2>
  <hr class="hr3" >
  <div class="row">
  
  
  <div class="row">
  
  <?php while($row = mysqli_fetch_assoc($result)){ ?>

        <?php 
        $proid = $row['product_details_id'];
        $sql1 = "SELECT MIN(price),MAX(price) FROM product_variation_tbl WHERE product_details_id = $proid;";
        $result1 = mysqli_query($db,$sql1);
        $row1 = mysqli_fetch_assoc($result1);

        $sql2 = "SELECT * FROM product_details_tbl WHERE product_details_id = '$proid'";
        $result2 = mysqli_query($db,$sql2);
        $resultCheck2 = mysqli_fetch_assoc($result2);

         ?>

      <div class="col-sm try-index" >
        <div class="product-index zoom">
          <a href="view_product.php?id=<?php echo $proid; ?>" style="text-decoration: none;">

          <!-- product image -->
          <img  class="view-img" src="<?php echo $resultCheck2['product_image']?>" style=""> 

          <!-- product name -->
          <h5 ><?php echo $resultCheck2['product_name']; ?></h5>

          <!-- product price -->
          <h6 >&#8369; <?php echo $row1['MIN(price)']; ?> <?php if($row1['MIN(price)']!=$row1['MAX(price)']){
         echo("- &#8369; "); echo $row1['MAX(price)']; 
        } ?></h6>
          </a>
        </div>

      </div>
      
     <?php } ?> 
      <?php } ?>

    </center>
  </div>
  
  </div>
</div>
<?php 
$sql3 = "SELECT announcement_id, content, image, admin_id, CONCAT(MONTHNAME(date_published),' ',DAY(date_published),', ',YEAR(date_published)) date_pub FROM announcement_tbl ORDER BY date_published DESC";
        $result3 = mysqli_query($db,$sql3);
        $row3 = mysqli_fetch_assoc($result3);

 ?>
<!-- announcements -->
<div class="container-md index-div2" id="announcement_div">
  <h2 class="title-index" >Announcements</h2>
  <hr class="hr3">

</div>
<div class="container-sm index-div3" >

<?php 
    
    if(mysqli_num_rows($result3) == 0){
        echo "<h5>No announcement is posted yet</h5>";
    } 
    else{

    do { ?>

  <div style="background-color: white">
  <div class="row">
    <div class="col"><h6 class="a-text" ><?php echo $row3['date_pub']?></h6></div>
  </div>
  <div class="row a-index-row1" >
    <div class="col-md-5 index-col1" >

      <img class="a-img" src="<?php echo $row3['image']?>" >
    </div>
    <div class="col-md-7 index-col2">
      <p class="a-content" ><?php echo $row3['content']?></p>
    </div>
  </div>
   </div>    
<?php }while($row3 = mysqli_fetch_assoc($result3)); 

}?>
</div>

   </center>


</body>

<?php 
  include('include/footer_user.php');
 ?>
