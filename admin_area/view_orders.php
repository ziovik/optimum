<table width="800" align="center" >
	<tr align="center">
		<td colspan="7"><h2>View all Orders Here</h2></td>
	</tr>
	<tr style="text-align: center;">
		<th >S/N</th>
    <th>Customer Email</th>
		<th>Product Name</th>
		<th>Quantity</th>
		<th>Order Date</th>
		<th>Action</th>
		
	</tr>
     
     <?php

       include("inc/db.php");



       $get_order = "select * from orders ";

       $run_order = mysqli_query($con, $get_order);

       $i = 0;

       while($row_order = mysqli_fetch_array($run_order)){

       	//for deleting
          $order_id = $row_order['order_id'];
       	//deleting

       	$product_id = $row_order['p_id'];
       	$qty = $row_order['qty'];
        $c_id = $row_order['c_id'];
       	$order_date = $row_order['order_date'];
       	
       	$i++;
       
        $get_pro = "select * from products where product_id ='$product_id'";
        $run_pro =mysqli_query($con,$get_pro);

        $row_pro =mysqli_fetch_array($run_pro);
        $pro_image= $row_pro['product_image'];
        $pro_name = $row_pro['product_title'];


        $get_c = "select * from customers where customer_id= '$c_id'";
        $run_c = mysqli_query($con,$get_c);

        $row_c = mysqli_fetch_array($run_c);

        $c_email = $row_c['customer_email'];
       

     ?>

     <tr align="center">
     	<td><?php echo $i;  ?></td>
      <td><?php echo $c_email;  ?></td>
     	<td><?php echo $pro_name; ?><br>  <img src="../admin_area/product_images/<?php echo $pro_image; ?>" width='60px' height='60px' /></td>
     
     	<td><?php echo $qty; ?></td>
     	<td><?php echo $order_date; ?></td>
      
     	<td><a href="index.php?confirm_order=<?php echo $order_id;  ?>">Complete Order</a></td>
     </tr>

<?php } ?>
</table

