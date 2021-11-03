<?php
include ('../include/dbconnection.php');

if(isset($_POST['checking_viewbtn'])){
    $order_id = $_POST['order_ID'];

    $sql_view = "SELECT pd.product_image,pd.product_name, oi.current_price, oi.quantity, od.total, od.status_id, pv.product_variation_id, pv.weight_value, wu.abbreviation FROM product_details_tbl pd INNER JOIN product_variation_tbl pv ON pv.product_details_id = pd.product_details_id INNER JOIN weight_unit_tbl wu ON pv.weight_unit_id = wu.weight_unit_id INNER JOIN order_items_tbl oi ON oi.product_variation_id = pv.product_variation_id INNER JOIN order_details_tbl od ON oi.order_details_id = od.order_details_id WHERE od.order_details_id = '$order_id'";
        $exe_view = mysqli_query($db,$sql_view );
        $view = mysqli_fetch_assoc($exe_view);

        $g_total = 0;
        $return = "";
        
        do{
            $subtotal = $view['current_price'] * $view['quantity'];
            $g_total += $subtotal;
            
            $return .= '
                <tr>    
                    <td><img src="../'.$view['product_image'].'" style="width: 50px; height: 50px;"></td>
                    <td colspan="2">'.$view['product_name'].'</td>
                    <td>'.$view['weight_value'].''.$view['abbreviation'].'</td>
                    <td>'.$view['current_price'].'</td>
                    <td> x'.$view['quantity'].'</td>
                    <td> ₱'.number_format($subtotal,2,".",",").'</td>
                </tr>
            ';

        }while($view = mysqli_fetch_assoc($exe_view));

            $res = '<tr>
                      <td colspan="5" align="right"><b>Total:</b></td>
                      <td colspan="2"><b>₱'.number_format($g_total,2,".",",").'</b></td>
                    </tr>';

        echo $return.''.$res;
}

?>