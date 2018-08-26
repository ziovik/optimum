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


// virtual table to add cart

	function add_to_cart(){

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
					echo '<script>alert(" Added")</script>';  
					
				}  
				else  
				{  
					echo '<script>alert("Item Already Added")</script>';  
					
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
						
					}  
				}  
			}  
		}  

	}






?>