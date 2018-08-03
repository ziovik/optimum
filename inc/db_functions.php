<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 8/3/2018
 * Time: 11:14 PM
 */

$con = mysqli_connect("localhost","root","","super_optimum");
mysqli_set_charset($con,"utf8");

function add_product_in_cart($cart_id, $product_id, $quantity) {
	global $con;
	$sql = "insert into product_item (cart_id, product_id, quantity) values ('$cart_id', '$product_id', '$quantity')";
	mysqli_query($con, $sql);
}


function create_cart_for_customer($customer_id) {
	global $con;
	$sql ="insert into cart (customer_id,status) values ('$customer_id','active')";
	mysqli_query($con, $sql);
}

function get_cart_id_by_customer($customer_id) {
	global $con;
	$sql = "select * from cart where status = 'active' and customer_id = '$customer_id'";
	$result = mysqli_query($con, $sql);

	if (mysqli_num_rows($result)== 0) {
		return null;
	} else {
		$array = mysqli_fetch_assoc($result);
		return new Cart($array['id'], $array['customer_id'], $array['status']);
	}
}