<div class="banner banner-1">
    <div class="table-responsive" data-pattern='priority-columns'>
     <table cellspacing='0' id='group-test' class='table table-small-font table-bordered table-striped'>
        <thead>
          <tr >

              <th colspan='1' style="text-align: center;" >Дистрибьютор</th>

              <th colspan='1' style="text-align: center;" >Найменование</th>
              <th colspan='1' style="text-align: center;">Производитель/<br>Страна производства</th>
              <th colspan='1' style="text-align: center;">Цена</th>
              <th colspan='1' style="text-align: center;">Годен до</th>
              <th colspan='1' style="text-align: center;">Остаток</th>
              <th colspan='1' style="text-align: center;">Примечание</th>
          </tr>

               
<?php
session_start();
include("inc/functions.php");
 global $con;
       $output = '';
        //getting customer details
       $user = $_SESSION['customer_email'];

        $get_c = "select *from customers where customer_email = '$user' ";

        $run_c = mysqli_query($con, $get_c);

        $row_c = mysqli_fetch_array($run_c);

        $c_id = $row_c['customer_id'];
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($con, $_POST["query"]);
 $query = "
 select * from products p 
     
     join distributors d on p.dist_id = d.dist_id 
     join customers c on d.region_id = c.region_id 
      
     where c.customer_id = '$c_id'
  AND p.product_title LIKE '%".$search."%'
  
 ";
}
else
{
 $query = 
 "select * from products p 
     
     join distributors d on p.dist_id = d.dist_id 
     join customers c on d.region_id = c.region_id 
      
     where c.customer_id = '$c_id'  ORDER BY product_id
 ";
}
$result = mysqli_query($con, $query);
$count_result = mysqli_num_rows($result);
 if ($count_result == 0) {
	   	    echo "<h2>'No Product in ths Category'</h2>";
	      }else{

	    while($row_allcosm_pro=mysqli_fetch_array($result)){
		  $pro_id = $row_allcosm_pro['product_id'];
		  $pro_cat = $row_allcosm_pro['product_cat'];
		  $pro_sub_cat = $row_allcosm_pro['product_sub_cat'];
		  $pro_brand = $row_allcosm_pro['product_brand'];
		  $pro_name = $row_allcosm_pro['product_title'];
		  $pro_price = $row_allcosm_pro['product_price'];
		  $pro_desc = $row_allcosm_pro['product_desc'];
		  $pro_manu = $row_allcosm_pro['product_manu'];
      $pro_min_order = $row_allcosm_pro['min_order'];
      $pro_dist = $row_allcosm_pro['dist_id'];

      $get_dist = "select * from distributors where dist_id = '$pro_dist'";

      $run_dist = mysqli_query($con, $get_dist);

      $row_dist = mysqli_fetch_array($run_dist);

      $dist_name = $row_dist['dist_name'];

         



       echo "
                

          
       
                <tr >
                   <td colspan='1' data-priority='7'>$dist_name</td>
                   
                   <td colspan='1' data-priority='1'><a href='product_details.php?pro_id= $pro_id '>$pro_name  </td>
                   <td colspan='1' data-priority='3'>$pro_manu </td>
                   <td colspan='1' data-priority='2'>$pro_price</td>
                   <td colspan='1' data-priority='2'>0</td>
                   <td colspan='1' data-priority='2'>$pro_min_order</td>
                   <td colspan='1' data-priority='2'>$pro_desc</td>
                   

                   


                </tr>

          
       ";

		}

	}

?>
   </thead>
          </table>
       </div>