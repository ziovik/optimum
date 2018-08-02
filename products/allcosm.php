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
    <link type="text/css" rel="stylesheet" href="css/checkout_style.css" />



	<!--table resp-->
	<link rel="stylesheet" href="css/rwd-table.min.css?v=5.3.1">
	<link rel="stylesheet" href="css/docs.min.css?v=5.3.1">

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
	<?php include("inc/header.php");?>
	<!-- /HEADER -->


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
					<li class="active">Products of Косметология</li>
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
                                        echo 'Daniels code is a disaster';
/*

										global $con;

										echo 'Hello';

										$login = $_SESSION['login'];

										$get_c = "select 
                                                      cc.id
                                                  from credentials c 
                                                       join customer cc on cc.credentials_id = c.id
                                                  where login = '$login' ";

										$run_c = mysqli_query($con, $get_c);

										$row_c = mysqli_fetch_array($run_c);

										$c_id = $row_c['id'];



										if (isset($_GET['allcosm'])) {
											$allcosm_id = $_GET['allcosm'];

											$get_allcosm_pro = "
                                                                select
                                                                    p.id as product_id,
                                                                    p.name as product_name,
                                                                    p.manufacturer as product_manufacturer,
                                                                    p.price as product_price,
                                                                    cm.name
                                                                from 
                                                                    store s
                                                                    join distributor d on d.id = s.distributor_id
                                                                    join product p on p.distributor_id = d.id
                                                                    join customer c on c.region_id = s.region_id
                                                                    join company cm on cm.id = d.company_id
                                                                    where c.id ='$c_id'


											$run_allcosm_pro = mysqli_query($con, $get_allcosm_pro);

											$count_allcosm = mysqli_num_rows($run_allcosm_pro);
											if ($count_allcosm == 0) {
												echo 'Hello'
											}else{

												while($row_allcosm_pro=mysqli_fetch_array($run_allcosm_pro)){
													$pro_id = $row_allcosm_pro['procuct_id'];
													$pro_name = $row_allcosm_pro['product_name'];
													$pro_manu = $row_allcosm_pro['product_manufacturer'];
													$pro_price = $row_allcosm_pro['product_price'];
													$pro_dist = $row_allcosm_pro['cm_name'];





													?>

													<tr>
														<th data-priority='1" style="background: white; color: #400040;"><?php echo $pro_id ?></th>
														<th data-priority="2" style="background: white; color: #400040;"><a href="../details.php?pro_id=<?php  echo $pro_id ?>"><?php echo $pro_name ?></a></th>
														<th data-priority="3"style="background: white; color: #400040;"><?php echo $pro_manu ?></th>
														<th data-priority="4" style="background: white; color: #400040;"><?php echo $pro_price ?></th>

														<th data-priority="5" style="background: white; color: #400040;">$pro_dist</th>




													</tr>
												</thead>
	}}}
*/

											?>

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