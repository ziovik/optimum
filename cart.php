<?php
session_start();

include("inc/db.php");
include("inc/functions.php");


if (!isset($_SESSION['customer_id'])) {
	echo "<script>window.open('customer/customer_login.php?not_admin=You are not signed in!','_self')</script>";
} else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>OPTIMUM BEAUTY | PRODUCT</title>

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
	<link type="text/css" rel="stylesheet" href="css/table.css"/>
	<link type="text/css" rel="stylesheet" href="css/checkout_style.css"/>


	<!--table resp-->
	<link rel="stylesheet" href="css/rwd-table.min.css?v=5.3.1">
	<link rel="stylesheet" href="css/docs.min.css?v=5.3.1">

	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-19870163-1']);
		_gaq.push(['_trackPageview']);

		(function () {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();
	</script>

</head>

<body>

<!-- HEADER -->
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
							<strong>Личный кабинет <i class="fa fa-caret-down"></i></strong>
						</div>


						<ul class="custom-menu">
							<li><a href="customer/index.php"><i class="fa fa-user-o"></i> Личный кабинет </a></li>

							<li><a href="../chechout.php"><i class="fa fa-check"></i> Checkout</a></li>
							<li><a href="customer/customer_login.php"><i class="fa fa-unlock-alt"></i>Выити</a></li>

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
							<strong class="text-uppercase">My Cart:</strong>
							<br>
							<span><?php total_price() ?></span>
						</a>
						<div class="custom-menu">
							<div id="shopping-cart">
								<div class="shopping-cart-list">

								</div>
								<div class="shopping-cart-btns">
									<a href="cart.php">
										<button class="main-btn">View Cart</button>
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
			<div class="category-nav show-on-click">
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
																			name="allcosm">Косметология</a></h3>
										</li>

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
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="depil">Депиляция
							<i class="fa fa-angle-right"></i></a>
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
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="solar">Солярий
							<i class="fa fa-angle-right"></i></a>
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
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="massag">Массаж
							<i class="fa fa-angle-right"></i></a>
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
														  aria-expanded="true" name="par">Парикмахерская Продукция
							<i class="fa fa-angle-right"></i></a>
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
																			name="allnail">Ногтевой сервис</a></h3>
										</li>

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
																			name="allnail">Ресницы и брови</a></h3>
										</li>

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

					<li id="center1"><a href="all_products.php?all_products" title="живой пойск"></a></li>
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
			<li class="active">Cart</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<div style="clear:both"></div>
		<br/>
		<h3>Детали заказа</h3>
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th width="40%">Наименование продукта</th>
					<th width="10%">Количество</th>
					<th width="20%">Цена (руб.)</th>
					<th width="15%">Всего (руб.)</th>
					<th width="5%">Действие</th>
				</tr>
				<?php

				$total = 0;

				$items = db_get_items_from_active_cart($_SESSION['customer_id']);
				foreach ($items as $item) {
					$total += $item->quantity * $item->product_price;
					?>
					<tr>
						<td><?php echo $item->product_name; ?></td>
						<td><?php echo $item->quantity; ?></td>
						<td><?php echo $item->product_price; ?></td>
						<td><?php echo $item->quantity * $item->product_price; ?></td>
						<td>
							<button class="btn btn-danger"
									onclick="deleteProductFromCart(<?php echo $item->id ?>)">Удалить
							</button>
						</td>
					</tr>
					<?php
				} ?>

				<tr>
					<td colspan="3" align="right">Итого:</td>
					<td align="right"><?php echo number_format($total, 2); ?> руб.</td>
					<td></td>
				</tr>
			</table>
		</div>
		<br><br>
		<hr>
		<!-- row -->
		<div class="row">

			<!-- section -->
			<div class="section">


				<button><a href="payment.php">CheckOut</a></button>


				<br>

			</div>
			<!-- /section -->
		</div>
		<!-- /row -->

	</div>
	<!-- /container -->
</div>
<!-- /section -->

<?php include("inc/footer1.php"); ?>
<?php } ?>
<script>
	function deleteProductFromCart(id) {
		if (!confirm('Вы действительно хотите удалить продукт из корзины?')) {
			return;
		}

		let message = {'id': id};

		$.ajax({
			method: 'POST',
			url: 'customer/handlers/requests_handler.php?action=delete_product_from_cart',
			data: JSON.stringify(message),
			success() {
				window.open("cart.php", "_self");
				alert('Продукт был удален из корзины');
			}
		});
	}
</script>
</body>
</html>
