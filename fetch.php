               
<?php
session_start();

 include("inc/db.php"); 
      
        //getting customer details
       $customer_id = $_SESSION['id'];

       $query = "
          select 
            p.name,
            p.id as product_id,
            p.manufacturer ,
            p.price , 
            p.min_order ,
            p.expires ,
            p.description ,
            p.discount ,
            cm.name as company_name 
          from 

              store s
              join distributor d on d.id = s.distributor_id
              join product p on p.distributor_id = d.id
              join customer c on c.region_id = s.region_id
              join company cm on cm.id = d.company_id
      
     where c.id = '$customer_id'";
     $run = mysqli_query($con, $query);
     $row = mysqli_fetch_array($run);

     $product_id = $row['product_id'];

       ?>
                         
         <table cellspacing='0' id='group-test' class='table table-small-font table-bordered table-striped'>
        <thead>
          <tr >

              <th colspan='1' data-priority= "1" style="text-align: center;" >Дистрибьютор</th>

              <th colspan='1' data-priority= "2" style="text-align: center; max-width: 500px;"  >Найменование</th>
              <th colspan='1' data-priority= "3" style="text-align: center;">Производитель/<br>Страна производства</th>
             
              

              <th colspan='1' data-priority= "4" style="text-align: center;">Цена<br>(руб.)</th>
              <th colspan='1' data-priority= "5" style="text-align: center;">Годен до</th>
              <th colspan='1' data-priority= "6" style="text-align: center;">Остаток</th>
              <th colspan='1' data-priority= "7" style="text-align: center;">Примечание</th>
              <th colspan='1' data-priority= "7" style="text-align: center;">Добавить</th>
              
          </tr>

               
<?php

include("inc/functions.php");
 global $con;
       $output = '';
        //getting customer details
       $customer_id = $_SESSION['id'];

        


if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($con, $_POST["query"]);
 $query = "
          select 
            p.name,
            p.id as product_id,
            p.manufacturer ,
            p.price , 
            p.min_order ,
            p.expires ,
            p.description ,
            p.discount ,
            cm.name as company_name 
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
            p.name , 
            p.manufacturer ,
            p.price , 
            p.min_order ,
            p.expires ,
            p.description ,
            p.discount ,
            cm.name as company_name
      from 

              store s
              join distributor d on d.id = s.distributor_id
              join product p on p.distributor_id = d.id
              join customer c on c.region_id = s.region_id
              join company cm on cm.id = d.company_id
      
      where c.id = '$customer_id'
         ORDER BY p.id
 ";
}
$result = mysqli_query($con, $query);
  if (!$result ) {
             printf("Error: %s\n", mysqli_error($con));
            exit();
           }/// helps to check error

$count_result = mysqli_num_rows($result);
 if ($count_result == 0) {
          echo "<h2>'нет продукта'</h2>";
        }else{

      while($row_pro=mysqli_fetch_array($result)){
      $pro_id = $row_pro['product_id'];
      $pro_expires = $row_pro['expires'];
      $pro_name = $row_pro['name'];
      $pro_price = $row_pro['price'];
      $pro_desc = $row_pro['description'];
      $pro_manu = $row_pro['manufacturer'];
      $pro_min_order = $row_pro['min_order'];
      $pro_dist = $row_pro['company_name'];
      $pro_discount = $row_pro['discount'];


       ?>
                <tr >

                <form method="post"action="cart.php?action=add&id=<?php echo $pro_id; ?>" style = "width: 100%;">
                 
                    <td data-priority='1' style='background: white; color: #400040;'><?php echo $pro_dist ?></td>
                    <td data-priority='2' style='background: white; color: #400040; width: 400px;'><a href='details.php?pro_id=<?php echo $pro_id ?>' style = "max-width: 500px;"><?php echo $pro_name ?></a></td>
                    <td data-priority='3'style='background: white; color: #400040;'><?php echo $pro_manu ?></td>

                    
                    <td data-priority='4' style='background: white; color: #400040;'><?php echo $pro_price ?></td>

                    <td data-priority='5' style='background: white; color: #400040;'><?php echo $pro_expires ?></td>
                    <td data-priority='6' style='background: white; color: #400040;'><?php echo $pro_min_order ?></td>
                    <td data-priority='7' style='background: white; color: #400040;'><?php echo $pro_desc ?></td>

                    <td><input type="text" name="quantity" class="form-control" value="1"/>
                    <!-- hidden-->
                 
                        <input type="hidden" name="hidden_name" value="<?php echo $pro_name; ?>"/>
                        <input type="hidden" name="hidden_price" value="<?php echo $pro_price; ?>"/>
                     
                   
                        <input type="submit" name="add_to_cart"
                               style="margin-top:5px; width: 70px; height: 30px; background: #800080; font-size: 14px;"
                               class="btn btn-success" value="Add" style="width: "/>
                    </td>

                  </form>
                </tr>

             

     
<?php
    }

  }

?>
   </thead>
          </table>
      </form>
    
       </div>