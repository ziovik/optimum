<?php

function get_login() {
    include_once 'db.php';
    $con = get_db_connection();
    $res = $con->query('select * from credentials where id = 1');
    return $res->fetch_assoc()['login'];
}


// create cart
function cart(){
    include_once 'db.php';
	$con = get_db_connection();

	if (isset($_GET['add_cart'])) {
       

		$user = $_SESSION['customer_email'];
		$pro_id = $_GET['add_cart'];

        $cart_status = 'in progress';

		
		if (isset($_SESSION['customer_email'])) {
            $customer_email = $_SESSION['customer_email'];

            $get_cart = "select * from cart where customer_email = '$customer_email' AND p_id = '$pro_id'";

            $run_cart = mysqli_query($con, $get_cart);

            $check_cart = mysqli_num_rows($run_cart);

            if ($check_cart == 1) {
            	echo "<script>alert('This Product has been selected and added in your cart');</script>";


            }else {

			$insert_pro ="insert into cart (p_id,customer_email,qty,cart_status) values ('$pro_id','$customer_email','1','$cart_status')";
			
			
			$run_pro = mysqli_query($con, $insert_pro);



			$insert_history ="insert into history (p_id,customer_email,qty,cart_status) values ('$pro_id','$customer_email','1','$cart_status')";
			
			
			$run_history = mysqli_query($con, $insert_history);
			

			if($run_pro){
				echo "<script>alert('Product added to cart successfully')</script>";
				echo "<script>window.open('optimum_beauty.php?all_products','_self');</script>";
			}else{
				echo "<script>alert('Problem in insertting the product you have already added it may be ')</script>";
				echo "<script>window.open('optimum_beauty.php?all_products','_self');</script>";
			    }
            }
	 }   } 
}


//total added items
function total_items(){
	if (isset($_GET['add_cart'])) {
		global $con;

		$user = $_SESSION['customer_email'];
		$get_items = "select * from cart where customer_email='$user'";
		$run_items = mysqli_query($con, $get_items);

		$count_items =mysqli_num_rows($run_items);
		}else{
			global $con;

			$user = $_SESSION['customer_email'];
		    $get_items = "select * from cart where customer_email='$user'";
		   $run_items = mysqli_query($con, $get_items);

		   $count_items =mysqli_num_rows($run_items);
		}

		echo $count_items ;
	
   }





	//total price in cart

	function total_price(){

		$total = 0;

		global $con;
        
        if (isset($_SESSION['customer_email'])) {
        	$user = $_SESSION['customer_email'];
        

        $sel_price = "select * from cart where customer_email = '$user'";

        $run_price = mysqli_query($con, $sel_price);

        while($p_price = mysqli_fetch_array($run_price)){
        	$pro_id =$p_price['p_id'];

        	$pro_price = "select * from products where product_id ='$pro_id'";

        	$run_pro_price =mysqli_query($con, $pro_price);

        	while ($pp_price = mysqli_fetch_array($run_pro_price)){
        		$product_price = array($pp_price['product_price']); // getting all price

        		$values = array_sum($product_price);  // sum the price

        		$total += $values;

        	}  }
        }

        echo $total."(руб)";
	}


//getting categories

function getCats(){
	global $con;

	$get_cats = "select * from categories";
	$run_cats = mysqli_query($con, $get_cats);

	while ($row_cats = mysqli_fetch_array($run_cats)){
		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];

		echo "<li><a href ='index.php?cat=$cat_id'>$cat_title</a></li>";
	}
}

function getBrands(){
	global $con;

	$get_brands = "select * from brands";
	$run_brands = mysqli_query($con, $get_brands);

	while ($row_brands = mysqli_fetch_array($run_brands)){
		$brand_id = $row_brands['brand_id'];
		$brand_name = $row_brands['brand_name'];

		echo "<li><a href ='index.php?brand=$brand_id'>$brand_name</a></li>";
	}
}


function getRegion(){
	global $con;

	$get_regs = "select * from regions";
	$run_regs = mysqli_query($con, $get_regs);

	while ($row_regs = mysqli_fetch_array($run_regs)){
		$region_id = $row_regs['region_id'];
		$region_name = $row_regs['region_name'];

		echo "<li ><a href ='optimum_beauty.php?region=$region_id'>$region_name</a></li>";
	}
}

function getSubCat(){
	global $con;

	$get_sub_cat = "select * from sub_cat";
	$run_sub_cat = mysqli_query($con, $get_sub_cat);

	while ($row_sub_cat = mysqli_fetch_array($run_sub_cat)){
		$sub_cat_id = $row_sub_cat['sub_cat_id'];
		$sub_cat_name = $row_sub_cat['sub_cat_name'];

		echo "<li><a href ='index.php?sub_cat=$sub_cat_id'>$sub_cat_name</a></li>";
	}
}


//getting the products to our website page

function getPro(){
     
     if (!isset($_GET['region'])) {
     	
        
        	
        	if (!isset($_GET['sub_cat'])) {
        		
        	
        

	global $con;

	$get_pro = "select * from products order by RAND() LIMIT 0,6";
	$run_pro = mysqli_query($con, $get_pro);

	while($row_pro=mysqli_fetch_array($run_pro)){
		$pro_id = $row_pro['product_id'];
		$pro_cat = $row_pro['product_cat'];
		$pro_sub_cat = $row_pro['product_sub_cat'];
		$pro_brand = $row_pro['product_brand'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_image'];
		$pro_manu = $row_pro['product_manu'];


		echo "

                <div id='single_product'>
                    <h4>$pro_title</h4>
                    <img src='admin_area/product_images/$pro_image' width='200px' height='200px' >
                    <p ><b>$pro_price</b></p>
                    <a href='details.php?pro_id=$pro_id' style='float:left'><button>Details</button></a>

                    <a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to cart</button></a>
                   
                  
                </div>
		";

		}

	

		}

	}
}


?>