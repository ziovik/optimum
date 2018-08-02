<table width="100%" align="center" >
	<tr align="center">
		<td colspan="7"><h2>View all Orders Here</h2></td>
	</tr>
	<tr style="text-align: center;">
		<th >S/N</th>
    <th>Customer Email</th>
		<th>Product Name</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Order Date</th>
    <th>Action</th>
		
	</tr>
     
     <?php

       include("inc/db.php");


     // this is for customer details
          $dist_email = $_SESSION['dist_email'];

          $get_d = "select *from distributors where dist_email = '$dist_email' ";

          $run_d = mysqli_query($con, $get_d);

          $row_d = mysqli_fetch_array($run_d);

          $dist_id = $row_d['dist_id'];

          $dist_email = $row_d['dist_email'];


          
          $i= 0;

         
          $get_pro = "select * from products  where dist_id = '$dist_id' ";

          $run_pro =mysqli_query($con,$get_pro);

         while( $row_pro =mysqli_fetch_array($run_pro)){
              $product_name = $row_pro['product_title'];

              $p_id =$row_pro['product_id'];
              $product_price = $row_pro['product_price'];
              



          $get_email = "select * from cart where p_id = '$p_id'";

          $run_email = mysqli_query($con, $get_email);

          while ($row_email = mysqli_fetch_array($run_email)) {
                $customer_email = $row_email['customer_email'];
                $qty = $row_email['qty'];
                $cart_id = $row_email['cart_id'];


                $get_date = "select * from orders where customer_email ='$customer_email'";

                $run_date = mysqli_query($con, $get_date);

                while ($row_date = mysqli_fetch_array($run_date)) {
                  $date = $row_date['order_date'];
                  $order_id =$row_date['order_id'];
      
                 $i++;
  

     ?>

     <tr align="center">
     	<td><?php echo $i;  ?></td>
      <td><?php echo $customer_email;  ?></td>
     	<td><?php echo  $product_name ?><br> </td>
      <td><?php echo  $product_price ?></td>
     	<td><?php echo $qty; ?></td>
     	<td><?php echo $date; ?></td>
      
     	<td>
        <a href="my_account.php?seen_order=<?php echo $cart_id;  ?>">Seen</a><br><hr>
        <a href="my_account.php?confirm_order=<?php echo $cart_id;  ?>">Complete</a><br><hr>
        <a href="my_account.php?reject_order=<?php echo $cart_id;  ?>">Rejected</a><br><hr>


      </td>
     </tr>

<?php } } } ?>


</table>
<br>
<br>
<form  method="post" action="excel.php">
  <input type="submit" name="export_excel" class="btn btn-success" value="Печать ">
  
</form>

         

