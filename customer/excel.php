<?php
session_start();
include("inc/db.php");


$output = '<meta http-equiv=Content-Type content="text/html; charset=utf-8">';
$i = 0;

if (isset($_SESSION['id'])) {
	$customer_id = $_SESSION['id'];



if (isset($_POST['export_excel'])) {

  
	$sql = "select 
                 pt.quantity as quantity,
                 pt.onscreen_status as status,
                 cm.name as company_name,
                 p.name as product_name,
                 so.id as order_id,
                 cc.name as customer_name,
                 p.price as price

	         from 
	              cart c 
                  join product_item pt on pt.cart_id = c.id
                  join product p on p.id = pt.product_id
                  join distributor d on d.id = p.distributor_id
                  join company cm on cm.id = d.company_id
                  join customer cc on cc.id = c.customer_id
                  join simple_order so on so.cart_id = pt.cart_id

	         where c.customer_id= '$customer_id' AND (pt.onscreen_status = 'Отправил' OR pt.onscreen_status = 'Смотрел' ) ";

	$result = mysqli_query($con, $sql);
	


	$i++;
    

	if (mysqli_num_rows($result) > 0) {

$rows = mysqli_fetch_array($result);
$customer_name = $rows['customer_name'];
$order_id = $rows['order_id'];

   


           
		$output .='
		      <h2 style = "text-align:center;">'.$rows['customer_name'].'</h2>
          <h4 style = "text-align:center;" >Номер заказа: №'.$rows['order_id'].'</h4><br><br>
              <table class="table" bordered = "2">
                   <tr style =" background-color: #f2f2f2;">
                     <th style="width : 500px;  border: 1px solid #ddd; padding: 8px;  padding-top: 12px;padding-bottom: 12px; text-align: left; background-color: #800080;color: white;">Наимнование</th>
  		             <th style="width : 100px;  border: 1px solid #ddd; padding: 8px;  padding-top: 12px;padding-bottom: 12px; text-align: left; background-color: #800080;color: white;">Количество</th>
                   <th style="width : 100px;  border: 1px solid #ddd; padding: 8px;  padding-top: 12px;padding-bottom: 12px; text-align: left; background-color: #800080;color: white;">Цена<br><small>(1шт.)</small></th>
  		             <th style="width : 200px;  border: 1px solid #ddd; padding: 8px;  padding-top: 12px;padding-bottom: 12px; text-align: left; background-color: #800080;color: white;">Дистрибьютор</th>
  		             <th style="width : 200px;  border: 1px solid #ddd; padding: 8px;  padding-top: 12px;padding-bottom: 12px; text-align: left; background-color: #800080;color: white;">Действие</th>
                   </tr>
              
		';


 while ($row = mysqli_fetch_array($result)) {

      $qty = $row['quantity'];
      $product_name = $row['product_name'];
      
      $dist_name = $row['company_name'];
      $onscreen_status = $row['status'];
      $price = $row['price'];
      
           	

			$output .= '
                       

                        <tr>
                           
                           <td style="width : 500px; text-align:left;  border: 1px solid #ddd;padding: 8px;">'.$row['product_name'].'</td>
                           <td style="width : 50px; text-align:center; border: 1px solid #ddd; padding: 8px;"">'.$row["quantity"].'</td>
                           <td style="width : 50px; text-align:center; border: 1px solid #ddd; padding: 8px;"">'.$row['price'].'</td>
                           <td style="width : 200px; text-align:center; border: 1px solid #ddd;padding: 8px;"">'.$row['company_name'].'</td>
                           <td style="width : 100px; text-align:center; border: 1px solid #ddd;padding: 8px;"">'.$row["status"].'</td>

                        </tr>
			';
		} 
     }
   }

		$output .= '</table>';

		header("Content-Type: text/cvs; charset=utf-8");
		header("Content-Disposition: attachment; filename=download.cvs");
		echo $output;
	}



?>