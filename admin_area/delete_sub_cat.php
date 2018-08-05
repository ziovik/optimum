<?php

  
 //for not acceessing this page by another person who is not in admin

   if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}

else{

   //

  if (isset($_GET['delete_sub_cat'])) {
  	
  	$delete_id = $_GET['delete_sub_cat'];

  	$delete_sub_cat = "delete from sub_cat where sub_cat_id = '$delete_id'";

  	$run_delete_sub_cat = mysqli_query($con, $delete_sub_cat);

  	if ($run_delete_sub_cat) {
  		echo "<script>alert('A Sub category has been deleted')</script>";
  		echo "<script>window.open('index.php?view_sub_cat','_self')</script>";
  	}
  }

?>

<!--close the not accessing -->
<?php  } ?>