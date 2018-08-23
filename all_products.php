<?php  
       session_start();
       include("inc/db.php");
       include("inc/functions.php");
     //for not acceessing this page by another person who is not in admin

   if (!isset($_SESSION['id'])) {
  echo "<script>window.open('customer/customer_login.php?not_admin=You are not signed in!','_self')</script>";
}

else{
//end

	if(isset($_POST["add_to_cart"]))  
	{  
		if(isset($_SESSION["shopping_cart"]))  
		{  
			$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
			if(!in_array($_GET["id"], $item_array_id))  
			{  
				$count = count($_SESSION["shopping_cart"]);  
				$item_array = array(  
					'item_id'               =>     $_GET["id"],  
					'item_name'               =>     $_POST["hidden_name"],  
					'item_price'          =>     $_POST["hidden_price"],  
					'item_quantity'          =>     $_POST["quantity"]  
				);  
				$_SESSION["shopping_cart"][$count] = $item_array;  
			}  
			else  
			{  
				echo '<script>alert("Item Already Added")</script>';  
				echo '<script>window.location="all_products.php"</script>';  
			}  
		}  
		else  
		{  
			$item_array = array(  
				'item_id'               =>     $_GET["id"],  
				'item_name'               =>     $_POST["hidden_name"],  
				'item_price'          =>     $_POST["hidden_price"],  
				'item_quantity'          =>     $_POST["quantity"]  
			);  
			$_SESSION["shopping_cart"][0] = $item_array;  
		}  
	}  
	if(isset($_GET["action"]))  
	{  
		if($_GET["action"] == "delete")  
		{  
			foreach($_SESSION["shopping_cart"] as $keys => $values)  
			{  
				if($values["item_id"] == $_GET["id"])  
				{  
					unset($_SESSION["shopping_cart"][$keys]);  
					echo '<script>alert("Item Removed")</script>';  
					echo '<script>window.location="all_products.php"</script>';  
				}  
			}  
		}  
	}  
	
?>
<!DOCTYPE html>
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
				<div class="category-nav">
					<?php include("inc/menu.php") ?>
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->

	<!-- HOME -->
	<div id="home"  >
		<!-- container -->
		<div class="container" style="min-height: 700px;" >
			<!-- home wrap -->
			<div class="home-wrap" id="result">
				<!-- home slick -->
				<div >

				</div>
				<!-- /home slick -->

			</div>
			<!-- /home wrap -->
            <div class="col-md-9 col-sm-6 col-xs-6" style="float: right;">
                <div style="clear:both"></div>  
                <br />  
                <h3>Всего заказа</h3>  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="40%">Найменование</th>  
                               <th width="10%">Количество</th>  
                               <th width="20%">Цена</th>  
                               <th width="15%">Итого</th>  
                               <th width="5%">Удаление</th>  
                          </tr>  
                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values["item_name"]; ?></td>  
                               <td><?php echo $values["item_quantity"]; ?></td>  
                               <td>$ <?php echo $values["item_price"]; ?></td>  
                               <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                               <td><a href="all_products.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3" align="right">Total</td>  
                               <td align="right">$ <?php echo number_format($total, 2); ?></td>  
                               <td></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
            </div>
			</div>
			 <!-- row -->
            
		</div>

		<!-- /container -->
	</div>
	<!-- /HOME -->




	<?php include("inc/footer1.php");?>
	<?php  } ?>

	<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>