<?php
  
$con = mysqli_connect("localhost","root","","super_optimum");
mysqli_set_charset($con,"utf8");

// create cart
function cart(){
	global $con;

	if (isset($_GET['add_cart'])) {
    
		
		if (isset($_SESSION['id'])) {

		

            $customer_id = $_SESSION['id'];

            $pro_id = $_GET['add_cart'];

           


            //getting cart_id

            $sel_active_pro = "select * from cart where customer_id = '$customer_id' AND status = 'active'";

             $run_cart = mysqli_query($con, $sel_active_pro);
             $row = mysqli_fetch_array($run_cart);
             $cart_id = $row['id'];

             $sel_pro_item = "select * from product_item where cart_id='$cart_id' AND product_id = '$pro_id'";
             $run_pro_item = mysqli_query($con, $sel_pro_item);
             $check_cart = mysqli_num_rows($run_pro_item );


            if ($check_cart == 1) {
            	echo "<script>alert('This Product has already been selected and added in your cart');</script>";
                echo "<script>window.open('all_products.php?all_products','_self');</script>";

            }else {

	
			$insert_product_item = "insert into product_item (product_id,quantity,cart_id) values ('$pro_id','1','$cart_id') ";

			$run_insert_product_item = mysqli_query($con, $insert_product_item);


			if($run_insert_product_item){
				echo "<script>alert('Product added to cart successfully')</script>";
				echo "<script>window.open('all_products.php?all_products','_self');</script>";
			}
            }	
	 }   } 
}


//total added items
function total_items(){
	if (isset($_GET['add_cart'])) {

		global $con;

		$customer_id = $_SESSION['id'];

      

        //getting cart_id

        $sel_cart ="select * from cart where customer_id = '$customer_id' AND status = 'active'";

		
		$run_cart = mysqli_query($con, $sel_cart);

		$row = mysqli_fetch_array($run_cart);

		 $cart_id = $row['id'];


		$get_items = "select * from product_item where cart_id='$cart_id' ";

		$run_items = mysqli_query($con, $get_items);

		$count_items =mysqli_num_rows($run_items);
		}else{
			global $con;

		$customer_id = $_SESSION['id'];

        
        //getting cart_id

        $sel_cart ="select * from cart where customer_id = '$customer_id' And status = 'active'";

		
		$run_cart = mysqli_query($con, $sel_cart);

		$row = mysqli_fetch_array($run_cart);

		 $cart_id = $row['id'];
		    $get_items = "select * from product_item where cart_id='$cart_id' ";

		   $run_items = mysqli_query($con, $get_items);

		   $count_items =mysqli_num_rows($run_items);
		}

		echo $count_items ;
	
   }





	//total price in cart

	function total_price(){

		$total = 0;

		global $con;
        
        
		if (isset($_SESSION['id'])) {

            $customer_id = $_SESSION['id'];

            

        $sel_price = "select 
                         pt.product_id as product_id

                        from 
                           cart c 
                           join product_item pt on c.id = pt.cart_id
                        where c.customer_id = '$customer_id' AND c.status = 'active'";

        $run_price = mysqli_query($con, $sel_price);

        while($p_price = mysqli_fetch_array($run_price)){
        	$pro_id =$p_price['product_id'];

        	$pro_price = "select * from product where id ='$pro_id'";

        	$run_pro_price =mysqli_query($con, $pro_price);

        	while ($pp_price = mysqli_fetch_array($run_pro_price)){
        		$product_price = array($pp_price['price']); // getting all price

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