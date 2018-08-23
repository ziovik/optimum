  <table width="800" align="center" >
  	<tr align="center">
  		<td colspan="7"><h2>Подробность заказа</h2></td>
  	</tr>
  	<tr style="text-align: center;">
  		<th >S/N</th>
      
  		<th>Наимнование </th>
      
  		<th>количество</th>
  		<th>Дистрибьютор</th>
      <th>Цена</th>
  		<th>Положение</th>
     
  		
  	</tr>
       
       <?php

         include("inc/db.php");

        if (isset($_GET['my_orders'])) {

          if (isset($_SESSION['id'])) {

            $my_orders = $_GET['my_orders'];
         
     // this is for customer details
          $customer_id = $_SESSION['id'];
          
          $onscreen_status = 'Отправил';
         
          $i= 0;

            
            $get = "select 
                             pt.onscreen_status as status,                          
                             pt.product_id as product_id,
                             c.id as cart_id,
                             com.name as company_name,
                             pt.quantity as qty,
                             p.price as price,
                             p.name as product_name,
                             cc.name as customer_name

                         from 
                              cart c
                              join product_item pt on pt.cart_id = c.id
                              join simple_order so on so.cart_id = pt.cart_id
                              join product p on p.id = pt.product_id
                              join distributor d on d.id = p.distributor_id
                              join company com on com.id = d.company_id
                              join customer cc on cc.id = c.customer_id

                         where c.customer_id = '$customer_id' AND  so.id = '$my_orders'  AND pt.onscreen_status = '$onscreen_status' ";

            $run = mysqli_query($con, $get);

            while ($rows = mysqli_fetch_array($run)) {
             
               $product_name = $rows['product_name'];
               $qty = $rows['qty'];
               $company_name = $rows['company_name'];
               $product_price = $rows['price'];
               $onscreen_status = $rows['status'];
               $customer_name = $rows['customer_name'];

                $i++;
  
            ?>

            <tr align="center">
            <td><?php echo $i;  ?></td>
            <td><?php echo $product_name; ?></td>
            <td><?php echo $qty; ?></td>
            <td><?php echo $company_name; ?>

            <!--chat -->
          
          
               <div class="btn-group" >
                   <button class="btn btn-primary dropdown-toggle btn-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100px;">
                        <span class="fa fa-comments pull-left">Chat
                    </button>
                    <ul class="dropdown-menu pb-chat-dropdown">
                        <li>
                             <div class="panel panel-info pb-chat-panel">
                                 <div class="panel panel-heading pb-chat-panel-heading">
                                     <div class="row">
                                         <div class="col-xs-12">
                                             <a href="#">
                                                <label id="support_label"><?php echo $customer_name;   ?></label>
                                             </a>
                                             <a href="#"><span class="fa fa-cog pull-right pb-chat-top-icons"></span></a>
                                             <a href="#"><span class="fa fa-share pull-right pb-chat-top-icons"></span></a>
                                         </div>
                                     </div>
                                </div>
                                <div class="scroll-container" id="chatRoom"   >
                                   
                                      <form action="" method="post">
                                        
                                         <hr>
                                     
                                          <div class="clearfix"></div>
                                    </form>
                                   
                                   
                                 </div>
                                 <div class="panel-footer">
                                     <div class="row">
                                          <div class="col-xs-10">
                                               <textarea class="form-control pb-chat-textarea" placeholder="чат...И нажмите Кнопку Enter"  id="message" style="width: 200px;"></textarea>
                                          </div>
                                          <!--<div class="col-xs-2 pb-btn-circle-div">
                                              <button type="submit" class="btn btn-primary btn-circle pb-chat-btn-circle" style="width: 50px;"><span class="fa fa-chevron-right"></span></button>
                                          </div>-->
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
           
<!--chat end-->
   


            </td>
            <td><?php echo $product_price; ?></td>
            <td><?php echo $onscreen_status; ?></td>
            
            </tr>
          <?php } } } ?>

         

  </table>
  <div style="float: right;">
    <form  method="post" action="excel.php">
            <input type="submit" name="export_excel" class="btn btn-success" value="Печать Заказы">
            
    </form>

  </div>
   <div>
     <button style="background:#800080; border-radius:5px; width: 80px; height: 50px;" class="btn next-btn"><a href='index.php?view_orders' class='text-uppercase' style='color:#fff; line-height: 2.5;'>Назад</a></buuton>
  <br>
  <br>
   </div>
  


 <!--<script >
    $('#message').keyup(function(){
      alert('key pressed')
    });
  </script>--> <!--on key press it gives alert-->

<!--<script >
    $('#message').keyup(function(){

      var message = $(this).val();  // means what ever is entered in message area we catch the value and store in message
      alert(message); //it shows now in pop up any message typed
      
    });
</script>-->  
<!--<script >
    $('#message').keyup(function(e){

      var message = $(this).val();  // means what ever is entered in message area we catch the value and store in message
      alert(e.which); //it shows the asci of each keyboard keys. 66 67 and so on of each button on keyboard.enter is 13
      
    });
</script>-->  

<script >

    // calling the loadChat here

    $(document).ready(function(){
      loadChat();
    });
      
    

    $('#message').keyup(function(e){

      var message = $(this).val();  // means what ever is entered in message area we catch the value and store in message
     if (e.which == 13 ) {  // enter is pressed the it add it to database
        $.post('handlers/ajax.php?action=SendMessage&message='+message, function(response){
          
       // calling when ever message is successfully sent
        loadChat();
        $('#message').val('');


        });
        // passing two variables.action and sendmessage.create a folder handlers and a file ajax.php

        // if enter is pressed it send a post to the ajax.php page the it do what is in the ajax page and return it throug fuction response


     }
      
    });


    //showing all chat in box

    function loadChat()
    {
      $.post('handlers/ajax.php?action=getChat', function(response){
          // div class u wanna show all chat
        $('#chatRoom').html(response);

        });
    }


    //to fix the browser s it shows immidiately in other browser

    setInterval(function(){

      loadChat();

    }, 2000); // delay of two seconds to call the method
</script>

