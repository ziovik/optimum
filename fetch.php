<div class="banner banner-1">
    <div class="table-responsive" data-pattern='priority-columns'>
     <table cellspacing='0' id='group-test' class='table table-small-font table-bordered table-striped'>
        <thead>
          <tr >

              <th colspan='1' data-priority= "1" style="text-align: center;" >Дистрибьютор</th>

              <th colspan='1' data-priority= "2" style="text-align: center;" >Найменование</th>
              <th colspan='1' data-priority= "3" style="text-align: center;">Производитель/<br>Страна производства</th>
              <th colspan='1' data-priority= "4" style="text-align: center;">Цена</th>
              <th colspan='1' data-priority= "5" style="text-align: center;">Годен до</th>
              <th colspan='1' data-priority= "6" style="text-align: center;">Остаток</th>
              <th colspan='1' data-priority= "7" style="text-align: center;">Примечание</th>
          </tr>

               
<?php
session_start();
include("inc/functions.php");
 global $con;
       $output = '';
        //getting customer details
       $login = $_SESSION['login'];

        $get_c = "select *from credentials where login = '$login' ";

        $run_c = mysqli_query($con, $get_c);

        $row_c = mysqli_fetch_array($run_c);

        $credentials_id = $row_c['id'];

        $get_customer = "select * from customer where credentials_id = '$credentials_id'";

        $run_customer = mysqli_query($con, $get_customer);

        $row_customer = mysqli_fetch_array($run_customer);

        $customer_id = $row_customer['id'];


if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($con, $_POST["query"]);
 $query = "
          select 
              p.name 
          from 

              store s
              join distributor d on d.id = s.distributor_id
              join product p on p.distributor_id = d.id
              join customer c on c.region_id = s.region_id
              join company cm on cm.id = d.company_id
      
     where c.id = '$customer_id'
  AND p.name LIKE '%".$search."%'
  
 ";
}
else
{
 $query = 
     "select 
            p.id as product_id, 
            p.name as product_name, 
            p.manufacturer as product_manufacturer,
            p.price as product_price, 
            p.min_order as product_min_order,
            p.expires as expires,
            p.description as discription,
            p.discount as discount,
            cm.name as company_name
      from 

              store s
              join distributor d on d.id = s.distributor_id
              join product p on p.distributor_id = d.id
              join customer c on c.region_id = s.region_id
              join company cm on cm.id = d.company_id
      
      where c.id = '$customer_id'
         ORDER BY product_id
 ";
}
$result = mysqli_query($con, $query);
$count_result = mysqli_num_rows($result);
 if ($count_result == 0) {
	   	    echo "<h2>'нет продукта'</h2>";
	      }else{

	    while($row_pro=mysqli_fetch_array($result)){
		  $pro_id = $row_pro['product_id'];
		  $pro_expires = $row_pro['expires'];
		  $pro_name = $row_pro['product_name'];
		  $pro_price = $row_pro['product_price'];
		  $pro_desc = $row_pro['discription'];
		  $pro_manu = $row_pro['product_manufacturer'];
      $pro_min_order = $row_pro['product_min_order'];
      $pro_dist = $row_pro['company_name'];
      $pro_discount = $row_pro['discount'];


       ?>
                <tr >
                    <td data-priority='1' style='background: white; color: #400040;'><?php echo $pro_dist ?></td>
                    <td data-priority='2' style='background: white; color: #400040; width: 400px;'><a href='../details.php?pro_id=<?php echo $pro_id ?>'><?php echo $pro_name ?></a></td>
                    <td data-priority='3'style='background: white; color: #400040;'><?php echo $pro_manu ?></td>
                    <td data-priority='4' style='background: white; color: #400040;'><?php echo $pro_price ?></td>

                    <td data-priority='5' style='background: white; color: #400040;'><?php echo $pro_expires ?></td>
                    <td data-priority='6' style='background: white; color: #400040;'><?php echo $pro_min_order ?></td>
                    <td data-priority='7' style='background: white; color: #400040;'><?php echo $pro_desc ?></td>
             
                </tr>

     
<?php
		}

	}

?>
   </thead>
          </table>
       </div>