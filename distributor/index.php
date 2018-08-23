<?php

session_start();

if (!isset($_SESSION['distributor_id'] )) {
	echo "<script>window.open('login.php?not_dist=sign in!','_self')</script>";
}

else{
	


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>OPTIMUM BEAUTY | Distributor</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css" />
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	<link type="text/css" rel="stylesheet" href="css/table.css" />
	 <link type="text/css" rel="stylesheet" href="css/checkout_style.css"/>
	 <link type="text/css" rel="stylesheet" href="css/envelope.css" />

	

</head>

<body>
	<?php include("inc/db.php");

       ?>
<header>
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="pull-left">
					<?php

                if (isset($_SESSION['distributor_id'] )) {
                    include("inc/db.php");
                   $dist_id = $_SESSION['distributor_id'] ;

                    $get_info = "select
                                       c.name as company_name
                                  from distributor d
                                       join company c on c.id = d.company_id

                                  where  d.id = ' $dist_id' ";

                    $run_name = mysqli_query($con, $get_info);



                    $row = mysqli_fetch_array($run_name);

                    $company_name = $row['company_name'];

                    echo "<span>Добро пожаловать  в OPTIMUM BEAUTY   :    </span>" . $company_name . "<span></span>";



                } else {
                    echo "<b>Добро пожаловать Гость</b>";
                }

                ?>
				</div>
				<div class="pull-right">
					<ul class="header-top-links">
                    <?php

                    if (!isset($_SESSION['distributor_id'])) {
                        echo "<button style='width:100px;' background:#800080; border-radius:5px;' class='btn next-btn'><a href='#' class='text-uppercase' style='color:#fff;'>Войти</a></buuton>";
                    } else {
                        echo "<button style='width:100px;' background:#800080; border-radius:5px;' class='btn next-btn'><a href='logout.php' class='text-uppercase' style='color:#fff;'>Выити</a></buuton>";

                    }

                    ?>

                </ul>
				</div>
			</div>
		</div>
		<!-- /top Header -->

		<!-- header -->
		<div id="header">
			<div class="container">
				<div class="pull-left">
					<!-- Logo -->
					<div class="header-logo">
						<a class="logo" href="index.php">
							<img src="./img/logo.png" alt="">
						</a>
					</div>
					<!-- /Logo -->

					
					
				</div>
				<div class="pull-right">
					<ul class="header-btns">
						<!-- Account -->
						<li class="header-account dropdown default-dropdown">
							<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-user-o"></i>
								</div>
								<strong class="text-uppercase"> Личный кабинет <i class="fa fa-caret-down"></i></strong>
							</div>
							
							
							<ul class="custom-menu">
								<li><a href="my_account.php"><i class="fa fa-user-o"></i> Личный кабинет</a></li>
								
								<li><a href="logout.php"><i class="fa fa-unlock-alt"></i> Выити</a></li>
								
							</ul>
						</li>
						<!-- /Account -->

						

						<!-- Mobile nav toggle-->
						<li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
						</li>
						<!-- / Mobile nav toggle -->
					</ul>
				</div>
			</div>
			<!-- header -->
			
		</div>
		<!-- container -->
	</header>

	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- category nav -->
				<div class="category-nav show-on-click">
					<span class="category-header">панель управления<i class="fa fa-list"></i></span>
					<ul class="category-list">
						
						<li><a href="index1.php?view_orders">Просмотреть активные заказы</a></li>
						<li><a href="index1.php?view_orders_history">История все заказов</a></li>
						<li><a href="index1.php?customers_list">Клиенты</a></li>
						<li><a href="index1.php?view_products">Просмотреть все мои товары</a></li>
						<li><a href="logout.php">Выход из системы</a></li>
					</ul>
				</div>
				<!-- /category nav -->

				
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="#">Главная</a></li>
				<li class="active">Дистрибьютер</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				

				<!-- MAIN -->
				<div id="main" class="col-md-12">
				

					<!-- STORE -->
					<div id="store">



<table width="100%" align="center" >
  <tr align="center">
    <td colspan="7"><h2> все закази </h2></td>
  </tr>
  <tr style="text-align: center;">
    <th >S/N</th>
    <th>Имя Клиента</th>
    <th>наименование товара</th>
    <th>Цена</th>
    <th>Количество</th>
    <th>Дата заказа</th>
    <th>действие</th>

    
  </tr>
      <?php

      

       include("inc/db.php");
        

      $i=0;
     // this is for order details

       if (isset($_SESSION['distributor_id'])) {
         
       

       $dist_id= $_SESSION['distributor_id'];

       $total = 0;
         $get = "select 

                     com.name as company_name,
                     so.registration_date as order_date,
                     c.name as customer_name,
                     ct.email as customer_email,
                     ct.telephone as customer_telephone,
                     r.name as customer_region,
                     st.name as street_name,
                     ad.index_code as index_code,
                     ad.building as building,
                     ad.house as house,
                     p.name as product_name,
                     p.price as price,
                     p.manufacturer as manufacturer,
                     p.expires as expires,
                     pt.quantity as quantity,
                     pt.id as product_item,
                     ct.telephone as telephone,
                     crt.id as cart_id,
                     pt.id as product_id,
                     pt.onscreen_status as status




                  from 
                       distributor d
                       
                       join company com on com.id = d.company_id
                       join product p on p.distributor_id = d.id
                       join product_item pt on pt.product_id = p.id
                       join simple_order so on so.cart_id = pt.cart_id

                       join cart crt on crt.id = so.cart_id
                      
                       join customer c on c.id = crt.customer_id
                       join region r on r.id = c.region_id
                       join address ad on ad.id = c.address_id
                       join contact ct on ct.id = c.contact_id
                       join street st on st.id = ad.street_id


                  where d.id = '$dist_id' ";

                  $run = mysqli_query($con, $get);

                 


                 while($rows = mysqli_fetch_array($run)) {
                   $cart_id = $rows['cart_id'];
                   $status = $rows['status'];
                  $order_date = $rows['order_date'];
                  $customer_name = $rows['customer_name'];
                  
                  $product_name = $rows['product_name'];
                  $pro_item_id = $rows['product_id'];
                  
                  $product_price = $rows['price'];
                  $quantity = $rows['quantity'];


                                $i++;
                      
               
           
                              
     ?>

      <tr align="center">
            <td><?php echo $i;  ?></td>
            <td><?php echo $customer_name; ?></td>
            <td><?php echo $product_name; ?></td>
            <td><?php echo $product_price; ?></td>
            <td><?php echo $quantity; ?></td>  
            <td><?php echo $order_date; ?></td> 
           
            
            
            <th><?php echo $status; ?></th>
      </tr>


<?php } }?> 

</table>
<br>
<br>





						<!-- row -->
						<div class="row"><br><br>
							<h2 style="color: #800080; text-align: center;"><?php  echo @$_GET['logged_in']; ?></h2>


							<?php

							  
							  if (isset($_GET['view_orders'])) {
							  	include("view_orders.php");
							  }

							  
							  if (isset($_GET['view_orders_history'])) {
							  	include("view_orders_history.php");
							  }

							   if (isset($_GET['view_products'])) {
							  	include("view_products.php");
							  }

							    if (isset($_GET['check_order'])) {
							  	include("view_order_cust.php");
							  }

							    if (isset($_GET['check_order_history'])) {
							  	include("view_order_cust_history.php");
							  }

							  if (isset($_GET['customer_details'])) {
							  	include("customer_details.php");
							  }

							    if (isset($_GET['customers_list'])) {
							  	include("customers_list.php");
							  }



							?>
							


						</div>
						<!-- /row -->
					</div>
					<!-- /STORE -->

					
				</div>
				<!-- /MAIN -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<?php include("inc/footer1.php")  ?>

	<?php } ?>

	
<?php
	include("inc/db.php");

if (isset($_GET['seen_order'])) {
  
  $get_id = $_GET['seen_order'];

  $status = 'Смотрел';

   
   $update_product_item = "update product_item set onscreen_status= '$status' where id = '$get_id'";
   $run = mysqli_query($con,$update_product_item);


  if($run){
    echo "<script>alert('Order was Updated')</script>";
    echo "<script>window.open('index.php?view_orders','_self')</script>";
  }
  


}
?>

<?php
	include("inc/db.php");

if (isset($_GET['confirm_order'])) {
  
  $get_id = $_GET['confirm_order'];

  $status = 'Принял';

 
   $update_product_item = "update product_item set onscreen_status= '$status' where id = '$get_id'";
   $run = mysqli_query($con,$update_product_item);

   

  if($run){
    echo "<script>alert('Order was Updated')</script>";
    echo "<script>window.open('index.php?view_orders','_self')</script>";
  }


}
?>

<?php
	include("inc/db.php");

if (isset($_GET['reject_order'])) {
  
  $get_id = $_GET['reject_order'];

  $status = 'Отказ';



   $update_product_item = "update product_item set onscreen_status= '$status' where id = '$get_id'";
   $run = mysqli_query($con,$update_product_item);

  if($run){
    echo "<script>alert('Order was Updated')</script>";
    echo "<script>window.open('index.php?view_orders','_self')</script>";
  }


}
?>


