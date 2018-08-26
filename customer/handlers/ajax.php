<?php
session_start();
include("../inc/db.php");




if (isset($_REQUEST['action'])) {

    $customer_id = $_SESSION['id'];

   $get_name = "select 
                    cc.name as customer_name,
                    d.id as distributor_id

                from cart c
                    join customer cc on cc.id = c.customer_id
                    join product_item pt on pt.cart_id = c.id
                    join product p on p.id = pt.product_id
                    join distributor d on d.id = p.distributor_id

                where c.customer_id= '$customer_id'";

    $run_name = mysqli_query($con, $get_name);
    $row = mysqli_fetch_array($run_name);
    $customer_name = $row['customer_name'];
    $distributor_id = $row['distributor_id'];


    switch ($_REQUEST['action']) {

        case "SendMessage":
            $message = $_REQUEST['message'];  // action is calling message inputed
            $sql = "insert into customer_chat set user = '$customer_name', message ='$message', customer_id = '$customer_id', distributor_id = '$distributor_id'";
            $run = mysqli_query($con, $sql);

            echo "Success";

            break;

        case "getChat":

            $sql_customer_message = "select 
                                        * 
                                        from customer_chat 
                                        where 
                                        customer_id ='$customer_id' and  distributor_id = '$distributor_id'  ";


            $run_customer = mysqli_query($con, $sql_customer_message);

            while ($rows = mysqli_fetch_array($run_customer)) {

                $chat = $rows['message'];
                $user = $rows['user'];

                echo "
                        <div class='form-group'>
                        <span class='fa fa-lg fa-user pb-chat-fa-user'></span><br>" . $rows['user'] . "<span class='label label-default pb-chat-labels pb-chat-labels-left'>" . $rows['message'] . "</span>
                        </div>
                        <hr>
                        ";

            }

            $get_dist_message = "select 

                                    *
                                    from distributor_chat

                                    where  customer_id ='$customer_id' AND distributor_id = '$distributor_id' ";

            $run_dist = mysqli_query($con, $get_dist_message);

            while ($row_dist = mysqli_fetch_array($run_dist)) {

                $chat = $row_dist['message'];
                $user = $row_dist['user'];

                echo "


                    <div class='form-group pull-right pb-chat-labels-right'>
                    <span class='label label-primary pb-chat-labels pb-chat-labels-primary'>" . $row_dist['message'] . " :</span>" . $row_dist['user'] . "<span class='fa fa-lg fa-user pb-chat-fa-user'></span>
                    </div>


                    ";


            }
            break;
    }
}
?>