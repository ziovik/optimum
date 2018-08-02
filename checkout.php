
<!DOCTYPE>
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

	<title>OPTIMUM BEAUTY | ЗАКАЗЫ</title>

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
	

</head>

<body>
	<!-- HEADER -->
	
		

		<header>
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="pull-left">
					<?php

					if (isset($_SESSION['customer_email'])) {
						$user = $_SESSION['customer_email'];

						$get_info = "select * from customers where customer_email = '$user' ";

						$run_info = mysqli_query($con, $get_info);

						$row_info = mysqli_fetch_array($run_info);
							$customer_name = $row_info['customer_name'];
						echo "<span>Добро пожаловать  в OPTIMUM BEAUTY   :    </span>". $row_info['customer_name'] ."<span></span>";

						echo "<span>   :    </span>". $_SESSION['customer_email'] ."<span></span>";
					}else{
						echo "<b>Добро пожаловать Гость</b>";
					}

				    

					?>
					
				</div>
				<div class="pull-right">
					<ul class="header-top-links">
						
				<?php

				if (!isset($_SESSION['customer_email'])) {
					echo "<button style='width:100px;' background:#800080; border-radius:5px;' class='btn next-btn'><a href='checkout.php' class='text-uppercase' style='color:#fff;'>Войти</a></buuton>";
				}
				else{
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
						<a class="logo" href="optimum_beauty.php">
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
								<strong >Личный кабинет <i class="fa fa-caret-down"></i></strong>
							</div>
							
							
							<ul class="custom-menu">
								<li><a href="customer/my_account.php"><i class="fa fa-user-o"></i> Личный кабинет</a></li>
								
								<li><a href="checkout.php"><i class="fa fa-check"></i> Checkout</a></li>
								<li><a href="customer_login.php"><i class="fa fa-unlock-alt"></i> Войти</a></li>
								
							</ul>
						</li>
						<!-- /Account -->

						<!-- Cart -->
						<li class="header-cart dropdown default-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-shopping-cart"></i>
									<span class="qty"><?php total_items();  ?></span>
								</div>
								<strong class="text-uppercase">Заказы:</strong>
								<br>
								<span><?php total_price() ?></span>
							</a>
							<div class="custom-menu">
								<div id="shopping-cart">
									<div class="shopping-cart-list">
										
									</div>
									<div class="shopping-cart-btns">
										<a href="cart.php"><button class="main-btn">Мои заказы</button></a>
										<button class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i></button>


									</div>
								</div>
							</div>
						</li>
						<!-- /Cart -->

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
					
					<?php include("inc/menu.php"); ?>
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="optimum_beauty.php">Главная</a></li>
				<li class="active">Checkout</li>
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

		<?php

		  if (!isset($_SESSION['customer_email'])) {
		  	include("customer_login.php");
		  }
		  else{
		  	include("customer/index.php");
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