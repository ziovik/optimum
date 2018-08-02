  <table width="800" align="center" >
  	<tr align="center">
  		<td colspan="7"><h2>Your Orders Details</h2></td>
  	</tr>
  	<tr style="text-align: center;">
  		<th >S/N</th>
      
  		<th>Product Name</th>
      
  		<th>Quantity</th>
  		<th>Distributor</th>
  		<th>Status</th>
      <th>Delete</th>
  		
  	</tr>
       
       <?php

         include("inc/db.php");

        
        if (isset($_SESSION['customer_email'])) {
         
     // this is for customer details
          $user = $_SESSION['customer_email'];

         
          $i= 0;

          $get_c = "select *from customers where customer_email = '$user' ";

          $run_c = mysqli_query($con, $get_c);

          while($row_c = mysqli_fetch_array($run_c)){
            $c_id = $row_c['customer_id'];
            $customer_email = $row_c['customer_email'];
            
            $get_cart = "select * from cart where customer_email = '$customer_email' ";

            $run_cart = mysqli_query($con, $get_cart);

            while ($row_cart = mysqli_fetch_array($run_cart)) {
               $cart_status = $row_cart['cart_status'];
               $product_id = $row_cart['p_id'];
               $cart_id =$row_cart['cart_id'];

               $qty = $row_cart['qty'];

            $get_pro ="select * from products where product_id = '$product_id'";

            $run_pro = mysqli_query($con, $get_pro);

            while ($rows = mysqli_fetch_array($run_pro)) {
              $product_name = $rows['product_title'];
              
              $dist_id = $rows['dist_id'];


              $get_dist_name = "select * from distributors where dist_id = '$dist_id'";

              $run_dist = mysqli_query($con, $get_dist_name);

              while ($row_dist = mysqli_fetch_array($run_dist)) {
                $dist_name = $row_dist['dist_name'];
  
                $i++;

            
            ?>

            <tr align="center">
            <td><?php echo $i;  ?></td>
            <td><?php echo $product_name; ?></td>

            <td><?php echo $qty; ?></td>
            <td><?php echo $dist_name; ?></td>

            <td><?php echo $cart_status; ?></td>
            <td><a href="my_orders.php?remove=<?php echo $cart_id; ?>">Remove</a></td>
            </tr>
          <?php }} } }}?>

          <form  method="post" action="excel.php">
            <input type="submit" name="export_excel" class="btn btn-success" value="Печать Заказы">
            
          </form>

  </table>

    <?php
    if (isset($_GET['remove'])) {

     $remove_id = $_GET['remove'];
     $user = $_SESSION['customer_email'];

     $delete_item = "delete from cart where p_id = '$remove_id' AND customer_email='$user' ";

     $run_delete_item = mysqli_query($con, $delete_item);


     echo "<script>alert('Product deleted')</script>";
     echo "<script>window.open('my_account.php','_self')</script>";

   }


   ?>

  


