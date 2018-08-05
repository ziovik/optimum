<?php
/**
 * Created by PhpStorm.
 * User: nd
 * Date: 04.08.18
 * Time: 0:51
 * @param $login
 * @return Customer|null
 */

function get_db_connection()
{
	$con = new mysqli("localhost", "root", "rjynbytyn", "super_optimum");

	if ($con->connect_error) {
		echo "Failed to connect to mysql server :" . mysqli_connect_errno();
		return null;
	}

	return $con;
}

function get_customer_by_login($login)
{
	$con = get_db_connection();
	$result = $con->query(
		"select 
                c.id as customer_id,
                c.name as customer_name
                from customer c join credentials cr on c.credentials_id = cr.id
              where cr.login = '$login'");

	if ($result->num_rows == 0) {
		return null;
	}

	$result = $result->fetch_assoc();
	$customer = new Customer($result['customer_id'], $result['customer_name'],
		null, null, null, null, null);
	return $customer;
}

function get_customer_by_logpass($login, $password)
{
	$con = get_db_connection();
	$result = $con->query(
		"select 
                c.id as customer_id,
                c.name as customer_name
                from customer c join credentials cr on c.credentials_id = cr.id
              where cr.login = '$login' and cr.password = '$password'");

	if ($result->num_rows == 0) {
		return null;
	}

	$result = $result->fetch_assoc();
	$customer = new Customer($result['customer_id'], $result['customer_name']);
	return $customer;
}

function add_product_in_cart($cart_id, $product_id, $quantity)
{
	$con = get_db_connection();
	$sql = "insert into product_item (cart_id, product_id, quantity) values ('$cart_id', '$product_id', '$quantity')";
	mysqli_query($con, $sql);
}

function create_cart_for_customer($customer_id)
{
	$con = get_db_connection();
	$sql = "insert into cart (customer_id,status) values ('$customer_id','active')";
	mysqli_query($con, $sql);
}

function get_active_cart_for_customer($customer_id)
{
	$con = get_db_connection();
	$sql = "select * from cart where customer_id = '$customer_id' and status = 'active'";

	if ($result = $con->query($sql)) {
		$row = $result->fetch_assoc();
		return new Cart($row['id'], $row['customer_id'], $row['status']);
	}
	return null;
}

function get_inactive_carts_for_customer($customer_id)
{
	$con = get_db_connection();
	$sql = "select * from cart where customer_id = '$customer_id' and status = 'inactive'";
	$carts = array();

	if ($result = $con->query($sql)) {
		while($row = $result->fetch_assoc()){
			array_push($carts, new Cart($row['id'], $row['customer_id'], $row['status']));
		}
	}
	return $carts;
}

function get_cart_id_by_customer($customer_id)
{
	$con = get_db_connection();
	$sql = "select * from cart where status = 'active' and customer_id = '$customer_id'";
	$result = mysqli_query($con, $sql);

	if (mysqli_num_rows($result) == 0) {
		return null;
	} else {
		$array = mysqli_fetch_assoc($result);
		return new Cart($array['id'], $array['customer_id'], $array['status']);
	}
}

function get_category_by_id($category_id)
{
	$query = "select * from category where id = '$category_id'";
	$con = get_db_connection();

	if ($result = $con->query($query)) {
		$row = $result->fetch_assoc();
		return new Category($row['id'], $row['name']);
	}

	return null;
}

function get_all_sub_categories()
{
	$sub_categories = array();
	$con = get_db_connection();
	$result = $con->query('select * from sub_category');
	while ($array = $result->fetch_assoc()) {
		array_push($sub_categories,
			new SubCategory($array['id'], $array['name'], new Category($array['category_id'])));
	}
	return $sub_categories;
}

function get_sub_category_by_id($id)
{
	$con = get_db_connection();
	$result = $con->query("select * from sub_category where id = '$id'");

	if ($result->num_rows == 0) {
		return null;
	}

	$row = $result->fetch_assoc();
	return new SubCategory($row['id'], $row['name'], $row['category_id']);
}

function get_sub_categories_by_category_id($category_id)
{
	$con = get_db_connection();
	$result = $con->query("select * from sub_category where category_id = '$category_id'");

	$sub_categories = array();

	if ($result->num_rows == 0) {
		return $sub_categories;
	}

	while ($row = $result->fetch_assoc()) {
		array_push($sub_categories, new SubCategory($row['id'], $row['name'], $row['category_id']));
	}

	return $sub_categories;
}


function get_all_categories()
{
	$query = "select * from category";
	$con = get_db_connection();
	$categories = array();

	if ($result = $con->query($query)) {
		while ($row = $result->fetch_assoc()) {
			array_push($categories, new Category($row['id'], $row['name']));
		}
	}

	return $categories;
}

function get_product_items_in_cart_for_customer_id($customer_id, $status)
{
	$con = get_db_connection();
	$sql =
		"select pi.* from cart crt 
			join product_item pi on crt.id = pi.cart_id 
			join customer c on c.id = crt.customer_id
			where c.id = '$customer_id' and crt.status = '$status'";
	$result = $con->query($sql);
	$product_items = array();

	while ($rows = $result->fetch_assoc()) {
		array_push($product_items,
			new ProductItem(
				$rows['id'], $rows['product_id'], $rows['quantity'], $rows['cart_id']
			));
	}
	return $product_items;
}

function add_to_product_item($cart_id, $product_id, $quantity) {
	$con = get_db_connection();
	$sql = "insert into product_item ('cart_id','product_id', 'quantity') values (?,?,?)";
	$stmt = $con->prepare($sql);
	$stmt->bind_param("iid", $cart_id, $product_id, $quantity);
	$stmt->execute();
	$stmt->close();
}