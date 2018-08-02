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
					<span class="category-header">Категории <i class="fa fa-list"></i></span>
					<ul class="category-list">
						<li class="dropdown side-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="cosm">Косметология <i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											<li><h3 class="list-links-title"><a href="allcosm.php?allcosm=1" name="allcosm">Косметология</a>  </h3></li>
												
											<?php
												if (!isset($_GET['cosm'])) {
                                                   

                                                   $get_cosm = "select * from sub_cat where cat_id='1'";

                                                   $run_cosm = mysqli_query($con, $get_cosm);

                                                    
                                                     while ($row_cosm  = mysqli_fetch_array($run_cosm)){

                                                       $cosm_id= $row_cosm['sub_cat_id'];
                                                       $cosm_name = $row_cosm['sub_cat_name'];

                                                      echo " <li style='width:300px;'><a href='cosm.php?cosm=$cosm_id'>$cosm_name</a></li>";
                                                   
                                                  }

		                                         
                                                
                                                }
                                               ?>
										</ul>
										<hr class="hidden-md hidden-lg">
									</div>
									
								
							</div>
						</li>
						
						<li class="dropdown side-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="depil">Депиляция <i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											
												<?php
												if (!isset($_GET['depil'])) {
													
												

                                                 $get_depils = "select * from sub_cat where cat_id='2' ";
	                                             $run_depils = mysqli_query($con, $get_depils );

	                                             while ($row_depils  = mysqli_fetch_array($run_depils)){
		                                         $depil_id = $row_depils['sub_cat_id'];
		                                         $depil_name = $row_depils['sub_cat_name'];

		                                         echo " <li style='width:300px;'><a href='depil.php?depil=$depil_id'>$depil_name</a></li>";
                                                 }
                                                }
                                               ?>
		                       
											
										</ul>
										<hr class="hidden-md hidden-lg">
									</div>
									
								
							</div>
						</li>
	
						<li class="dropdown side-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="solar">Солярий <i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											
												<?php
												if (!isset($_GET['solar'])) {
													
												

                                                 $get_solars = "select * from sub_cat where cat_id='3' ";
	                                             $run_solars = mysqli_query($con, $get_solars );

	                                             while ($row_solars  = mysqli_fetch_array($run_solars)){
		                                         $solar_id = $row_solars['sub_cat_id'];
		                                         $solar_name = $row_solars['sub_cat_name'];

		                                         echo " <li style='width:300px;'><a href='solar.php?solar=$solar_id'>$solar_name</a></li>";
                                                 }
                                                }
                                               ?>
		                       
											
										</ul>
										<hr class="hidden-md hidden-lg">
									</div>
									
								
							</div>
						</li>
		
						<li class="dropdown side-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="massag">Массаж <i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											
												<?php
												if (isset($_GET['massag'])) {
													
												

                                                 $get_massags = "select * from sub_cat where cat_id='4' ";
	                                             $run_massags = mysqli_query($con, $get_massags );

	                                             while ($row_massags  = mysqli_fetch_array($run_massags)){
		                                         $massag_id = $row_massags['sub_cat_id'];
		                                         $massag_name = $row_massags['sub_cat_name'];

		                                         echo " <li style='width:300px;'><a href='massag.php?massag=$massag_id'>$massag_name</a></li>";
                                                 }
                                                }
                                               ?>
		                       
											
										</ul>
										<hr class="hidden-md hidden-lg">
									</div>
									
								
							</div>
						</li>
					
				
						<li class="dropdown side-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="par">Парикмахерская Продукция <i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											<li>
												<h3 class="list-links-title" style="width: 300px;"><a href="allparak.php?allpar=5" name="allnail">Парикмахерская Продукция</a>  </h3></li>
                                                   <?php
												if (!isset($_GET['par'])) {
													
												 $get_pars = "select * from sub_cat where cat_id='5' ";
	                                             $run_pars = mysqli_query($con, $get_pars );

	                                             while ($row_pars  = mysqli_fetch_array($run_pars)){
		                                         $par_id = $row_pars['sub_cat_id'];
		                                         $par_name = $row_pars['sub_cat_name'];

                                                 

		                                         echo " <li style='width:300px;'><a href='parak.php?par=$par_id'>$par_name</a></li>";
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
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="nail">Ногтевой сервис <i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											<li>
												<h3 class="list-links-title"><a href="allnail.php?allnail=6" name="allnail">Ногтевой сервис</a>  </h3></li>

												<?php
												if (!isset($_GET['nail'])) {
													
												
                                                 $get_nails = "select * from sub_cat where cat_id='6' ";
	                                              $run_nails = mysqli_query($con, $get_nails );

	                                              while ($row_nails  = mysqli_fetch_array($run_nails)){
		                                          $nail_id = $row_nails['sub_cat_id'];
		                                          $nail_name = $row_nails['sub_cat_name'];	

		                                         echo " <li style='width:300px;'><a href='nail.php?nail=$nail_id'>$nail_name</a></li>";
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
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="eye">Ресницы и брови<i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											<li>
												<h3 class="list-links-title"><a href="alleye.php?alleye=7" name="allnail">Ресницы и брови</a>  </h3></li>

												<?php
												if (!isset($_GET['eye'])) {
													
												
                                                 $get_eye = "select * from sub_cat where cat_id='7' ";
	                                              $run_eye = mysqli_query($con, $get_eye );

	                                              while ($row_eye  = mysqli_fetch_array($run_eye)){
		                                          $eye_id = $row_eye['sub_cat_id'];
		                                          $eye_name = $row_eye['sub_cat_name'];	

		                                         echo " <li style='width:300px;'><a href='eye.php?eye=$eye_id'>$eye_name</a></li>";
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
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="viz">Визаж<i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
										<li>
												<h3 class="list-links-title"><a href="allviz.php?allviz=8" name="allviz">Визаж</a>  </h3></li>	
											<?php
												if (!isset($_GET['viz'])) {
													
												
                                                 $get_viz = "select * from sub_cat where cat_id='8' ";
	                                              $run_viz = mysqli_query($con, $get_viz );

	                                              while ($row_viz  = mysqli_fetch_array($run_viz)){
		                                          $viz_id = $row_viz['sub_cat_id'];
		                                          $viz_name = $row_viz['sub_cat_name'];	

		                                         echo " <li style='width:500px;'><a href='viz.php?viz=$viz_id'>$viz_name</a></li>";
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
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="tatu">Татуаж и пирсинг<i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											
											<li>
												<h3 class="list-links-title"><a href="alltatu.php?alltatu=9" name="alltatu">Татуаж и пирсинг</a>  </h3></li>	
											<?php
												if (!isset($_GET['tatu'])) {
													
												
                                                 $get_tatu = "select * from sub_cat where cat_id='9' ";
	                                              $run_tatu = mysqli_query($con, $get_tatu );

	                                              while ($row_tatu  = mysqli_fetch_array($run_tatu)){
		                                          $tatu_id = $row_tatu['sub_cat_id'];
		                                          $tatu_name = $row_tatu['sub_cat_name'];	

		                                         echo " <li style='width:500px;'><a href='tatu.php?tatu=$tatu_id'>$tatu_name</a></li>";
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
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="mat">Расходники<i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											
											<li>
												<h3 class="list-links-title"><a href="allmat.php?allmat=10" name="allmat">Расходники</a>  </h3></li>	
											<?php
												if (!isset($_GET['mat'])) {
													
												
                                                 $get_mat = "select * from sub_cat where cat_id='10' ";
	                                              $run_mat = mysqli_query($con, $get_mat );

	                                              while ($row_mat  = mysqli_fetch_array($run_mat)){
		                                          $mat_id = $row_mat['sub_cat_id'];
		                                          $mat_name = $row_mat['sub_cat_name'];	

		                                         echo " <li style='width:500px;'><a href='mat.php?mat=$mat_id'>$mat_name</a></li>";
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
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="ster">Стерилизация и дезинфекция<i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											
											<li style="width: 300px;">
												<h3 class="list-links-title"><a href="allster.php?allster=11" name="allster">Стерилизация и дезинфекция</a>  </h3></li>	
											<?php
												if (!isset($_GET['ster'])) {
													
												
                                                 $get_ster = "select * from sub_cat where cat_id='11' ";
	                                              $run_ster = mysqli_query($con, $get_ster );

	                                              while ($row_ster  = mysqli_fetch_array($run_ster)){
		                                          $ster_id = $row_ster['sub_cat_id'];
		                                          $ster_name = $row_ster['sub_cat_name'];	

		                                         echo " <li style='width:500px;'><a href='ster.php?ster=$ster_id'>$ster_name</a></li>";
                                                 }
                                                }
                                               ?>
										</ul>
										<hr class="hidden-md hidden-lg">
									</div>
									
								</div>
								
							</div>
						</li>
						
						<li><a href="../all_products.php?all_products">View All</a></li>
					</ul>
				</div>
				<!-- menu nav -->
				<div class="menu-nav">
					<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
					<ul class="menu-list">
						
						
						
						
						<li class="dropdown default-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="region">Regions <i class="fa fa-caret-down"></i></a>
							<ul class="custom-menu">
								<?php echo getRegion();  ?>
							</ul>
						</li>
						<li id="center1" ><a href="../all_products.php?all_products" title="живой пойск"></a></li>
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

                                          <th colspan="1" data-priority="1">Product Name</th>

                                          <th colspan="1" data-priority="2">Product Price</th>
                                          <th colspan="1" data-priority="3">Manufacturer</th>

                                          <th colspan="1" data-priority="7">Description</th>
                                          
                
                                      </tr>
                                      <?php	
                                          if (isset($_GET['massag'])) {
     	
      
                                           $massag_id = $_GET['massag'];

	                                       global $con;

	                                       $get_massag_pro = "select * from products where product_sub_cat='$massag_id'";
	                                       $run_massag_pro = mysqli_query($con, $get_massag_pro);

	                                       $count_massag = mysqli_num_rows($run_massag_pro);
	                                       if ($count_massag == 0) {
	   	                                      echo "<h2 style='text-align:center;'>'No Product'</h2>";
	                                        }else{

	                                           while($row_massag_pro=mysqli_fetch_array($run_massag_pro)){
		                                            $pro_id = $row_massag_pro['product_id'];
		                                            $pro_cat = $row_massag_pro['product_cat'];
		                                            $pro_sub_cat = $row_massag_pro['product_sub_cat'];
		  
		                                            $pro_name = $row_massag_pro['product_title'];
		                                            $pro_price = $row_massag_pro['product_price'];
		                                            $pro_desc = $row_massag_pro['product_desc'];
		                                            $pro_dist = $row_massag_pro['dist_id'];
		                                            $pro_manu = $row_massag_pro['product_manu'];
		                              ?>

                                             <tr>
                                                 <th data-priority="1" style="background: white; color: #400040;"><a href="../details.php?pro_id=<?php  echo $pro_id ?>"><?php echo $pro_name ?></a></th>
                                                 <th data-priority="2"style="background: white; color: #400040;"><?php echo $pro_price ?></th>
                                                 <th data-priority="3" style="background: white; color: #400040;"><?php echo $pro_manu ?></th>
                
                                                 <th data-priority="7" style="background: white; color: #400040;"><?php echo $pro_desc ?></th>
                                                 
               

                                             </tr>
                                            </thead>
	

		                           <?php } } } ?>	

		                    </table>
              <div >      </div>	
				
				
				
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