<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 8/3/2018
 * Time: 11:14 PM
 */

include 'db.php';

include $_SERVER['DOCUMENT_ROOT'] . "/db_objects/DistributorMessage.php";
include $_SERVER['DOCUMENT_ROOT'] . "/db_objects/CustomerMessage.php";

function add_product_in_cart($cart_id, $product_id, $quantity)
{
	global $con;
	$sql = "insert into product_item (cart_id, product_id, quantity) values ('$cart_id', '$product_id', '$quantity')";
	mysqli_query($con, $sql);
}


function create_cart_for_customer($customer_id)
{
	global $con;
	$sql = "insert into cart (customer_id,status) values ('$customer_id','active')";
	mysqli_query($con, $sql);
}

function get_cart_id_by_customer($customer_id)
{
	global $con;
	$sql = "select * from cart where status = 'active' and customer_id = '$customer_id'";
	$result = mysqli_query($con, $sql);

	if (mysqli_num_rows($result) == 0) {
		return null;
	} else {
		$array = mysqli_fetch_assoc($result);
		return new Cart($array['id'], $array['customer_id'], $array['status']);
	}
}

function insert_customer_message($customer_id, $distributor_id, $message, $message_date)
{
	global $con;
	$sql = "
insert into customer_chat (customer_id, distributor_id, message, message_date)
values ('$customer_id', '$distributor_id', '$message', '$message_date')";
	mysqli_query($con, $sql);
}

function insert_distributor_message($distributor_id, $customer_id, $message, $message_date)
{
	global $con;
	$sql = "
insert into distributor_chat (customer_id, distributor_id, message, message_date)
values ('$customer_id', '$distributor_id', '$message', '$message_date')";
	mysqli_query($con, $sql);
}

function get_customer_messages($customer_id, $customer_name, $distributor_id)
{
	global $con;
	$sql =
		"select 
message, message_date
from customer_chat 
where 
customer_id ='$customer_id' and distributor_id = '$distributor_id'";

	$result = mysqli_query($con, $sql);
	$messages = array();

	while ($rows = mysqli_fetch_array($result)) {
		$message = $rows['message'];
		$message_date = $rows['message_date'];

		array_push($messages, new CustomerMessage($customer_name, $message, $message_date));
	}

	return $messages;
}

function get_distributor_messages($distributor_id, $distributor_name, $customer_id)
{
	global $con;
	$sql =
		"select 
message, message_date
from distributor_chat 
where 
distributor_id ='$distributor_id' and customer_id = '$customer_id'";

	$result = mysqli_query($con, $sql);
	$messages = array();

	while ($rows = mysqli_fetch_array($result)) {
		$message = $rows['message'];
		$message_date = $rows['message_date'];

		array_push($messages, new DistributorMessage($distributor_name, $message, $message_date));
	}

	return $messages;
}