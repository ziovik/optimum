<!--chat -->

<?php

include("inc/db.php");

$dist_id = $_SESSION['distributor_id'];


if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];

    echo "<script>alert('$customer_id')</script>";
}


$sql = "select 
          c.name as company_name
         from distributor d
         join company c on c.id = d.company_id
         where d.id = '$dist_id'";
$run = mysqli_query($con, $sql);

$row = mysqli_fetch_array($run);

$distributor_name = $row['company_name'];

?>
<div style="padding-left: 200px;">
    <div class="panel panel-info pb-chat-panel" style="width: 500px;">
        <div class="panel panel-heading pb-chat-panel-heading">
            <div class="row">
                <div class="col-xs-12">
                    <a href="#">
                        <h2 style="text-align: center;"><?php echo $distributor_name; ?></h2>
                    </a>
                    <a href="#"><span class="fa fa-cog pull-right pb-chat-top-icons"></span></a>
                    <a href="#"><span class="fa fa-share pull-right pb-chat-top-icons"></span></a>
                </div>
            </div>
        </div>
        <div class="scroll-container" id="chatRoom">

            <form action="" method="post">

                <hr>

                <div class="clearfix"></div>
            </form>


        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-xs-10">
                    <textarea class="form-control pb-chat-textarea" placeholder="чат...И нажмите Кнопку Enter"
                              id="message" style="width: 300px;"></textarea>
                </div>
                <!--<div class="col-xs-2 pb-btn-circle-div">
                    <button type="submit" class="btn btn-primary btn-circle pb-chat-btn-circle" style="width: 50px;"><span class="fa fa-chevron-right"></span></button>
                </div>-->
            </div>
        </div>
    </div>
</div>


<!--chat end-->




<script>

    // calling the loadChat here

    $(document).ready(function () {
        loadChat();
    });


    $('#message').keyup(function (e) {

        var message = $(this).val();  // means what ever is entered in message area we catch the value and store in message
        if (e.which == 13) {  // enter is pressed the it add it to database
            $.post('handlers/ajax.php?action=SendMessage&message=' + message, function (response) {

// calling when ever message is successfully sent
                loadChat();
                $('#message').val('');


            });
// passing two variables.action and sendmessage.create a folder handlers and a file ajax.php

// if enter is pressed it send a post to the ajax.php page the it do what is in the ajax page and return it throug fuction response


        }

    });


    //showing all chat in box

    function loadChat() {
        $.post('handlers/ajax.php?action=getChat', function (response) {
// div class u wanna show all chat
            $('#chatRoom').html(response);

        });
    }


    //to fix the browser s it shows immidiately in other browser

    setInterval(function () {

        loadChat();

    }, 2000); // delay of two seconds to call the method
</script>

