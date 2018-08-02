<?php

session_start();

if (!isset($_SESSION['dist_email'])) {
	echo "<script>window.open('login.php?not_dist=You are not an Distributor!','_self')</script>";
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

	

</head>

<body>
	<?php include("db.php");

       ?>
<header>
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="pull-left">
					<?php

					if (isset($_SESSION['dist_email'])) {
						echo "<span>Welcome to OPTIMUM BEAUTY   :    </span>". $_SESSION['dist_email'] ."<span></span>";
					}else{
						echo "<b>Welcome Guest</b>";
					}

					?>
					
				</div>
				<div class="pull-right">
					
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
								<strong class="text-uppercase"> My Account <i class="fa fa-caret-down"></i></strong>
							</div>
							<?php

                                            if (!isset($_SESSION['dist_email'])) {
                                            	echo "<a href='my_account.php'>Login</a>";
                                            }
                                            else{
                                            	echo "<a href='logout.php' class='text-uppercase'>Logout</a> ";

                                            }
                                         
						     ?>
							
							<ul class="custom-menu">
								<li><a href="my_account.php"><i class="fa fa-user-o"></i> My Account</a></li>
								
								<li><a href="#"><i class="fa fa-unlock-alt"></i> Login</a></li>
								<li><a href="#"><i class="fa fa-user-plus"></i> Create An Account</a></li>
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
					<span class="category-header">Manage Content<i class="fa fa-list"></i></span>
					<ul class="category-list">
						
						<li><a href="index.php?view_orders">View All Orders</a></li>
						
						
						<li><a href="index.php?view_products">View All my Products</a></li>
						<li><a href="logout.php">Distributor Logout</a></li>
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
				<li><a href="#">Home</a></li>
				<li class="active">Distributor</li>
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
						<!-- row -->
						<div class="row"><br><br>
							<h2 style="color: #800080; text-align: center;"><?php  echo @$_GET['logged_in']; ?></h2>


							<?php

							  
							  if (isset($_GET['view_orders'])) {
							  	include("view_orders.php");
							  }

							  
							   if (isset($_GET['view_products'])) {
							  	include("view_products.php");
							  }
							    if (isset($_GET['check_order'])) {
							  	include("view_order_cust.php");
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

if (isset($_GET['confirm_order'])) {
  
  $get_id = $_GET['confirm_order'];

  $status = 'Completed';

  $update_order = "update orders set status = '$status' where order_id = '$get_id'";

  $run_update = mysqli_query($con,$update_order);

  if($run_update){
    echo "<script>alert('Order was Updated')</script>";
    echo "<script>window.open('index.php?view_orders','_self')</script>";
  }


}
?>