<?php
  session_start();
include("../inc/db.php");

if (isset($_REQUEST['action'])) {
  

    $dist_id = $_SESSION['distributor_id'];

   
    
    switch ($_REQUEST['action']) {


        case "SendMessage":
             $message = $_REQUEST['message'];  // action is calling message inputed
        
            $sql = "select 
                        c.name as company_name,
                        cc.name as customer_name,
                        cc.id as customer_id

                   from distributor d
                         join company c on c.id = d.company_id
                         join product p on p.distributor_id = d.id
                         join product_item pt on pt.product_id = p.id
                         join cart crt on crt.id = pt.cart_id
                         join customer cc on cc.id = crt.customer_id

                    where d.id = '$dist_id'";

            $run = mysqli_query($con, $sql);

            $row = mysqli_fetch_array($run);

            $distributor_name = $row['company_name'];
            $customer_id = $row['customer_id'];   
                                    
                       

            $sql = "insert into distributor_chat set user = '$distributor_name', message ='$message', distributor_id = '$dist_id', customer_id = '$customer_id' ";
            $run = mysqli_query($con, $sql);

            echo "Success";


            break;


            case "getChat":

                 $sql = "select 
                        c.name as company_name,
                        cc.name as customer_name,
                        cc.id as customer_id

                   from distributor d
                         join company c on c.id = d.company_id
                         join product p on p.distributor_id = d.id
                         join product_item pt on pt.product_id = p.id
                         join cart crt on crt.id = pt.cart_id
                         join customer cc on cc.id = crt.customer_id

                    where d.id = '$dist_id' ";

            $run = mysqli_query($con, $sql);

            $row = mysqli_fetch_array($run);

            $distributor_name = $row['company_name'];
            $customer_id = $row['customer_id'];   


                 $sql_dist_message = "select * from distributor_chat where distributor_id ='$dist_id' AND customer_id = '$customer_id'";

                                  
                              
                 $run_dist = mysqli_query($con, $sql_dist_message);
                 

                 while($rows = mysqli_fetch_array($run_dist)){

                    $chat = $rows['message'];
                    $user = $rows['user'];
                 
                


                    echo "


                  
                    
                   <div class='form-group'>
                        <span class='fa fa-lg fa-user pb-chat-fa-user'></span><br>".$rows['user']."<span class='label label-default pb-chat-labels pb-chat-labels-left'>".$rows['message']."</span>
                    </div>
                    <hr>


                    ";  
}

                    $get_customer_message = "select 
                                                * 
                                             from customer_chat
                                             
                                             where distributor_id = '$dist_id' AND customer_id = '$customer_id' ";
                    $run_customer = mysqli_query($con, $get_customer_message);
                   while($row_customer = mysqli_fetch_array($run_customer)){

                        $chat = $row_customer['message'];
                        $user = $row_customer['user'];

                         echo "


                                  <div class='form-group pull-right pb-chat-labels-right'>
                                        <span class='label label-primary pb-chat-labels pb-chat-labels-primary'>".$row_customer['message']." :D</span>".$row_customer['user']."<span class='fa fa-lg fa-user pb-chat-fa-user'></span>
                                    </div><br><br>


                    ";  
                        
                    }

               
                break;
        
    }
}
?>