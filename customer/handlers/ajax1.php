<?php
include("../inc/db.php");

if (isset($_REQUEST['action'])) {

	
	switch ($_REQUEST['action']) {
		case "SendMessage":
			//echo 'coming ajax.php';

		  session_start();
		  
		 $user = 'daniel';
		 $message = $_REQUEST['message'];  // action is callion message inputed

		    $sql = "insert into chat set user = '$user', message ='$message'";
		    $run = mysqli_query($con, $sql);

		    echo "1";


			break;


			case "getChat":
				 $sql_all = "select * from chat  ";
		         $run_all = mysqli_query($con, $sql_all);
                 
		         while($rows = mysqli_fetch_array($run_all)){

		         	$chat = $rows['message'];
		         	$user = $rows['user'];
		         
		        


                    echo "


                  
                    
                   <div class='form-group'>
                        <span class='fa fa-lg fa-user pb-chat-fa-user'></span><br>".$rows['user']."<span class='label label-default pb-chat-labels pb-chat-labels-left'>".$rows['message']."</span>
                    </div>
                    <hr>


                    ";  
		         
           
                   }
				break;
		
	}
}
?>