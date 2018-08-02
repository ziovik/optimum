

<table width="800" align="center" >
	<tr align="center">
		<td colspan="7"><h2>View All Products</h2></td>
	</tr>
	<tr style="text-align: center;">
		<th >S/N</th>
		<th>Product Name</th>
		<th>Distributor</th>
		<th>Price</th>
		<th>Manufacturer</th>
		<th>Edit</th>
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

       $get_pro = "select * from products";

       $run_pro = mysqli_query($con, $get_pro);

       $i = 0;

       while($row_pro = mysqli_fetch_array($run_pro)){

       	//for deleting
          $pro_id = $row_pro['product_id'];
       	//deleting

       	$pro_name = $row_pro['product_title'];
       	$pro_dist = $row_pro['dist_id'];
       	$pro_price = $row_pro['product_price'];
       	$pro_manu = $row_pro['product_manu'];
       	$i++;
       

       //get distributors name

        $get_dist = "select * from distributors where dist_id = '$pro_dist'";

        $run_dist = mysqli_query($con, $get_dist);

        while($row_dist= mysqli_fetch_array($run_dist)){
          $dist_name = $row_dist['dist_name'];
        }

       

     ?>

     <tr align="center">
     	<td><?php echo $i;  ?></td>
     	<td><?php echo $pro_name; ?></td>
     	<td ><?php echo $dist_name; ?></td>
     	<td><?php echo $pro_price; ?></td>
     	<td><?php echo $pro_manu; ?></td>

     	<td><a href="index.php?edit_pro=<?php echo $pro_id; ?>">Edit</a></td>
     	<td><a href="delete_pro.php?delete_pro=<?php echo $pro_id; ?>">Delete</a></td>
     </tr>

    <?php } ?>

</table>

<!--close the not accessing -->
<?php  } ?>