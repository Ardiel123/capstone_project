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
      echo  '<script> window.location.href="cart.php";</script>';
    
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
    

  }
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>


.table-bordered td, .table-bordered th {
    border: none;
}






</style>
<hr class="hr1">
<div class="nav-div1">
  
<ul class="nav justify-content-center" >
    <li class="nav-item navli" >
      <a class="nav-link nav2 " href="index.php" >Home</a>
    </li>
    <li class="nav-item navli" >
      <a class="nav-link nav2 " href="products.php">Products</a>
    </li>
    <li class="nav-item navli" >
      <a class="nav-link nav2" href="services.php">Services</a>
    </li>
    
    
  </ul>
</div>
<hr class="hr2">


<body class="bcolor">
<div class="container-md">
  <h3 class="title-cart">Cart</h3>
 
<center>
  <div class="container-md cart-container" >
   
    <div class="my_content">
       <div class="panel-heading panel-cart" >
          </div>

      <div class="row cart-row1">

        <div class="col-lg jusko cart-col1">
          <table class="crt_tbl table table-bordered">
            <tbody>
              <?php
                    if (empty($_SESSION['cart'])) {
                  ?>
                      <tr background="img/login/empty_cart.png" class="cart-tr1">
                        <td colspan="3"></td>
                          
                      </tr>
                  <?php
                    }
                    else{
                      $grandtotal1 = 0;

                      foreach ($_SESSION['cart'] as $key => $value) 
                      { 
                        $sql = "SELECT pd.product_image,pd.product_name,pv.weight_value,pv.price,pv.product_variation_id,w.abbreviation FROM product_details_tbl pd INNER JOIN product_variation_tbl pv ON pv.product_details_id = pd.product_details_id INNER JOIN weight_unit_tbl w ON pv.weight_unit_id = w.weight_unit_id WHERE product_variation_id = '$key'";
                      $ex = mysqli_query($db, $sql);
                      $row = mysqli_fetch_assoc($ex);

                      $subtotal = $value * $row['price'];
                      $grandtotal1 += $subtotal;
                  ?>
              <tr> 
              <form method="POST"> 
              <div class="row row1">

                <!-- product -->
                <td>
                  <div class="row row1">
                      <!-- image -->
                    <div class="col-sm-4 cart-col2" >
                      <?php echo '<img class="prod-img" src="'.$row['product_image'].'" style="height: 80px;width: 80px;" >'; ?>
                  
                    </div>

                    <div class="col-sm cart-col3" >
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
                <td colspan="2" class="cart_quantity" >
                  <div class="row">
                  
                    <div class="col">
                      <!-- quantity -->
                          <div class="row">
                            <div class="col cart-col4" >
                                
                                <div class="row">
                                  <div class="col">
                                      <center>
                                      <div class="cart-div1"> 
                                     <a href="cart.php?minus_id=<?php echo $row['product_variation_id']; ?>" class="cart-minus">-</a>
                                     <input type="text" id="quantity" name="quantity" min="1" value="<?php echo $value; ?>" size="1" onchange="calculate()" onkeydown="return (event.keyCode!=13);" class="cart-input" readonly>
                                      <a href="cart.php?plus_id=<?php echo $row['product_variation_id']; ?>" class="cart-plus">+</a>
                                      </div>
                                     </center>
                                  </div>
                                </div>
                            </div>
                          
                      <!-- subtotal -->
                         
                            <div class="col cart-col4">
                               <div class="row">
                                </div>
                                 <div class="row">
                                  <div class="col">
                                   <center>
                                    <h6 class="cart-h6">&#8369; <?php echo number_format($subtotal,2,".",","); ?></h6>
                                    </center>
                                  </div>
                                </div>
                            </div>

                             <!-- remove -->
                     <div class="col cart-col4" >
                      <center>
                      <a class="cart-remove" href="cart.php?remove_id=<?php echo $row['product_variation_id']; ?>">Remove</a>
                      </center>
                    </div>
                          </div>
                    </div>
                   
                  </div>


                  
                </td>
               
              </div>
              </form>
              </tr>
               <?php
                      }
                    ?>
               
                  <tr>
                    <td colspan="1" align="left" class="cart-td">

                        <h6 class="cart-total" >Total <br><?php echo "<b>₱".number_format($grandtotal1,2,".",",")."</b>"; ?></span></h6>

                    </td>
           
                     <td colspan="2" align="right"><button type="button" name="checkout_all" class="btn cart-checkout" data-toggle="modal" data-target="#order_all" >Checkout</button></td>
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
                <div class="container cart-modal-container" >
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
                  <label for="houseno" class="cart-label1">House #:</label>
                  <label for="brgy">Barangay:</label>
                  <div class="form-group">
                    <input type="text" name="houseno" class="form-control cart-minput1"  value="<?php echo $show_info['house_no']; ?>">
                    <input type="text" name="brgy" class="form-control cart-minput2"  value="<?php echo $show_info['barangay']; ?>">
                  </div>

                  <label for="city" class="cart-label2">City/Municipality:</label>
                  <label for="brgy">Province:</label>
                  <div class="form-group">
                    <input type="text" name="city" class="form-control cart-minput3"  value="<?php echo $show_info['city']; ?>">
                    <input type="text" name="province" class="form-control cart-minput4"  value="<?php echo $show_info['province']; ?>">

                    <br><br>
                    <p><i>Important: The customer will pay for the shipping cost charged by the courier.<br><span style="color: red">By clicking checkout you've agreed to this policy.</span><i></p>
                  </div>
                </div>

                <div id="for_pick" style="display:none;">
                <hr><h5>Pick-up Information </h5>
                <label for="houseno" class="cart-label3">Select campus:</label>
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