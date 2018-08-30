<?php
session_start();
include("inc/db.php");
include("inc/functions.php");
//for not acceessing this page by another person who is not in admin


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title> OPTIMUM BEAUTY|DETAILS</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css"/>
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css"/>
	<link type="text/css" rel="stylesheet" href="css/checkout_style.css"/>


</head>

<body>
<!-- HEADER -->
<?php include("inc/db.php");

?>
<header>
	<!-- top Header -->
	<div id="top-header">
		<div class="container">
			<div class="pull-left">
				<?php

				if (isset($_SESSION['customer_id'])) {
					include("inc/db.php");
					$customer_id = $_SESSION['customer_id'];

					$get_info = "select
                                         name from customer 
                                    where  id = '$customer_id' ";

					$run_name = mysqli_query($con, $get_info);

					$row = mysqli_fetch_array($run_name);

					$customer_name = $row['name'];

					echo "<span>Добро пожаловать  в OPTIMUM BEAUTY   :    </span>" . $customer_name . "<span></span>";


				} else {
					echo "<b>Добро пожаловать Гость</b>";
				}

				?>

			</div>
			<div class="pull-right">
				<ul class="header-top-links">
					<?php

					if (!isset($_SESSION['customer_id'])) {
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
					<a class="logo" href="optimum_beauty.php">
						<img src="../img/logo.png" alt="">
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
							<strong>личный кабинет <i class="fa fa-caret-down"></i></strong>
						</div>


						<ul class="custom-menu">
							<li><a href="customer/index.php"><i class="fa fa-user-o"></i> личный кабинет</a></li>

							<li><a href="checkout.php"><i class="fa fa-check"></i> Checkout</a></li>
							<li><a href="customer/customer_login.php"><i class="fa fa-unlock-alt"></i> Login</a></li>

						</ul>
					</li>
					<!-- /Account -->

					<!-- Cart -->
					<li class="header-cart dropdown default-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
							<div class="header-btns-icon">
								<i class="fa fa-shopping-cart"></i>
								<span class="qty"><?php total_items(); ?></span>
							</div>
							<strong class="text-uppercase">Мои заказы:</strong>
							<br>
							<span><?php total_price() ?></span>
						</a>
						<div class="custom-menu">
							<div id="shopping-cart">
								<div class="shopping-cart-list">

								</div>
								<div class="shopping-cart-btns">
									<a href="cart.php">
										<button class="main-btn">заказы</button>
									</a>
									<button class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i>
									</button>


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
<!-- /HEADER -->

<!-- NAVIGATION -->
<div id="navigation">
	<!-- container -->
	<div class="container">
		<div id="responsive-nav">
			<!-- category nav -->
			<div class="category-nav">
				<span class="category-header">Категории <i class="fa fa-list"></i></span>
				<ul class="category-list">
					<li class="dropdown side-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="cosm">Косметология
							<i class="fa fa-angle-right"></i></a>
						<div class="custom-menu">
							<div class="row">
								<div class="col-md-4">
									<ul class="list-links">
										<li><h3 class="list-links-title"><a href="products/allcosm.php?allcosm=1"
																			name="allcosm">Косметология</a></h3></li>

										<?php
										if (!isset($_GET['cosm'])) {


											$get_cosm = "select * from sub_category where category_id='1'";

											$run_cosm = mysqli_query($con, $get_cosm);


											while ($row_cosm = mysqli_fetch_array($run_cosm)) {

												$cosm_id = $row_cosm['id'];
												$cosm_name = $row_cosm['name'];

												echo " <li style='width:300px;'><a href='products/cosm.php?cosm=$cosm_id'>$cosm_name</a></li>";

											}


										}
										?>
									</ul>
									<hr class="hidden-md hidden-lg">
								</div>


							</div>
					</li>

					<li class="dropdown side-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="depil">Депиляция <i
									class="fa fa-angle-right"></i></a>
						<div class="custom-menu">
							<div class="row">
								<div class="col-md-4">
									<ul class="list-links">

										<?php
										if (!isset($_GET['depil'])) {


											$get_depils = "select * from sub_category where category_id='2' ";
											$run_depils = mysqli_query($con, $get_depils);

											while ($row_depils = mysqli_fetch_array($run_depils)) {
												$depil_id = $row_depils['id'];
												$depil_name = $row_depils['name'];

												echo " <li style='width:300px;'><a href='products/depil.php?depil=$depil_id'>$depil_name</a></li>";
											}
										}
										?>


									</ul>
									<hr class="hidden-md hidden-lg">
								</div>


							</div>
					</li>

					<li class="dropdown side-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="solar">Солярий <i
									class="fa fa-angle-right"></i></a>
						<div class="custom-menu">
							<div class="row">
								<div class="col-md-4">
									<ul class="list-links">

										<?php
										if (!isset($_GET['solar'])) {


											$get_solars = "select * from sub_category where category_id='3' ";
											$run_solars = mysqli_query($con, $get_solars);

											while ($row_solars = mysqli_fetch_array($run_solars)) {
												$solar_id = $row_solars['id'];
												$solar_name = $row_solars['name'];

												echo " <li style='width:300px;'><a href='products/solar.php?solar=$solar_id'>$solar_name</a></li>";
											}
										}
										?>


									</ul>
									<hr class="hidden-md hidden-lg">
								</div>


							</div>
					</li>

					<li class="dropdown side-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="massag">Массаж <i
									class="fa fa-angle-right"></i></a>
						<div class="custom-menu">
							<div class="row">
								<div class="col-md-4">
									<ul class="list-links">

										<?php
										if (!isset($_GET['massag'])) {


											$get_massags = "select * from sub_category where category_id='4' ";
											$run_massags = mysqli_query($con, $get_massags);

											while ($row_massags = mysqli_fetch_array($run_massags)) {
												$massag_id = $row_massags['id'];
												$massag_name = $row_massags['name'];

												echo " <li style='width:300px;'><a href='products/massag.php?massag=$massag_id'>$massag_name</a></li>";
											}
										}
										?>


									</ul>
									<hr class="hidden-md hidden-lg">
								</div>


							</div>
					</li>


					<li class="dropdown side-dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
														  aria-expanded="true" name="par">Парикмахерская Продукция <i
									class="fa fa-angle-right"></i></a>
						<div class="custom-menu">
							<div class="row">
								<div class="col-md-4">
									<ul class="list-links">
										<li>
											<h3 class="list-links-title" style="width: 300px;"><a
														href="products/allparak.php?allpar=5" name="allnail">Парикмахерская
													Продукция</a></h3></li>
										<?php
										if (!isset($_GET['par'])) {

											$get_pars = "select * from sub_category where category_id='5' ";
											$run_pars = mysqli_query($con, $get_pars);

											while ($row_pars = mysqli_fetch_array($run_pars)) {
												$par_id = $row_pars['id'];
												$par_name = $row_pars['name'];


												echo " <li style='width:300px;'><a href='products/parak.php?par=$par_id'>$par_name</a></li>";
											}
										}
										?>

									</ul>
									<hr>

									<hr class="hidden-md hidden-lg">
								</div>


							</div>
					</li>

					<li class="dropdown side-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="nail">Ногтевой
							сервис <i class="fa fa-angle-right"></i></a>
						<div class="custom-menu">
							<div class="row">
								<div class="col-md-4">
									<ul class="list-links">
										<li>
											<h3 class="list-links-title"><a href="products/allnail.php?allnail=6"
																			name="allnail">Ногтевой сервис</a></h3></li>

										<?php
										if (!isset($_GET['nail'])) {


											$get_nails = "select * from sub_category where category_id='6' ";
											$run_nails = mysqli_query($con, $get_nails);

											while ($row_nails = mysqli_fetch_array($run_nails)) {
												$nail_id = $row_nails['id'];
												$nail_name = $row_nails['name'];

												echo " <li style='width:300px;'><a href='products/nail.php?nail=$nail_id'>$nail_name</a></li>";
											}
										}
										?>

									</ul>
									<hr>

									<hr class="hidden-md hidden-lg">
								</div>


							</div>
						</div>
					</li>

					<li class="dropdown side-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="eye">Ресницы и
							брови<i class="fa fa-angle-right"></i></a>
						<div class="custom-menu">
							<div class="row">
								<div class="col-md-4">
									<ul class="list-links">
										<li>
											<h3 class="list-links-title"><a href="products/alleye.php?alleye=7"
																			name="allnail">Ресницы и брови</a></h3></li>

										<?php
										if (!isset($_GET['eye'])) {


											$get_eye = "select * from sub_category where category_id='7' ";
											$run_eye = mysqli_query($con, $get_eye);

											while ($row_eye = mysqli_fetch_array($run_eye)) {
												$eye_id = $row_eye['id'];
												$eye_name = $row_eye['name'];

												echo " <li style='width:300px;'><a href='products/eye.php?eye=$eye_id'>$eye_name</a></li>";
											}
										}
										?>

									</ul>
									<hr class="hidden-md hidden-lg">
								</div>

							</div>

						</div>
					</li>
					<li class="dropdown side-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="viz">Визаж<i
									class="fa fa-angle-right"></i></a>
						<div class="custom-menu">
							<div class="row">
								<div class="col-md-4">
									<ul class="list-links">
										<li>
											<h3 class="list-links-title"><a href="products/allviz.php?allviz=8"
																			name="allviz">Визаж</a></h3></li>
										<?php
										if (!isset($_GET['viz'])) {


											$get_viz = "select * from sub_category where category_id='8' ";
											$run_viz = mysqli_query($con, $get_viz);

											while ($row_viz = mysqli_fetch_array($run_viz)) {
												$viz_id = $row_viz['id'];
												$viz_name = $row_viz['name'];

												echo " <li style='width:500px;'><a href='products/viz.php?viz=$viz_id'>$viz_name</a></li>";
											}
										}
										?>
									</ul>
									<hr class="hidden-md hidden-lg">
								</div>

							</div>

						</div>
					</li>
					<li class="dropdown side-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="tatu">Татуаж и
							пирсинг<i class="fa fa-angle-right"></i></a>
						<div class="custom-menu">
							<div class="row">
								<div class="col-md-4">
									<ul class="list-links">

										<li>
											<h3 class="list-links-title"><a href="products/alltatu.php?alltatu=9"
																			name="alltatu">Татуаж и пирсинг</a></h3>
										</li>
										<?php
										if (!isset($_GET['tatu'])) {


											$get_tatu = "select * from sub_category where category_id='9' ";
											$run_tatu = mysqli_query($con, $get_tatu);

											while ($row_tatu = mysqli_fetch_array($run_tatu)) {
												$tatu_id = $row_tatu['id'];
												$tatu_name = $row_tatu['name'];

												echo " <li style='width:500px;'><a href='products/tatu.php?tatu=$tatu_id'>$tatu_name</a></li>";
											}
										}
										?>
									</ul>
									<hr class="hidden-md hidden-lg">
								</div>

							</div>

						</div>
					</li>
					<li class="dropdown side-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="mat">Расходники<i
									class="fa fa-angle-right"></i></a>
						<div class="custom-menu">
							<div class="row">
								<div class="col-md-4">
									<ul class="list-links">

										<li>
											<h3 class="list-links-title"><a href="products/allmat.php?allmat=10"
																			name="allmat">Расходники</a></h3></li>
										<?php
										if (!isset($_GET['mat'])) {


											$get_mat = "select * from sub_category where category_id='10' ";
											$run_mat = mysqli_query($con, $get_mat);

											while ($row_mat = mysqli_fetch_array($run_mat)) {
												$mat_id = $row_mat['id'];
												$mat_name = $row_mat['name'];

												echo " <li style='width:500px;'><a href='products/mat.php?mat=$mat_id'>$mat_name</a></li>";
											}
										}
										?>
									</ul>
									<hr class="hidden-md hidden-lg">
								</div>

							</div>

						</div>
					</li>
					<li class="dropdown side-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="ster">Стерилизация
							и дезинфекция<i class="fa fa-angle-right"></i></a>
						<div class="custom-menu">
							<div class="row">
								<div class="col-md-4">
									<ul class="list-links">

										<li style="width: 300px;">
											<h3 class="list-links-title"><a href="products/allster.php?allster=11"
																			name="allster">Стерилизация и
													дезинфекция</a></h3></li>
										<?php
										if (!isset($_GET['ster'])) {


											$get_ster = "select * from sub_category where category_id='11' ";
											$run_ster = mysqli_query($con, $get_ster);

											while ($row_ster = mysqli_fetch_array($run_ster)) {
												$ster_id = $row_ster['id'];
												$ster_name = $row_ster['name'];

												echo " <li style='width:500px;'><a href='products/ster.php?ster=$ster_id'>$ster_name</a></li>";
											}
										}
										?>
									</ul>
									<hr class="hidden-md hidden-lg">
								</div>

							</div>

						</div>
					</li>

					<li><a href="all_products.php?all_products">Все продукты</a></li>
				</ul>
			</div>
			<!-- menu nav -->
			<div class="menu-nav">
				<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
				<ul class="menu-list">

					<li id="center1"><a href="../all_products.php?all_products" title="живой пойск"></a></li>
				</ul>
			</div>
			<!-- menu nav -->
		</div>
	</div>
	<!-- /container -->
</div>
<!-- /NAVIGATION -->


<!-- HOME -->
<div id="home">
	<!-- container -->
	<div class="container" style="min-height: 600px;">

		<!-- BREADCRUMB -->
		<div id="breadcrumb">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="index.php">Главная</a></li>

					<li class="active">Подробность продуктов</li>
				</ul>
			</div>
		</div>
		<!-- /BREADCRUMB -->
		<!-- home wrap -->
		<div class="home-wrap">
			<!-- home slick -->
			<div>
				<!--  Product Details -->
				<div class="product product-details clearfix">

					<?php echo cart(); ?>


					<?php

					include("inc/db.php");

					if (isset($_GET['pro_id'])) {
						$product_id = $_GET['pro_id'];

						$get_pro = "select * from product where id='$product_id'";

						$run_pro = mysqli_query($con, $get_pro);

						while ($row_pro = mysqli_fetch_array($run_pro)) {
							$pro_id = $row_pro['id'];
							$pro_name = $row_pro['name'];
							$pro_price = $row_pro['price'];
							$pro_dist = $row_pro['distributor_id'];
							$pro_desc = $row_pro['description'];
							$min_order = $row_pro['min_order'];
							$pro_manu = $row_pro['manufacturer'];

						}

						$get_dist = "select * from company where id = '$pro_dist' ";
						$run_dist = mysqli_query($con, $get_dist);
						while ($row_dist = mysqli_fetch_array($run_dist)) {
							$dist_name = $row_dist['name'];
						}
					}
					?>


					<div class="col-md-6">
						<div class="product-body">
							<div class="product-label">
								<span>новый</span>
								<span class="sale">-20%</span>
							</div>
							<h2 class="product-name"
								style="width: 800px; font-size: 20px;"><?php echo $pro_name; ?></h2>
							<h3 class="product-price"><?php echo $pro_price; ?>руб</h3>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o empty"></i>
								</div>
								<a href="#"><?php echo $min_order; ?> order(s) / min</a>
							</div>
							<p><strong>На склад:</strong> In Stock</p>
							<p><strong>Дистрибьютор:</strong> <?php echo $dist_name; ?></p>

							<!-- adding form -->


								<div class="product-btns">
									<div class="qty-input">
										<span class="text-uppercase">Количество: </span>
										<input class="input" type="number" name="qty" >
									</div>
									<button class="primary-btn add-to-cart" name="add_cart"><i
												class="fa fa-shopping-cart"></i>
										<a style="color: #fff;"
										   href="optimum_beauty.php?add_cart=<?php echo $pro_id ?>"> Добавить в
											казине</a>
									</button>

								</div>


							<!-- end -->

						</div>
					</div>
					<div class="col-md-12">
						<div class="product-tab">
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Примечание</a></li>

								<li><a data-toggle="tab" href="#tab2">Производитель/Страна пройзводителя</a></li>
							</ul>
							<div class="tab-content">
								<div id="tab1" class="tab-pane fade in active">
									<p><?php echo $pro_desc; ?></p>
								</div>
								<div id="tab2" class="tab-pane fade in">
									<p><?php echo $pro_manu; ?></p>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- /Product Details -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->


	<?php include("inc/footer1.php"); ?>
	