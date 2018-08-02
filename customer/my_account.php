
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
                           $user = $_SESSION['customer_email'];

                           $get_img = "select *from customers where customer_email = '$user' ";

                           $run_img = mysqli_query($con, $get_img);

                           $row_img = mysqli_fetch_array($run_img);

                           $c_image = $row_img['customer_image'];
                           $c_name = $row_img['customer_name'];

                           echo "
                                <img src='customer_images/$c_image'  width='268px' height='150px' style='align:center;' />
                           ";

						?>


						<li><a href="my_account.php?my_orders">My Orders</a></li>
						<li><a href="my_account.php?my_info">My Information</a></li>
						<li><a href="my_account.php?view_dist">View Distributors</a></li>

						
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
				<li><a href="index.php">Home</a></li>
				<li class="active">My Account</li>
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
		
		
		<h2 style="text-align: center;">Welcome : <?php echo $c_name;  ?></h2>
		<p style="text-align: center;">You can see your orders progress by clicking <a href="my_account.php?my_orders"><b>HERE</b></a></p>

		<?php

							
							  if (isset($_GET['my_orders'])) {
							  	include("my_orders.php");
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



	