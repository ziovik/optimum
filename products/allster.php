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
                <li><a href="../optimum_beauty.php">Главная</a></li>
                <li class="active">Стерилизация и дезинфекция </li>
            </ul>
        </div>
    </div>
    <!-- /BREADCRUMB -->

    <!-- HOME -->
    <div id="home">
        <!-- container -->
        <div class="container" style="min-height: 600px;">
            <!-- home wrap -->
            <div class="home-wrap">
                <!-- home slick -->
                <div>

					<?php cart(); ?>
                    <!-- banner -->
                    <div class="banner banner-1">
                        <div class="table-responsive" data-pattern="priority-columns">
                            <table cellspacing="0" id="group-test"
                                   class="table table-small-font table-bordered table-striped">
                                <thead>
                                <tr>

                                    <th colspan="1" data-priority="1" >Дистрибьютор</th>

                                    <th colspan="1" data-priority="2" style="width:400px;">Найменование</th>
                                    <th colspan="1" data-priority="3">Производитель/<br>Страна производства</th>
                                    <th colspan="1" data-priority="4">Цена</th>
                                    <th colspan="1" data-priority="5">Годен до</th>
                                    <th colspan="1" data-priority="6">Остаток</th>
                                    <th colspan="1" data-priority="7">Примечание</th>


                                </tr>
								<?php

								include("inc/db.php");
								if(isset($_SESSION['id'])){
                                $customer_id = $_SESSION['id'];



								if (isset($_GET['allster'])) {
                                    $allster_id = $_GET['allster'];
                                    $get_allster_pro =
                                        "select 
                                          p.id as product_id, 
                                          p.name as product_name, 
                                          p.manufacturer as product_manufacturer,
                                          p.price as product_price, 
                                          p.min_order as product_min_order,
                                          p.expires as expires,
                                          p.description as discription,
                                          p.discount as discount,
                                          cm.name as company_name
                                          
                                     from
                                        store s
                                        join distributor d on d.id = s.distributor_id
                                        join product p on p.distributor_id = d.id
                                        join customer c on c.region_id = s.region_id
                                        join company cm on cm.id = d.company_id
                                        join sub_category sb on sb.id = p.sub_category_id
                                        join category ct on ct.id = sb.category_id
                                        
                                        where c.id ='$customer_id' and ct.id= '$allster_id'";

                                    $run_allster_pro = mysqli_query($con, $get_allster_pro);

                                    
									$count_allster = mysqli_num_rows($run_allster_pro);

									if ($count_allster == 0) {
									    echo "<h2 style='text-align:center;'>Нет продукта</h2>";
                                    } else {
									    while($row_allster_pro=mysqli_fetch_array($run_allster_pro)) {
											$pro_id = $row_allster_pro['product_id'];
											$pro_name = $row_allster_pro['product_name'];
											$pro_manu = $row_allster_pro['product_manufacturer'];
											$pro_price = $row_allster_pro['product_price'];
											$pro_dist = $row_allster_pro['company_name'];
                                            $pro_min_order = $row_allster_pro['product_min_order'];
                                            $pro_expires = $row_allster_pro['expires'];
                                            $pro_desc = $row_allster_pro['discription'];

											?>

                                            <tr>
                                            <th data-priority="1" style="background: white; color: #400040;"><?php echo $pro_dist ?></th>
                                                <th data-priority="2" style="background: white; color: #400040; width: 400px;"><a href="../details.php?pro_id=<?php echo $pro_id ?>"><?php echo $pro_name ?></a></th>
                                                <th data-priority="3"style="background: white; color: #400040;"><?php echo $pro_manu ?></th>
                                                <th data-priority="4" style="background: white; color: #400040;"><?php echo $pro_price ?></th>

                                                <th data-priority="5" style="background: white; color: #400040;"><?php echo $pro_expires ?></th>
                                                <th data-priority="5" style="background: white; color: #400040;"><?php echo $pro_min_order ?></th>
                                                <th data-priority="5" style="background: white; color: #400040;"><?php echo $pro_desc ?></th>
                                            </tr>
                                        </thead>
                                        <?php
										}}}}  ?>

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

<?php include("inc/footer1.php"); ?>