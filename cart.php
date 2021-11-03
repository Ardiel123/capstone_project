<?php
	 
	include('include/dbconnection.php');
  include('include/validate_user.php');
  include('include/header_user.php');
	

$query_payment = "SELECT * FROM payment_type_tbl";
  $res4 = mysqli_query($db,$query_payment);
  $payment = mysqli_fetch_assoc($res4);

  $get_cus_info = "SELECT * FROM customer_tbl WHERE customer_id = '$_SESSION[user_id]'";
  $info = mysqli_query($db,$get_cus_info);
  $show_info = mysqli_fetch_assoc($info);

  if (isset($_GET['remove_id'])) {
    
    $var_id = $_GET['remove_id'];
    unset($_SESSION['cart'][$var_id]);
    echo  '<script> window.location.href="cart.php";</script>';
  }

  if (isset($_GET['minus_id'])) {

    $var_id = $_GET['minus_id'];

    if($_SESSION['cart'][$var_id] > 1){
      
      $_SESSION['cart'][$var_id] -= 1;
      
    }
    else
    {
      echo  '<script> window.location.href="cart.php";</script>';
    }
  }

  if (isset($_GET['plus_id'])) {
    $var_id = $_GET['plus_id'];
    $_SESSION['cart'][$var_id] += 1;
     echo  '<script> window.location.href="cart.php";</script>';
  }

  if (isset($_POST['confirm_order'])) {

    $total = $_POST['totprice'];
    $status = 1;
    $cus_id = $_SESSION['user_id'];
    $recipient_name = $_POST['recipient_name'];
    $recipient_number = $_POST['recipient_number'];
    $payment_option = $_POST['payment_option'];

    if ($payment_option == 1) {
      
      $startTime = date("Y-m-d h:i:sa");
      $date_to_receive = date('Y-m-d h:i:sa',strtotime('+5 day',strtotime($startTime)));
      $address = $_POST['houseno'].'/'.$_POST['brgy'].'/'.$_POST['city'].'/'.$_POST['province'];

      $sql_add_ship = "INSERT INTO `shipping_details_tbl`(`recipient_name`, `recipient_number`, `ship_or_pickup_address`, `date_to_receive`) VALUES ('$recipient_name','$recipient_number','$address','$date_to_receive')";
      mysqli_query($db,$sql_add_ship);

      $ship_id = "SELECT MAX(shipping_details_id) AS ship_id FROM shipping_details_tbl";
      $execute_ship_id = mysqli_query($db,$ship_id);
      $show_ship_id = mysqli_fetch_assoc($execute_ship_id);

      $the_ship_id = $show_ship_id['ship_id'];

      $sql_add_det = "INSERT INTO `order_details_tbl`(`total`, `status_id`, `customer_id`, `payment_type_id`, `shipping_details_id`) VALUES ('$total','$status','$cus_id','$payment_option','$the_ship_id')";
      $add_to_order = mysqli_query($db,$sql_add_det);

      $last_id_query = "SELECT MAX(order_details_id) AS last_id FROM order_details_tbl";
      $execute_last_id = mysqli_query($db,$last_id_query);
      $show_last_id = mysqli_fetch_assoc($execute_last_id);

      $the_last_id = $show_last_id['last_id'];

      foreach ($_SESSION['cart'] as $key => $value) 
        { 
          $sql_get_price = "SELECT price FROM product_variation_tbl WHERE product_variation_id = '$key'";
          $exe_get_price = mysqli_query($db, $sql_get_price);
          $get_price = mysqli_fetch_assoc($exe_get_price);

          $current_price = $get_price['price'];

          $sql_add_item = "INSERT INTO `order_items_tbl`(`quantity`, `current_price`, `product_variation_id`, `order_details_id`) VALUES ('$value','$current_price','$key','$the_last_id')";
        $add_to_order = mysqli_query($db,$sql_add_item);

        }

        unset($_SESSION['cart']);

    }
    else if($payment_option == 2){
      $to_receive = $_POST['to_receive'];
      $address = $_POST['campus'];

      $sql_add_ship = "INSERT INTO `shipping_details_tbl`(`recipient_name`, `recipient_number`, `ship_or_pickup_address`, `date_to_receive`) VALUES ('$recipient_name','$recipient_number','$address','$to_receive')";
      mysqli_query($db,$sql_add_ship);

      $ship_id = "SELECT MAX(shipping_details_id) AS ship_id FROM shipping_details_tbl";
      $execute_ship_id = mysqli_query($db,$ship_id);
      $show_ship_id = mysqli_fetch_assoc($execute_ship_id);

      $the_ship_id = $show_ship_id['ship_id'];

      $sql_add_det = "INSERT INTO `order_details_tbl`(`total`, `status_id`, `customer_id`, `payment_type_id`, `shipping_details_id`) VALUES ('$total','$status','$cus_id','$payment_option','$the_ship_id')";
      $add_to_order = mysqli_query($db,$sql_add_det);

      $last_id_query = "SELECT MAX(order_details_id) AS last_id FROM order_details_tbl";
      $execute_last_id = mysqli_query($db,$last_id_query);
      $show_last_id = mysqli_fetch_assoc($execute_last_id);

      $the_last_id = $show_last_id['last_id'];

      foreach ($_SESSION['cart'] as $key => $value) 
        { 
          $sql_get_price = "SELECT price FROM product_variation_tbl WHERE product_variation_id = '$key'";
          $exe_get_price = mysqli_query($db, $sql_get_price);
          $get_price = mysqli_fetch_assoc($exe_get_price);

          $current_price = $get_price['price'];

          $sql_add_item = "INSERT INTO `order_items_tbl`(`quantity`, `current_price`, `product_variation_id`, `order_details_id`) VALUES ('$value','$current_price','$key','$the_last_id')";
        $add_to_order = mysqli_query($db,$sql_add_item);

        }

        unset($_SESSION['cart']);
    }
    

    /*$sql_add_det = "INSERT INTO `order_details_tbl`(`total`, `status_id`, `customer_id`, `payment_type_id`) VALUES ('$total','$status','$cus_id','$payment_option')";
    $add_to_order = mysqli_query($db,$sql_add_det);

    $last_id_query = "SELECT MAX(order_details_id) AS last_id FROM order_details_tbl";
    $execute_last_id = mysqli_query($db,$last_id_query);
    $show_last_id = mysqli_fetch_assoc($execute_last_id);

    $the_last_id = $show_last_id['last_id'];

    foreach ($_SESSION['cart'] as $key => $value) 
      { 
        $sql_get_price = "SELECT price FROM product_variation_tbl WHERE product_variation_id = '$key'";
        $exe_get_price = mysqli_query($db, $exe_get_price);
        $get_price = mysqli_fetch_assoc($exe_get_price);

        $current_price = $get_price['price'];

        $sql_add_item = "INSERT INTO `order_items_tbl`(`quantity`, `current_price`, `product_variation_id`, `order_details_id`) VALUES ('$value','$current_price','$key','$the_last_id')";
      $add_to_order = mysqli_query($db,$sql_add_item);

      }

      unset($_SESSION['cart']);*/

  }
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>


.zoom{
  transform: scale(1);
  transition: 0.3s ease-in-out;

}
.zoom:hover{
  transform: scale(1.03);
}
.product{
	border-style: solid;
	border-color: #eeeeee;
	padding: 4px;
	border-width: 0.5px;
	margin-top: 20px;
  background-color: white;
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
.play{
  font-family: 'Playfair Display';
  font-weight: 700px;
  font-style: italic;
}
.product h5{
	color: #333333;
	margin-top: 10px;
}
.product h6{
	color: #808080;
	font-family: 'Poppins';
}
.home-img{
	width: 100%;height: 700px;
}
.cart_quantity{
    padding: 30px 0px 0px 0px;
  }
.title_text{
    margin: 60px 0px 5px 20px;font-weight: 600;color: black;font-size: 40px;margin-bottom: 40px;font-family: 'Poppins';
  }
@media only screen and (max-width: 800px){
	.home-img{
		width: 100%;height: 500px;
	}
}
@media only screen and (max-width: 600px){
  .cart_quantity{
    padding: 60px 0px 0px 0px;
  }
  .row1{
   text-align: left;

  }
   .prod-14{
    font-size:13px;
  }
}
@media only screen and (max-width: 580px){
  .row1{
   text-align: left;

  }
   .prod-14{
    font-size:13px;
  }
}
@media only screen and (max-width: 578px){
  
  .row1{
   text-align: center;
   max-width: 200px
  }
  .prod-16{
    font-size:16px;
  }
   .prod-14{
    font-size:13px;
  }
  .prod-img{
    margin-bottom: 10px;
  }
  .jusko{
    overflow: none;
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
      <a class="nav-link nav2 " href="products.php">Products</a>
    </li>
    <li class="nav-item" style="font-size: 19px;">
      <a class="nav-link nav2" href="services.php">Services</a>
    </li>
    
    
  </ul>
</div>
<hr style="margin: 0px;background-color: #dbdbdb;height: 1.5px;">


<body style="background-color:#f5f5f5">
<div class="container-md">
  <h3 class="title_text">Cart</h3>
 
<center>
  <div class="container-md" style="background-color: white;padding: 10px 30px;border: 1.5px solid;border-color: #dbdbdb;margin-top: 30px;background-color: white;min-height: 580px;">
   
    <div class="my_content">
       <div class="panel-heading" style="height: 30px">
          </div>

      <div class="row" style="display: block;">

        <div class="col-lg jusko" style="overflow: auto;">
          <table class="crt_tbl table table-striped">

            <thead>
            <tr>
              <div class="row">

                <th class="row1">Product</th>
                
                <th style="text-align: center;">Quantity</th>
                <th style="text-align: center;">Subtotal</th>
                  <th style="text-align: center;"></th>
              </div>
            </tr>
            </thead>

            <tbody>
              <?php
                    if (empty($_SESSION['cart'])) {
                  ?>
                      <tr background="empty_cart.png" style="height: 400px; background-repeat: no-repeat; background-size: 250 400px;background-position: center center;">
                        <td colspan="3" style="text-align: center;" ><td>
                      </tr>
                  <?php
                    }
                    else{

                      foreach ($_SESSION['cart'] as $key => $value) 
                      { 
                        $sql = "SELECT pd.product_image,pd.product_name,pv.weight_value,pv.price,pv.product_variation_id,w.abbreviation FROM product_details_tbl pd INNER JOIN product_variation_tbl pv ON pv.product_details_id = pd.product_details_id INNER JOIN weight_unit_tbl w ON pv.weight_unit_id = w.weight_unit_id WHERE product_variation_id = '$key'";
                      $ex = mysqli_query($db, $sql);
                      $row = mysqli_fetch_assoc($ex);

                      $subtotal = $value * $row['price'];
                  ?>
              <tr> 
              <form method="POST"> 
              <div class="row row1">

                <!-- product -->
                <td>
                  <div class="row row1">
                      <!-- image -->
                    <div class="col-sm-4" style="min-width: 100px">
                      <?php echo '<img class="prod-img" src="'.$row['product_image'].'" style="height: 80px;width: 80px;" >'; ?>
                  
                    </div>

                    <div class="col-sm" style="min-width: 110px">
                      <!-- product name -->
                      <div class="row">
                        <div class="col-sm ">
                          <h5 class="prod-16"><?php echo $row['product_name']; ?></h5>
                        </div>
                      </div>
                      <!-- Variation -->
                      <div class="row">
                        <div class="col-sm">
                          <h6 class="prod-14">Size: <span><?php echo $row['weight_value']." ".$row['abbreviation']; ?></span></h6>
                        </div>
                      </div>
                      <!-- Price -->
                       <div class="row">
                        <div class="col-sm" >

                          <h6  class="prod-14">Price: <span style="color: #cc7a00">&#8369; <?php echo number_format($row['price'],2,".",","); ?></span></h6>
                        </div>
                      </div>

                    </div>
                  </div>
                </td>
               <!-- quantity -->
                <td class="cart_quantity" style="vertical-align: middle;min-width: 100px;">
                  <center>
                  <div > 
                 <a href="cart.php?minus_id=<?php echo $row['product_variation_id']; ?>" style="font-size: 20px;color: black;text-decoration: none;">-</a>
                 <input type="text" id="quantity" name="quantity" min="1" value="<?php echo $value; ?>" size="1" onchange="calculate()" onkeydown="return (event.keyCode!=13);" style="text-align: center;margin-left: 0px;height: 40px;border: .5px solid;border-color: #dbdbdb" readonly>
                  <a href="cart.php?plus_id=<?php echo $row['product_variation_id']; ?>" style="font-size: 20px;color: black;text-decoration: none;">+</a>
                  </div>
                 </center>
                </td>
                <!-- total -->
                <td style="vertical-align: middle;">
                  <center>
                  <h6 >&#8369; <?php echo number_format($subtotal,2,".",","); ?></h6>
                  </center>
                </td>

                <td style="vertical-align: middle;">  
                  <a style="padding: 4px 8px;border-radius: 50%;background-color: white;border: .5px solid;border-color: #dbdbdb;color: black;text-decoration: none;" href="cart.php?remove_id=<?php echo $row['product_variation_id']; ?>">X</button></a>
                  <!-- <button style="padding: 4px 8px;border-radius: 50%;background-color: white;border: .5px solid;border-color: #dbdbdb">X</button> -->
                </td>
              </div>
              </form>
              </tr>
              <?php
                      }
                    ?>
               
                  <tr>
                    <td colspan="2" align="left" style="vertical-align: middle;">
                        <h6 style="font-size: 17px">Total: <span>&#8369; 650</span></h6>
                    </td>
                     <td colspan="2" align="right"><button type="button" name="checkout_all" class="btn " data-toggle="modal" data-target="#order_all" style="width:150px;background-color: #cc7a00;color: white">Checkout</button></td>
                  </tr>
               <?php  
                    }
                  ?>
            </tbody>

          </table>
        </div>

      </div>


      
    </div>
    	
  
    	
   
	</div>
	  
</div>

</center>
</body>
<?php 
  include('include/footer_user.php');
 ?>

<!-- Modal add order-->
        <div id="order_all" class="modal fade" role="dialog">
        <div class="modal-dialog" >

          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Order Details</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
                
            </div>
              <!--form-->
              <form action="" method="POST">
                <div class="modal-body">
                <div class="container" style="width: 100%; height: 100%; overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Item</th>
                    <th></th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if (empty($_SESSION['cart'])) {
                  ?>
                      <tr>
                        <td colspan="6" class="text-center">No Entry<td>
                      </tr>
                  <?php
                    }
                    else{

                      $grandtotal = 0;

                      foreach ($_SESSION['cart'] as $key => $qty) 
                      { 
                        $sql_modal = "SELECT pd.product_image,pd.product_name,pv.price,pv.product_variation_id FROM product_details_tbl pd INNER JOIN product_variation_tbl pv ON pv.product_details_id = pd.product_details_id WHERE product_variation_id = '$key'";
                      $exec = mysqli_query($db, $sql_modal);
                      $modal_row = mysqli_fetch_assoc($exec);

                      $modal_subtotal = $qty * $modal_row['price'];
                      $grandtotal += $modal_subtotal;
                  ?>
                  <tr>
                      <td><?php echo '<img src="'.$modal_row['product_image'].'" style="width: 50px; height: 50px;" >'; ?></td>
                      <td class="pname" colspan="2"><?php echo $modal_row['product_name']; ?></td>
                      <td><?php echo $modal_row['price']; ?></td>
                      <td><?php echo "x".$qty; ?></td>
                      <td colspan="2"><?php echo "₱".number_format($modal_subtotal,2,".",","); ?></td>
                  </tr> 
                    <?php
                      }
                    ?>
                  <tr>
                    <td colspan="5" align="right"><?php echo "<b>Total:</b>"; ?></td>
                    <td colspan="2"><?php echo "<b>₱".number_format($grandtotal,2,".",",")."</b>"; ?></td>
                  </tr>
                  <?php 
                    }
                  ?>
                </tbody>
                    
              </table>
          </div>
                <form method="POST">
                <hr>
                <hr><h5>Contact information</h5>
                <div class="form-group">
                  <label for="recipient_name">Recipient Name:</label>
                  <input type="text" name="recipient_name" class="form-control" value="<?php echo $show_info['customer_fname'].' '.$show_info['customer_lname'] ?>">
                </div>
                <div class="form-group">
                  <label for="recipient_number">Contact number:</label>
                  <input type="text" name="recipient_number" class="form-control" value="<?php echo $show_info['customer_phonenumber'] ?>">
                </div>

                <div class="form-group">
                  <input type="hidden" name="totprice" value="<?php echo $grandtotal; ?>">
                    <label for="payment_option">Payment option:</label><br>
                    <select name="payment_option" id="payment_option" class="form-control" onchange="showDiv(this)">
                      <?php do{ ?>
                        <option value="<?php echo $payment['payment_type_id']; ?>"><?php echo $payment['payment_description']; ?></option>
                      <?php }while($payment=mysqli_fetch_assoc($res4))?>
                    </select>
                </div>

                <div id="hidden_div" style="display:block;">
                <hr><h5>Shipping Information</h5>
                  <label for="houseno" style="margin-right: 27%">House #:</label>
                  <label for="brgy">Barangay:</label>
                  <div class="form-group">
                    <input type="text" name="houseno" class="form-control" style="width: 40%; float: left; margin-right: 5px" value="<?php echo $show_info['house_no']; ?>">
                    <input type="text" name="brgy" class="form-control" style="width: 50%; float: left; margin-right: 5px" value="<?php echo $show_info['barangay']; ?>">
                  </div>

                  <label for="city" style="margin-right: 15%">City/Municipality:</label>
                  <label for="brgy">Province:</label>
                  <div class="form-group">
                    <input type="text" name="city" class="form-control" style="width: 40%; float: left; margin-right: 5px" value="<?php echo $show_info['city']; ?>">
                    <input type="text" name="province" class="form-control" style="width: 50%; float: left; margin-right: 5px" value="<?php echo $show_info['province']; ?>">

                    <br><br>
                    <p><i>Important: The customer will pay for the shipping cost charged by the courier.<br><span style="color: red">By clicking checkout you've agreed to this policy.</span><i></p>
                  </div>
                </div>

                <div id="for_pick" style="display:none;">
                <hr><h5>Pick-up Information </h5>
                <label for="houseno" style="margin-right: 27%">Select campus:</label>
                  <select class="form-control" name="campus">
                    <option value="Sumacab campus">Sumacab Campus</option>
                    <option value="Gabaldon campus">Gabaldon Campus</option>
                    <option value="General Tinio campus">General Tinio Campus</option>
                  </select>

                  <div class="form-group">
                    <label for="to_receive">Date and Time of pick up:</label>
                    <input type="datetime-local" id="to_receive" name="to_receive" class="form-control">
                  </div>
                </div>
                
              </div>
              <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="confirm_order">Confirm Order</button>
                  </form>
              </div>
          </div>
          </form>
        </div>
      </div>
      <!--end of modal-->

<script>
  function showDiv(select){

     if(select.value==1){
      document.getElementById('hidden_div').style.display = "block";
      document.getElementById('for_pick').style.display = "none";
      to_receive.removeAttribute("required");
     } else if(select.value==2){
      document.getElementById('for_pick').style.display = "block";
      document.getElementById('hidden_div').style.display = "none";
      to_receive.setAttribute("required", "");
     }
  } 

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>