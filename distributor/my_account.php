
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

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- HEADER -->
	
		

		<?php include("db.php");?>

       
       <header>
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="pull-left">
					<?php

					if (isset($_SESSION['dist_email'])) {
						echo "<span>Welcome to OPTIMUM BEAUTY   :    </span>". $_SESSION['dist_email'] ."<span></span>";
					
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
								<strong class="text-uppercase">My Account <i class="fa fa-caret-down"></i></strong>
							</div>
							<?php

                                            if (!isset($_SESSION['dist_email'])) {
                                            	echo "<a href='dist_login.php'>Login</a>";
                                            }
                                            else{
                                            	echo "<a href='logout.php' class='text-uppercase'>Logout</a> ";

                                            }
                                         
						     ?>
							
							<ul class="custom-menu">
								<li><a href="my_account.php"><i class="fa fa-user-o"></i> My Account</a></li>
								
								<li><a href="../order.php"><i class="fa fa-check"></i> Checkout</a></li>
								<li><a href="../dist_login.php"><i class="fa fa-unlock-alt"></i> Login</a></li>
								
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
					<span class="category-header">My Account <i class="fa fa-list"></i></span>
					<ul class="category-list">
						<?php
                           $dist = $_SESSION['dist_email'];

                           $get_img = "select *from distributors where dist_email = '$dist' ";

                           $run_img = mysqli_query($con, $get_img);

                           $row_img = mysqli_fetch_array($run_img);

                           $d_image = $row_img['dist_image'];
                           $d_name = $row_img['dist_name'];

                           echo "
                                <img src='distributor_images/$d_image'  width='268px' height='150px' style='align:center;' />
                           ";

						?>


						<li><a href="my_account.php?orders">Orders</a></li>
						<li><a href="my_account.php?my_info">My Information</a></li>
						<li><a href="my_account.php?view_client">View Clients</a></li>

						
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
		
		
		<h2 style="text-align: center;">Welcome : <?php echo $d_name;  ?></h2>
		<p style="text-align: center;">You can see  orders progress by clicking <a href="my_account.php?my_orders"><b>HERE</b></a></p>
		
		
	</div>
	<!-- /section -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<?php  include("inc/footer1.php"); ?>


<?php
	include("inc/db.php");

if (isset($_GET['seen_order'])) {
  
  $get_id = $_GET['seen_order'];

  $status = 'Смотрел';

  $update_order = "update cart set cart_status = '$status' where cart_id = '$get_id'";

  $run_update = mysqli_query($con,$update_order);

  if($run_update){
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

  $update_order = "update cart set cart_status = '$status' where cart_id = '$get_id'";

  $run_update = mysqli_query($con,$update_order);

  if($run_update){
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

  $update_order = "update cart set cart_status = '$status' where cart_id = '$get_id'";

  $run_update = mysqli_query($con,$update_order);

  if($run_update){
    echo "<script>alert('Order was Updated')</script>";
    echo "<script>window.open('index.php?view_orders','_self')</script>";
  }


}
?>
	