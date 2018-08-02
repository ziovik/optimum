<?php
include("inc/db.php");

 //for not acceessing this page by another person who is not in admin

   if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}

else{

   //

if (isset($_GET['edit_sub_cat'])) {
  $sub_cat_id = $_GET['edit_sub_cat'];

  $get_sub_cat = "select * from sub_cat where sub_cat_id='$sub_cat_id'";

  $run_sub_cat = mysqli_query($con, $get_sub_cat);

  $row_sub_cat = mysqli_fetch_array($run_sub_cat);

  $sub_cat_id= $row_sub_cat['sub_cat_id'];
  $sub_cat_name = $row_sub_cat['sub_cat_name'];


}

?>



<form action="" method="post" style="padding-top: 50px; padding-left: 400px;">
	<h2>Insert New Sub Category</h2>
	<input type="text" name="new_sub_cat" style="width: 300px;" value="<?php echo $sub_cat_name ?>">
	<button class="primary-btn" type="submit" name="update_sub_cat" value="Update Sub Category" >Update Sub Category</button>
</form>

<?php
  
  include("inc/db.php");

  if (isset($_POST['update_sub_cat'])) {
  	
   $update_sub_cat_id = $sub_cat_id;
   $new_sub_cat = $_POST['new_sub_cat'];

   $update_sub_cat ="update sub_cat set sub_cat_name='$new_sub_cat' where sub_cat_id='$update_sub_cat_id'";

   $run_update = mysqli_query($con, $update_sub_cat);

  if ($run_update) {
  	echo "<script>alert(' Sub Category Has been Updated')</script>";
  	echo "<script>window.open('index.php?view_sub_cat','_self');</script>";

  }
  }
 
?>


<!--close the not accessing -->
<?php  } ?>