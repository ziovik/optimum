<table width="100%" align="center" >
  <tr align="center">
    <td colspan="7"><h2>View all Orders Here</h2></td>
  </tr>
  <tr style="text-align: center;">
    <th >S/N</th>
    <th>Customer Email</th>
    
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

              $get_orders = "select 
                               distinct o.order_id, 
                               c.customer_email as customer_email,
                               o.order_date as order_date
                           from 
                               orders o 
                               join cart_order co on o.order_id = co.order_id
                               join cart c on c.cart_id = co.cart_id
                               join products p on c.p_id = p.product_id
                           where
                                p.dist_id = '$dist_id' ";

          $orders_fetch = mysqli_query($con, $get_orders);
         while( $orders = mysqli_fetch_array($orders_fetch)) {
            $customer_email = $orders['customer_email'];
            $order_date = $orders['order_date'];
            $order_id = $orders['order_id'];

            $i++;
         

     ?>

     <tr align="center">
      <td><?php echo $i;  ?></td>
      <td><?php echo $customer_email;  ?></td>
      <td><?php echo $order_date; ?></td>
      
      <td><a href="index.php?check_order=<?php echo $order_id;  ?>">check</a></td>
     </tr>

<?php } ?>


</table>
<br>
<br>
 
         

