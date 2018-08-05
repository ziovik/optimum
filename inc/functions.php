<?php

function total_items()
{
	if (isset($_GET['add_cart'])) {
		$customer = $_SESSION['customer'];
		return count(get_product_items_in_cart_for_customer_id($customer->id, 'active'));
		return 0;
	}
}