<?php
session_start();
include("inc/db.php");


$output = '<meta http-equiv=Content-Type content="text/html; charset=utf-8">';
$i = 0;

if (isset($_SESSION['customer_email'])) {
	$user = $_SESSION['customer_email'];



if (isset($_POST['export_excel'])) {
	$sql = "select * from cart where customer_email= '$user' ORDER BY cart_id DESC ";

	$result = mysqli_query($con, $sql);


	$i++;
    

	if (mysqli_num_rows($result) > 0) {
		$output .='
		       <h2 style = "text-align: center">Your orders</h2>
              <table class="table" bordered = "2">
                   <tr>
                     <th style="width : 500px;">Product Name</th>
  		             <th style="width : 100px;">Quantity</th>
  		             <th style="width : 200px;">Distributor</th>
  		             <th style="width : 100px;">Status</th>
                   </tr>
              
		';

		while ($row = mysqli_fetch_array($result)) {

			$qty = $row['qty'];
			$product_name = $row['p_id'];
			$customer_email = $row['customer_email'];
			$cart_status = $row['cart_status'];
           

           $get_pro = "select * from products where product_id = '$product_name'";

           $run_pro = mysqli_query($con, $get_pro);

           while ($row_pro = mysqli_fetch_array($run_pro)) {

           	  $product_name = $row_pro['product_title'];

           	  $dist_id = $row_pro['dist_id'];


           	  $get_dist = "select * from distributors where dist_id = '$dist_id'";

           	  $run_dist = mysqli_query($con, $get_dist);

           	  while ($row_dist = mysqli_fetch_array($run_dist)) {
           	  	$dist_name = $row_dist['dist_name'];
           	

			$output .= '


                        <tr>

                           <td style="width : 500px; text-align:center;">'.$row_pro['product_title'].'</td>
                           <td style="width : 50px; text-align:center;"">'.$row["qty"].'</td>
                           <td style="width : 200px; text-align:center;"">'.$row_dist['dist_name'].'</td>
                           <td style="width : 100px; text-align:center;"">'.$row["cart_status"].'</td>

                        </tr>
			';
		} 
     }
   }

		$output .= '</table>';

		header("Content-Type: text/cvs; charset=utf-8");
		header("Content-Disposition: attachment; filename=download.cvs");
		echo $output;
	}

}

}

?>