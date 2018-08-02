

<table width="800" align="center" >
	<tr align="center">
		<td colspan="7"><h2>View All Customers</h2></td>
	</tr>
	<tr style="text-align: center;">
		<th >S/N</th>
		<th>Customer Name</th>
		<th>Email</th>
		
		<th>image</th>
		<th>Delete</th>
	</tr>
     
     <?php

       include("inc/db.php");
        //for not acceessing this page by another person who is not in admin

   if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}

else{

   //

       $get_c = "select * from customers";

       $run_c = mysqli_query($con, $get_c);

       $i = 0;

       while($row_c = mysqli_fetch_array($run_c)){

       	
          $c_id = $row_c['customer_id'];
       	

       	$c_name = $row_c['customer_name'];
       	$c_email = $row_c['customer_email'];
       $c_image = $row_c['customer_image'];
       	$i++;
       

       

     ?>

     <tr align="center">
     	<td><?php echo $i;  ?></td>
     	<td><?php echo $c_name; ?></td>
      <td><?php echo $c_email; ?></td>
     	<td><img src="../customer/customer_images/<?php echo $c_image; ?>" width='60px' height='60px'</td>
     	
     	<td><a href="delete_customers.php?delete_c=<?php echo $c_id; ?>">Delete</a></td>
     </tr>

    <?php } ?>

</table>
<!--close the not accessing -->
<?php  } ?>