<?php
include ('../include/dbconnection.php');

if(isset($_POST['viewbtn'])){
    $cus_id = $_POST['cus_ID'];

        $sql_view = "SELECT * FROM `customer_tbl` WHERE customer_id = '$cus_id'";
        $exe_view = mysqli_query($db,$sql_view );
        $show_cust = mysqli_fetch_assoc($exe_view);

        echo $return = '
        <table class="table table-bordered">
        <tbody>     
            <tr>    
                <td><b>Customer ID</b></td>
                <td>'.$show_cust['customer_id'].'</td>
            </tr>
            <tr>
                <td><b>Fullname</b></td>
                <td>'.$show_cust['customer_fname'].' '.$show_cust['customer_lname'].'</td>
            </tr>
            <tr>
                <td><b>Email address</b></td>
                <td>'.$show_cust['customer_email'].'</td>
            </tr>
            <tr>
                <td><b>Phone number</b></td>
                <td>'.$show_cust['customer_phonenumber'].'</td>
            </tr>
            <tr>
                <td><b>Home Address</b></td>
                <td>'.$show_cust['house_no'].'/'.$show_cust['barangay'].'/'.$show_cust['city'].'/'.$show_cust['province'].'</td>
            </tr>
            <tr>
                <td><b>Date registered</b></td>
                <td>'.$show_cust['date_created'].'</td>
            </tr>
        </tbody>            
        </table>
        ';
}

?>