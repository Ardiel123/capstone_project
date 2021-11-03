<?php
  include('include/dbconnection.php');
  include('include/header_user.php');
  
 $sql = "SELECT pv.product_details_id, COUNT(oi.product_variation_id) as Ordered FROM product_variation_tbl pv INNER JOIN order_items_tbl oi ON pv.product_variation_id = oi.product_variation_id GROUP BY pv.product_details_id ORDER BY Ordered DESC LIMIT 4";
  $result = mysqli_query($db, $sql);
  $resultCheck = mysqli_num_rows($result);


?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>


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
.indicator2{
  bottom: -45px;
}
.carousel-indicators li {
  border: 1px solid;
  border-color: #dbdbdb;
 background-color: #cc7a00;
}
.carousel-indicators .active {
   
  background-color: #170c82;
}
.announcements-img{
  width: 400px;
  height: 500px;
  
}

.row-a{
  margin: 10px 0px;
  padding-left: 85px;
  padding-right: 85px;
}
.announcement-text{
  color: black;text-align: justify;text-indent: 25px;margin-top: 10px;min-height: 160px;padding-left: 20px;
}
.space{
  display: none;
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
.title-index{
  margin: 25px 0px;font-weight: 700;font-family: 'Poppins';font-size: 35px;
}
@media only screen and (max-width: 800px){
  .home-img{
    width: 100%;height: 500px;
  }
}
@media only screen and (max-width: 650px){
  .announcements-img{
  max-width: 370px;max-height: 400px;

  }
  .neust{
     max-width: 370px;max-height: 400px;
  }
  .row-a{
    padding-right: 70px
  }
  .space{
  display: inline;
}

@media only screen and (max-width: 600px){
  .home-img{
    width: 100%;height: 400px;
  }
 .indicator2{
  margin-top: 50px
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
  .announcement-text{
    min-width: 300px
  }
  .row-a{
    padding-right: 10px;
  }
  .announcements-img{
  width: 300px;
  height: 350px;
  }
}
@media only screen and (max-width: 500px){
  .title-index{
    font-size: 30px;
  }
}

</style>


<body style="background-color:#f5f5f5">
<hr style="margin: 0px;background-color: #dbdbdb;height: .5px;">
<div style="background-color: white;height: 60px; width: 100%">
  
<ul class="nav justify-content-center" style="padding: 10px 0px">
    <li class="nav-item " style="font-size: 19px;">
      <a class="nav-link nav2 active" href="index.php" >Home</a>
    </li>
    <li class="nav-item" style="font-size: 19px;">
      <a class="nav-link nav2 " href="products.php">Products</a>
    </li>
    <li class="nav-item" style="font-size: 19px;">
      <a class="nav-link nav2" href="#">Services</a>
    </li>
    
    
  </ul>
</div>

<hr style="margin: 0px;background-color: #dbdbdb;height: 1.5px;">


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
      <img class="home-img" src="img/water.jpg" alt="Los Angeles" >
    </div>
    <div class="carousel-item">
      <img class="home-img" src="img/mushroom.jpg" alt="Chicago" >
    </div>
    <div class="carousel-item">
      <img class="home-img" src="img/fertilizer.jpg" alt="New York" >
    </div>
     
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <i class="fa fa-chevron-circle-left" aria-hidden="true" style="color: #cc7a00;font-size: 40px"></i>
    <span > </span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <i class="fa fa-chevron-circle-right" aria-hidden="true" style="color: #cc7a00;font-size: 40px"></i>
    <span ></span>
  </a>
</div>





<div class="container-md">
  <h2 class="title-index" >Featured Products</h2>
  <hr style="background-color: #cc7a00;height: .4px">
  <div class="row">
  
      <center>
  <div class="row">
  
    <?php if($resultCheck > 0) { ?>
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

      <div class="col-sm try" >
        <div class="product zoom">
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
$sql3 = "SELECT * FROM announcement_tbl ORDER BY date_published DESC;";
        $result3 = mysqli_query($db,$sql3);
        $row3 = mysqli_fetch_assoc($result3);

        $sql4 = "SELECT COUNT(announcement_id) AS bilang FROM announcement_tbl;";
        $result4 = mysqli_query($db,$sql4);
        $resultCheck4 = mysqli_fetch_assoc($result4);
 ?>
<!-- announcements -->
<div class="container-md" style="margin-top: 60px;margin-bottom: 60px">
  <h2 class="title-index" >Announcements</h2>
  <hr style="background-color: #cc7a00;height: .4px">
<div id="myCarousel" class="carousel slide" style="max-height: 650px">

  <!-- Indicators -->
  <ul class="carousel-indicators indicator2">
    <li class="item1 active"></li>
    <?php
      $b = $resultCheck4['bilang'];

     for ($i=0; $i < $b ; $i++) { ?>
    <li class="<?php echo "item".$i+2; ?>"></li>
   <?php } ?>
    
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">

    <div class="carousel-item active">
     <div class="row" >
     
         <div class="col">
          <div class="row row-a" >
            <div class="col">
              <h6 style="text-align: right;color: black;height: 20px">  </h6>
            </div>
          </div>
     
          <div class="row" style="margin: 0px 20px;padding-left: 85px;padding-right: 85px">
      <div class="col-sm" style="min-width: 400px;">
         <img class="neust " src="img/neust.png" style="height: 500px;width: 500px">
      </div>
        <div class="col-md announcement-text space">
         <p> </p>
      </div>
    </div>
        </div>
     
    </div>
    </div>
 
  
 
  
  <?php do{ ?>
  



      
   
   <div class="carousel-item ">
    <div class="row" >
     
        <div class="col">
          <div class="row row-a" >
            <div class="col">
              <h6 style="text-align: right;color: black;"><?php echo $row3['date_published']?></h6>
            </div>
          </div>
     
          <div class="row" style="margin: 0px 20px;padding-left: 85px;padding-right: 85px">
      <div class="col-sm" style="min-width: 400px;">
         <img class="announcements-img" src="<?php echo $row3['image']?>" >
      </div>
      <div class="col-md announcement-text">
         <p><?php echo $row3['content']?></p>
      </div>
    </div>
        </div>
     
    </div>
    </div>
 
  <?php }while($row3 = mysqli_fetch_assoc($result3)); ?> 
   
   
     
    
    
      
    <!-- <div class="carousel-item">
      <div class="row" >
     
         <div class="col">
          <div class="row row-a" >
            <div class="col">
              <h6 style="text-align: right;color: black;">10/25/2021</h6>
            </div>
          </div>
     
          <div class="row" style="margin: 0px 20px;padding-left: 85px;padding-right: 85px">
      <div class="col-sm" style="min-width: 400px;">
         <img class="announcements-img" src="img/mushroom.jpg" >
      </div>
      <div class="col-md announcement-text" >
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
         tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          </p>
      </div>
    </div>
        </div>
     
    </div>
     
    </div>
    <div class="carousel-item" >
       <div class="row" >
     
        <div class="col">
          <div class="row row-a">
            <div class="col">
              <h6 style="text-align: right;color: black;">10/25/2021</h6>
            </div>
          </div>
     
          <div class="row" style="margin: 0px 20px;padding-left: 85px;padding-right: 85px">
      <div class="col-sm" style="min-width: 400px;">
         <img class="announcements-img" src="img/fertilizer.jpg" >
      </div>
      <div class="col-md announcement-text">
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
         tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
         quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
         consequat. Duis aute irure </p>
      </div>
    </div>
        </div>
     
    </div>
    </div> -->
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#myCarousel" >
     <i class="fa fa-chevron-circle-left" aria-hidden="true" style="color: #cc7a00;font-size: 40px"></i>
    <span ></span>
  </a>
  <a class="carousel-control-next" href="#myCarousel">
     <i class="fa fa-chevron-circle-right" aria-hidden="true" style="color: #cc7a00;font-size: 40px"></i>
    <span ></span>
  </a>
</div>
</div>


   </center>

   


<br><br><br>
</body>

<?php 
  include('include/footer_user.php');
 ?>


<script>
$(document).ready(function(){
  // Activate Carousel
  $("#myCarousel").carousel();
    
  // Enable Carousel Indicators
  $(".item1").click(function(){
    $("#myCarousel").carousel(0);
  });
  <?php

   for ($a=0; $a < $b; $a++) { 
    # code...
   ?>
  $("<?php echo ".item".$a+2; ?>").click(function(){
    $("#myCarousel").carousel(<?php echo $a+1; ?>);
  });
 <?php } ?>
    
  // Enable Carousel Controls
  $(".carousel-control-prev").click(function(){
    $("#myCarousel").carousel("prev");
  });
  $(".carousel-control-next").click(function(){
    $("#myCarousel").carousel("next");
  });
});
</script>
