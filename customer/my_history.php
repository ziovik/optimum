  <table width="800" align="center" >
  	<tr align="center">
  		<td colspan="7"><h2>История заказов</h2></td>
  	</tr>
  	<tr style="text-align: center;">
  		<th >S/N</th>
      
  		<th>Наимнование </th>
      
  		<th>количество</th>
  		<th>Дистрибьютор</th>
      <th>Цена</th>
  		<th>Положение</th>
      <th>Дата заказы</th>
     
  		
  	</tr>
       
       <?php

         include("inc/db.php");

        
        if (isset($_SESSION['id'])) {
         
     // this is for customer details
          $customer_id = $_SESSION['id'];
         

         
          $i= 0;

         
            
            $get_cart = "select 
                             pt.onscreen_status as onscreen_status,
                             pt.product_id as product_id,
                             so.registration_date as order_date,
                             c.id as cart_id,
                             pt.quantity as qty

                         from 
                              cart c
                              join product_item pt on pt.cart_id = c.id
                              join simple_order so on so.cart_id = pt.cart_id
                         where c.customer_id = '$customer_id' AND (pt.onscreen_status = 'Принял'  OR pt.onscreen_status = 'Отказ') ";

            $run_cart = mysqli_query($con, $get_cart);

            while ($row_cart = mysqli_fetch_array($run_cart)) {
                $onscreen_status = $row_cart['onscreen_status'];
               $product_id = $row_cart['product_id'];
               $cart_id =$row_cart['cart_id'];
               $order_date = $row_cart['order_date'];

              $qty = $row_cart['qty'];

            $get_pro ="select * from product where id = '$product_id'";

            $run_pro = mysqli_query($con, $get_pro);

            while ($rows = mysqli_fetch_array($run_pro)) {
              $product_name = $rows['name'];
              $product_price = $rows['price'];
              $dist_id = $rows['distributor_id'];


              $get_dist_name = "select 
                                   c.name as dist_name
                                from 
                                     distributor d
                                     join company c on c.id = d.company_id
                                 where d.id = '$dist_id'";

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
            <td><?php echo $product_price; ?></td>
            <td><?php echo $onscreen_status; ?></td>
            <td><?php echo $order_date; ?></td>
            </tr>
          <?php } } }}?>

         

  </table>

  

  


