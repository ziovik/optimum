

<table width="800" align="center" >
	<tr align="center">
		<td colspan="7"><h2>View All Products</h2></td>
	</tr>
	<tr style="text-align: center;">
		<th >S/N</th>
		<th>Product Name</th>
		
		<th>Product Price</th>
		<th>Minimum Buy</th>
		<th>Region</th>
		
	</tr>
     
     <?php

       include("inc/db.php");

       if (isset($_SESSION['dist_email'])) {

        $dist_email = $_SESSION['dist_email'];
         
       
       // getting distributor info

       $get_dist = "select * from distributors where dist_email = '$dist_email' ";
       
       $run_dist = mysqli_query($con,$get_dist);

       $row_dist = mysqli_fetch_array($run_dist);
       $dist_id = $row_dist['dist_id'];



       $get_pro = "select * from products where dist_id ='$dist_id'";

       $run_pro = mysqli_query($con, $get_pro);

       $i = 0;

       while($row_pro = mysqli_fetch_array($run_pro)){

      
          $pro_id = $row_pro['product_id'];
       
          $region = $row_pro['region_id'];
        	$pro_name = $row_pro['product_title'];
       	
       	  $pro_price = $row_pro['product_price'];

          $min_buy = $row_pro['min_order'];
       	
       	  $i++;
        

       $get_region ="select * from regions where region_id='$region'";

       $run_region = mysqli_query($con, $get_region);

       while ($row_region = mysqli_fetch_array($run_region)) {
         $region_name = $row_region['region_name'];
       

     ?>

     <tr align="center">
     	<td><?php echo $i;  ?></td>
     	<td><?php echo $pro_name; ?></td>
     	
     	<td><?php echo $pro_price; ?></td>
      
      <td><?php echo $min_buy; ?></td>

     	<td><?php echo $region_name; ?></td>
     	
     </tr>

    <?php } }
 } ?>

</table>

