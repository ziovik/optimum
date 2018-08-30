<?php
include("db.php");
mysqli_set_charset($con, "utf8");

// create cart
function cart()
{
	global $con;

	if (isset($_GET['add_cart'])) {


		if (isset($_SESSION['customer_id'])) {


			$customer_id = $_SESSION['customer_id'];

			$pro_id = $_GET['add_cart'];


			//getting cart_id

			$sel_active_pro = "select * from cart where customer_id = '$customer_id' AND status = 'active'";

			$run_cart = mysqli_query($con, $sel_active_pro);
			$row = mysqli_fetch_array($run_cart);
			$cart_id = $row['id'];

			$sel_pro_item = "select * from product_item where cart_id='$cart_id' AND product_id = '$pro_id'";
			$run_pro_item = mysqli_query($con, $sel_pro_item);
			$check_cart = mysqli_num_rows($run_pro_item);


			if ($check_cart == 1) {
				echo "<script>alert('This Product has already been selected and added in your cart');</script>";
				echo "<script>window.open('all_products.php?all_products','_self');</script>";

			} else {


				$insert_product_item = "insert into product_item (product_id,quantity,cart_id) values ('$pro_id','1','$cart_id') ";

				$run_insert_product_item = mysqli_query($con, $insert_product_item);


				if ($run_insert_product_item) {
					echo "<script>alert('Product added to cart successfully')</script>";
					echo "<script>window.open('all_products.php?all_products','_self');</script>";
				}
			}
		}
	}
}


//total added items
function total_items()
{
	if (isset($_GET['add_cart'])) {

		global $con;

		$customer_id = $_SESSION['customer_id'];


		//getting cart_id

		$sel_cart = "select * from cart where customer_id = '$customer_id' AND status = 'active'";


		$run_cart = mysqli_query($con, $sel_cart);

		$row = mysqli_fetch_array($run_cart);

		$cart_id = $row['id'];


		$get_items = "select * from product_item where cart_id='$cart_id' ";

		$run_items = mysqli_query($con, $get_items);

		$count_items = mysqli_num_rows($run_items);
	} else {
		global $con;

		$customer_id = $_SESSION['customer_id'];


		//getting cart_id

		$sel_cart = "select * from cart where customer_id = '$customer_id' And status = 'active'";


		$run_cart = mysqli_query($con, $sel_cart);

		$row = mysqli_fetch_array($run_cart);

		$cart_id = $row['id'];
		$get_items = "select * from product_item where cart_id='$cart_id' ";

		$run_items = mysqli_query($con, $get_items);

		$count_items = mysqli_num_rows($run_items);
	}

	echo $count_items;

}


//total price in cart

function total_price()
{

	$total = 0;

	global $con;


	if (isset($_SESSION['customer_id'])) {

		$customer_id = $_SESSION['customer_id'];


		$sel_price = "select 
                         pt.product_id as product_id

                        from 
                           cart c 
                           join product_item pt on c.id = pt.cart_id
                        where c.customer_id = '$customer_id' AND c.status = 'active'";

		$run_price = mysqli_query($con, $sel_price);

		while ($p_price = mysqli_fetch_array($run_price)) {
			$pro_id = $p_price['product_id'];

			$pro_price = "select * from product where id ='$pro_id'";

			$run_pro_price = mysqli_query($con, $pro_price);

			while ($pp_price = mysqli_fetch_array($run_pro_price)) {
				$product_price = array($pp_price['price']); // getting all price

				$values = array_sum($product_price);  // sum the price

				$total += $values;

			}
		}
	}

	echo $total . "(руб)";
}


// virtual table to add cart

function add_to_cart()
{

	if (isset($_POST["add_to_cart"])) {
		if (isset($_SESSION["shopping_cart"])) {
			$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
			if (!in_array($_GET["id"], $item_array_id)) {
				$count = count($_SESSION["shopping_cart"]);
				$item_array = array(
					'item_id' => $_GET["id"],
					'item_name' => $_POST["hidden_name"],
					'item_price' => $_POST["hidden_price"],
					'item_quantity' => $_POST["quantity"]
				);
				$_SESSION["shopping_cart"][$count] = $item_array;
				echo '<script>alert(" Added")</script>';
				echo '<script>window.open("cart.php","_self")</script>';

			} else {
				echo '<script>alert("Item Already Added")</script>';


			}
		} else {
			$item_array = array(
				'item_id' => $_GET["id"],
				'item_name' => $_POST["hidden_name"],
				'item_price' => $_POST["hidden_price"],
				'item_quantity' => $_POST["quantity"]
			);
			$_SESSION["shopping_cart"][0] = $item_array;
		}
	}
	if (isset($_GET["action"])) {
		if ($_GET["action"] == "delete") {
			foreach ($_SESSION["shopping_cart"] as $keys => $values) {
				if ($values["item_id"] == $_GET["id"]) {
					unset($_SESSION["shopping_cart"][$keys]);
					echo '<script>alert("Item Removed")</script>';
					echo '<script>window.open("cart.php","_self")</script>';

				}
			}
		}
	}

}


// send mail
function sendEmail()
{
	global $con;

	if (isset($_SESSION['customer_id'])) {


		if ($_POST['send_distributor']) {

			$customer_id = $_SESSION['customer_id'];

			$sql = "select 
                          con.email as distributor_email
                     from cart crt
                          join product_item pt on pt.cart_id = crt.id
                          join simple_order so on so.cart_id = crt.id
                          join product p on p.id = pt.product_id
                          join distributor d on d.id = p.distributor_id
                          join contact con on con.id = d.contact_id
                          join customer c on c.id = crt.customer_id
                     where c.id = '$customer_id' AND crt.status = 'active'";
			$run_info = mysqli_query($con, $sql);

			while ($rows = mysqli_fetch_array($run_info)) {
				$distributor_email = $rows['distributor_email'];
			}


			//reciever
			$to = 'mondaydaniel2002@yahoo.com';

			//subject
			$subject = 'у вас заказ';

			//messages/mail
			$message = '<h1>у вас заказ от велокса</h1>';


			//

			$headers = "From:  The sender name <veloxkursk@yandex.ru>\r\n";
			$headers .= "Reply-To: veloxkursk@yandex.ru\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

			mail($to, $subject, $message, $headers);
		}
	}

}

function mail_utf8($to, $from_user, $from_email, $subject = '(No subject)', $message = '')

{
	$from_user = "=?UTF-8?B?" . base64_encode($from_user) . "?=";
	$subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";

	$headers = "From: $from_user <$from_email>\r\n" .
		"MIME-Version: 1.0" . "\r\n" .
		"Content-type: text/html; charset=UTF-8" . "\r\n";

	return mail($to, $subject, $message, $headers);
}

function date_comparator($msg1, $msg2)
{
	$date1 = $msg1->date;
	$date2 = $msg2->date;

	if ($date1 == $date2) return 0;

	return ($date1 < $date2) ? -1 : 1;
}
