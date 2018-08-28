<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 8/28/2018
 * Time: 1:18 PM
 */
session_start();
include("../inc/db.php");

function show_message($message)
{
    echo "<script>console.log('$message')</script>";
}

function get_distributor_id_by_customer_id($customer_id)
{
    global $con;

    $sql =
        "select
d.id as distributor_id
from cart c
join customer cc on cc.id = c.customer_id
join product_item pt on pt.cart_id = c.id
join product p on p.id = pt.product_id
join distributor d on d.id = p.distributor_id
where c.customer_id= '$customer_id'";

    $result = mysqli_query($con, $sql);
    $rows = mysqli_fetch_array($result);
    return $rows['distributor_id'];
}

function insert_customer_message($customer_id, $distributor_id, $message)
{
    global $con;
    $sql = "
insert into customer_chat (customer_id,distributor_id,message,message_date)
values ('$customer_id','$distributor_id', '$message', now())";
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

        array_push($messages, new Message($customer_name, $message, $message_date));
    }

    return $messages;
}

function get_distributor_messages($customer_id, $distributor_id) {
    global $con;
    $sql =
        "select
dc.message,
dc.message_date,
c.name as distributor
from distributor_chat dc
join distributor d on d.id = dc.distributor_id
join company c on c.id = d.company_id
where  customer_id ='$customer_id' and distributor_id = '$distributor_id' ";

    $result = mysqli_query($con, $sql);
    $messages = array();

    while ($row_dist = mysqli_fetch_array($result)) {
        $message = $row_dist['message'];
        $message_date = $row_dist['message_date'];
        $distributor = $row_dist['distributor'];
        array_push($messages, new Message($distributor, $message, $message_date));
    }
}

$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : null;
$customer_name = isset($_SESSION['customer_name']) ? $_SESSION['customer_name'] : null;
$distributor_id = get_distributor_id_by_customer_id($customer_id);

if (isset($_POST['Message'])) {
    $message = json_decode($_POST['Message']);
    insert_customer_message($customer_id, $distributor_id, $message);
    show_message('message was added into DB');
}

if (isset($_GET['action'])) {
    show_customer_messages($customer_id, $customer_name, $distributor_id);

    $customer_messages = get_customer_messages();
    $distributor_messages = get_distributor_messages();

    $result = array_merge($customer_messages, $distributor_messages);
}
