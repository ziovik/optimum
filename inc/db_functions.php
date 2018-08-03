<?php
/**
 * Created by PhpStorm.
 * User: nd
 * Date: 04.08.18
 * Time: 0:51
 */


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

function get_all_sub_categories()
{
    include_once 'db.php';
    require('db_object/SubCategory.php');
    $sub_categories = array();
    $con = get_db_connection();
    $result = $con->query('select * from sub_category');
    while ($array = $result->fetch_assoc()) {
        array_push($sub_categories,
            new SubCategory($array['id'], $array['name'], $array['category_id']));
    }
    return $sub_categories;
}

function get_sub_categories_by_id($category_id)
{
    include_once 'db.php';
    require('db_object/SubCategory.php');
    $sub_categories = array();
    $con = get_db_connection();
    $result = $con->query("select * from sub_category where category_id = '$category_id'");
    while ($array = $result->fetch_assoc()) {
        array_push($sub_categories,
            new SubCategory($array['id'], $array['name'], $array['category_id']));
    }
    return $sub_categories;
}

function get_customer_by_logpass($login, $password)
{
    include_once 'db.php';
    include_once '../db_object/Customer.php';

    $con = get_db_connection();
    $result = $con->query(
        "select 
                c.id as customer_id,
                c.name as customer_name
                from customer c join credentials cr on c.credentials_id = cr.id
              where cr.login = '$login' and cr.password = '$password'");
    include_once '../inc/tests.php';

    if ($result->num_rows==0) {
        return null;
    }

    $result = $result->fetch_assoc();
    $customer = new Customer($result['customer_id'], $result['customer_name']);
    return $customer;
}
