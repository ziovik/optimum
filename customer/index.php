

<!DOCTYPE html>
<?php  
       session_start();
       include("inc/db.php");
       include("inc/functions.php");
?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>OPTIMUM BEAUTY</title>

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
	<link type="text/css" rel="stylesheet" href="css/checkout_style.css" />
	<link type="text/css" rel="stylesheet" href="css/book.css" />

	

</head>

<body>
	<!-- HEADER -->
	
		

		<?php include("inc/header.php");?>

       
      

	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- category nav -->
				<div class="category-nav show-on-click">
					<span class="category-header">My Account <i class="fa fa-list"></i></span>
					<ul class="category-list">
						<?php
                           $customer_id = $_SESSION['id'];

                           $get_customer = "select 
                                                c.name as customer_name,
                                                r.name as region_name,
                                                a.index_code as index_code,
                                                a.building as building,
                                                a.house as house,
                                                con.email as email,
                                                con.telephone as telephone,
                                                s.name as street_name
                                            from customer c
	                                            join region r on r.id = c.region_id
	                                            join address a on a.id = c.address_id 
	                                            join street s on s.id =a.street_id
	                                            join contact con on con.id = c.contact_id
                                            where  c.id = '$customer_id' ";
											
									
										
							$run_name = mysqli_query($con, $get_customer);

						    $row = mysqli_fetch_array($run_name);

						    $customer_name = $row['customer_name'];
						    $region_name = $row['region_name'];
						    $building = $row['building'];
						    $index_code = $row['index_code'];
						    $house= $row['house'];
						    $email = $row['email'];
						    $telephone = $row['telephone'];
						    $street_name = $row['street_name'];


						?>


						<li><a href="my_account.php?active_orders">Активный заказа  <i class="fa fa-spinner fa-spin" style="font-size:24px"></i></a></li>
						<li><a href="my_account.php?my_history">История заказов  <i class="fa fa-history" style="font-size:26px"></i></a></li>
						<li><a href="logout.php">Выити  <i class="fa fa-sign-out" style="font-size:24px"></i></a></li>
						
						

						
					</ul>
				</div>
				<!-- /category nav -->

				<!-- menu nav -->
				<div class="menu-nav">
					<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
					<ul class="menu-list">
					
					</ul>
				</div>
				<!-- menu nav -->
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="../optimum_beauty.php">Главная</a></li>
				<li class="active">Личный Кабинет</li>
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
				<!-- section -->
	<div class="section">
		
		
		<h2 style="text-align: center;">Добро пожаловать : <?php echo $customer_name;  ?></h2>

		<div style=" margin-left: auto;margin-right: auto; width: 28%;">

   
			<div id="wrapper" >
			<div id="swipe-container">
				<div id="articles" class="parent-transform transform-hook" style="max-height: 300px;">
					<section class="page nav-state">
						<h2 style="padding-bottom: 0px;color: #800080;">Контактное лицо</h2><hr>
						<p style="text-align: center;"><?php echo $customer_name;  ?></p>
						<p style="text-align: center;">(<?php echo $telephone; ?>)</p>
					</section>
				</div>
				<div id="projects" class="parent-transform">
					<section class="page nav-state">
						<h2 style="text-align: center;color: #800080;">Мой Адрес</h2>
						<p ><b style="text-align: center; ">Регион :</b>  <?php echo $region_name;  ?></p><br>
						<p >  <?php echo $region_name;  ?>, <?php echo $street_name;  ?>, <?php echo $building;  ?>, <?php echo $index_code;  ?>  </p><br>
						



					</section>
				</div>
				<div id="downloads" class="parent-transform">
					<section class="page nav-state">
						<h2 style="text-align: center;color: #800080;">Чем занимаемся</h2>
					</section>
				</div>
				
			</div>
		</div>
		
		</div>
		

		<?php

							
				  if (isset($_GET['my_orders'])) {
				  	include("my_orders.php");
				  }
				   if (isset($_GET['my_history'])) {
				  	include("my_history.php");
				  }
				   if (isset($_GET['active_orders'])) {
				  	include("active_orders.php");
				  }
				  
		?>
		
	</div>
	<!-- /section -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<?php  include("inc/footer1.php"); ?>


