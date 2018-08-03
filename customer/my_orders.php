  <table width="800" align="center" >
  	<tr align="center">
  		<td colspan="7"><h2>Your Orders Details</h2></td>
  	</tr>
  	<tr style="text-align: center;">
  		<th >S/N</th>
      
  		<th>Наимнование </th>
      
  		<th>количество</th>
  		<th>Дистрибьютор</th>
      <th>Цена</th>
  		<th>Положение</th>
     
  		
  	</tr>
       
       <?php

         include("inc/db.php");

        
        if (isset($_SESSION['login'])) {
         
     // this is for customer details
          $user = $_SESSION['login'];

         
          $i= 0;

          $get_c = "select
                          cc.name as name,
                          cc.id as c_id,
                          c.login as login
                    from 
                          credentials c
                          join customer cc on cc.credentials_id = c.id
                    where  c.login = '$login' ";

          $run_c = mysqli_query($con, $get_c);

          while($row_c = mysqli_fetch_array($run_c)){
            $c_id = $row_c['c_id'];
            $customer_login = $row_c['login'];
            
            $get_cart = "select 
                             c.status as status,
                             pt.product_id as product_id,
                             c.id as cart_id,
                             pt.quantity as qty

                         from 
                              cart c
                              join product_item pt on pt.cart_id = c.id
                         where c.customer_id = '$c_id' ";

            $run_cart = mysqli_query($con, $get_cart);

            while ($row_cart = mysqli_fetch_array($run_cart)) {
               $cart_status = $row_cart['status'];
               $product_id = $row_cart['product_id'];
               $cart_id =$row_cart['cart_id'];

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
            <td><?php echo $cart_status; ?></td>
            
            </tr>
          <?php }} } }}?>

          <form  method="post" action="excel.php">
            <input type="submit" name="export_excel" class="btn btn-success" value="Печать Заказы">
            
          </form>

  </table>

  

  


