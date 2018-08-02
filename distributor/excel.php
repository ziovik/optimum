    <?php
    session_start();
    include("inc/db.php");
    
    $output = '<meta http-equiv=Content-Type content="text/html; charset=utf-8">';
    $i = 0;
    if (isset($_POST['export_excel'])) {
      if (isset($_SESSION['dist_email'])) {
       $dist_email= $_SESSION['dist_email'];

       $output .='
       <h2 style = "text-align: center">Your orders</h2>
       <table class="table" bordered = "2">
       <tr>
       <th style="width : 300px;">customer email</th>

       <th style="width : 200px;">Price</th>
       <th style="width : 100px;">Quantity</th>
       <th style="width : 100px;">Action</th>
       </tr>

       ';


       $get_d = "select *from distributors where dist_email = '$dist_email' ";

       $run_d = mysqli_query($con, $get_d);

       $row_d = mysqli_fetch_array($run_d);

       $dist_id = $row_d['dist_id'];

       $dist_email = $row_d['dist_email'];



       $i= 0;


       $get_pro = "select * from products  where dist_id = '$dist_id' ";

       $run_pro =mysqli_query($con,$get_pro);

       while( $row_pro =mysqli_fetch_array($run_pro)){
        $product_name = $row_pro['product_title'];

        $p_id =$row_pro['product_id'];
        $product_price = $row_pro['product_price'];




        $get_email = "select * from cart where p_id = '$p_id'";

        $run_email = mysqli_query($con, $get_email);

        while ($row_email = mysqli_fetch_array($run_email)) {
          $customer_email = $row_email['customer_email'];
          $qty = $row_email['qty'];


          $get_date = "select * from orders where customer_email ='$customer_email'";

          $run_date = mysqli_query($con, $get_date);

          while ($row_date = mysqli_fetch_array($run_date)) {
            $date = $row_date['order_date'];
            $order_id =$row_date['order_id'];


            $output .= '
            <tr >

            <td style="width : 300px; text-align:center;">'.$row_email['customer_email'].'</td>

            <td style="width : 200px; text-align:center;"">'.$row_pro['product_price'].'</td>
            <td style="width : 100px; text-align:center;"">'.$row_email['qty'].'</td>
            <td style="width : 100px; text-align:center;"">'.$row_date['order_date'].'</td>

            </tr>
            ';
          }
        }

     }

    }
  }
        $output .= '</table>';

        
        header("Content-Disposition: attachment; filename=download.cvs");

        echo $output;

      


      ?>