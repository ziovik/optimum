

<table width="100%" align="center" >
	<tr align="center">
		<h2 style="text-align: center;">Мои товары</h2>
	</tr>
	<tr style="text-align: center;">
		<th >S/N</th>
		<th style="width:400px; text-align: center;">Наимнование</th>
		
		<th>Цена (руб)</th>
		<th style="text-align: center;">Производитель</th>
    <th style="text-align: center;">Годен до</th>
    <th style="text-align: center;">Минимальная покупка</th>
    <th style="text-align: center;">Максимальная покупка</th>
    <th style="text-align: center;">Скидки</th>
    <th style="text-align: center;">Примечание</th>

		
		
	</tr>
     
     <?php

       include("inc/db.php");
       $i = 0;

       if (isset($_SESSION['distributor_id'])) {

        $dist_id = $_SESSION['distributor_id'];

        $get = "select 
                  
                   p.name as product_name,
                   p.price as product_price,
                   p.manufacturer as manufacturer,
                   p.min_order as min_order,
                   p.max_order as max_order,
                   p.discount as discount,
                   p.expires as expires,
                   p.description as description
                from 
                    product p
                    join distributor d on d.id = p.distributor_id
                   
                where d.id = '$dist_id'";

          $run = mysqli_query($con, $get);
           if (!$run ) {
             printf("Error: %s\n", mysqli_error($con));
            exit();
           }/// helps to check error


          while($rows = mysqli_fetch_array($run)){
            $product_name = $rows['product_name'];
            $product_price = $rows['product_price'];
            $manufacturer = $rows['manufacturer'];
            $expires = $rows['expires'];
            $min_order = $rows['min_order'];
            $max_order = $rows['max_order'];
            $discount = $rows['discount'];
            $desc = $rows['description'];
     
                 $i++;
     ?>

     <tr align="center">
     	<td><?php echo $i;  ?></td>
     	<td ><?php echo $product_name; ?></td>
     	<td><?php echo $product_price; ?></td>
      <td><?php echo $manufacturer; ?></td>
      <td><?php echo $expires; ?></td>
      <td><?php echo $min_order; ?></td>
      <td><?php echo $max_order; ?></td>
      <td><?php echo $discount ; ?></td>
      <td><?php echo $desc ; ?></td>

     	
     	
     </tr>

    <?php } } ?>

</table>

