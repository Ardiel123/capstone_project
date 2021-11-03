<?php
include ('../include/dbconnection.php');

if(isset($_POST['checking_viewbtn'])){
    $service_id = $_POST['service_ID'];

    $sql_view = "SELECT `service_type`, `print_service_image`,`print_service_price`, `print_service_size`, `print_service_quantity`, `print_service_total` FROM `printing_service_tbl` WHERE printing_service_id = '$service_id'";
        $exe_view = mysqli_query($db,$sql_view );
        $view = mysqli_fetch_assoc($exe_view);

        
            $return = '
                <tr>    
                    <td><img src="../'.$view['print_service_image'].'" style="width: 50px; height: 50px;"></td>
                    <td>'.$view['service_type'].'</td>
                    <td>'.$view['print_service_size'].'</td>
                    <td> x'.$view['print_service_quantity'].'</td>
                    <td> ₱'.$view['print_service_price'].'</td>
                </tr>
            ';


            $res = '<tr>
                      <td colspan="4" align="right"><b>Total:</b></td>
                      <td colspan="2"><b>₱'.number_format($view['print_service_total'],2,".",",").'</b></td>
                    </tr>';

        echo $return.''.$res;
}


?>