<?php  
session_start();
include("inc/db.php");
include("inc/functions.php");
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


	<!--table resp-->
	<link rel="stylesheet" href="css/rwd-table.min.css?v=5.3.1">
	<link rel="stylesheet" href="css/docs.min.css?v=5.3.1">
    <link type="text/css" rel="stylesheet" href="css/checkout_style.css" />

	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-19870163-1']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>

</head>

<body>
	<!-- HEADER -->



	<?php include("inc/header.php");

	?>

	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- category nav -->
				<div class="category-nav show-on-click">
					<?php include("inc/menu.php")  ?>
				</div>
			</div>
			<!-- /container -->
		</div>
		<!-- /NAVIGATION -->

		<!-- BREADCRUMB -->
		<div id="breadcrumb">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="../optimum_beauty.php">Home</a></li>
					<li class="active">Products of This Sub category</li>
				</ul>
			</div>
		</div>
		<!-- /BREADCRUMB -->

		<!-- HOME -->
		<div id="home"  >
			<!-- container -->
			<div class="container" style="min-height: 600px;" >
				<!-- home wrap -->
				<div class="home-wrap">
					<!-- home slick -->
					<div >

						<?php  cart();?>
						<!-- banner -->
						<div class="banner banner-1">
							<div class="table-responsive" data-pattern="priority-columns">
								<table cellspacing="0" id="group-test" class="table table-small-font table-bordered table-striped">
									<thead>
										<tr >

											<th colspan="1" data-priority="1">Дистрибьютор</th>

											<th colspan="1" data-priority="2">Найменование</th>
											<th colspan="1" data-priority="3">Производитель/<br>Страна производства</th>
											<th colspan="1" data-priority="4">Цена</th>
											<th colspan="1" data-priority="5">Годен до</th>
											<th colspan="1" data-priority="6">Остаток</th>
											<th colspan="1" data-priority="7">Примечание</th>


										</tr>
										<?php

										 global $con;

											$user = $_SESSION['customer_email'];

											$get_c = "select *from customers where customer_email = '$user' ";

											$run_c = mysqli_query($con, $get_c);

											$row_c = mysqli_fetch_array($run_c);

											$c_id = $row_c['customer_id'];
												
										if (isset($_GET['allpar'])) {


											$allpar_id = $_GET['allpar'];

											

											$get_allpar_pro = "select * from products p 

												join distributors d on p.dist_id = d.dist_id 
												join customers c on d.region_id = c.region_id 
												where c.customer_id = $c_id AND product_cat='$allpar_id'";
											$run_allpar_pro = mysqli_query($con, $get_allpar_pro);

											$count_allpar = mysqli_num_rows($run_allpar_pro);
											if ($count_allpar == 0) {
												echo "<h2 style='text-align:center;'>'Нет продукта'</h2>";
											}else{

												while($row_allpar_pro=mysqli_fetch_array($run_allpar_pro)){
													$pro_id = $row_allpar_pro['product_id'];
													$pro_cat = $row_allpar_pro['product_cat'];
													$pro_sub_cat = $row_allpar_pro['product_sub_cat'];
													$pro_reg = $row_allpar_pro['region_id'];
													$pro_dist = $row_allpar_pro['dist_id'];
													$pro_name = $row_allpar_pro['product_title'];
													$pro_price = $row_allpar_pro['product_price'];
													$pro_manu = $row_allpar_pro['product_manu'];
													$pro_desc = $row_allpar_pro['product_desc'];
													$pro_min_order = $row_allnail_pro['min_order'];
													$pro_dist = $row_allnail_pro['dist_id'];


													$get_dist = "select * from distributors where dist_id = '$pro_dist'";

													$run_dist = mysqli_query($con, $get_dist);

													$row_dist = mysqli_fetch_array($run_dist);

													$dist_name = $row_dist['dist_name'];



													?>

													<tr>
														<th data-priority="1" style="background: white; color: #400040;"><?php echo $dist_name ?></th>
														<th data-priority="2" style="background: white; color: #400040;"><a href="../details.php?pro_id=<?php  echo $pro_id ?>"><?php echo $pro_name ?></a></th>
														<th data-priority="3"style="background: white; color: #400040;"><?php echo $pro_manu ?></th>
														<th data-priority="4" style="background: white; color: #400040;"><?php echo $pro_price ?></th>

														<th data-priority="5" style="background: white; color: #400040;">0</th>
														<th data-priority="6" style="background: white; color: #400040;"><?php echo $pro_min_order ?></th>
														<th data-priority="7" style="background: white; color: #400040;"><?php echo $pro_desc ?></th>



													</tr>
												</thead>


											<?php } } } ?>	

										</table>
									</div>	




								</div>
								<br>

							</div>
							<!-- /section -->
						</div>
						<!-- /row -->
					</div>
					<!-- /container -->
				</div>
				<!-- /section -->

				<?php  include("inc/footer1.php"); ?>