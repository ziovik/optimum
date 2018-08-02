<form action="" method="post" style="padding-top: 50px; padding-left: 400px;">
	<h2>Insert New Sub Category</h2>
	<input type="text" name="new_sub_cat" style="width: 300px;" required>
	<button class="primary-btn" type="submit" name="add_sub_cat" value="Add Sub Category" >Add Sub Category</button>
</form>

<?php
  
  include("inc/db.php");

  //for not acceessing this page by another person who is not in admin

   if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}

else{

   //

  if (isset($_POST['add_sub_cat'])) {
  	

  $new_sub_cat = $_POST['new_sub_cat'];

  $insert_sub_cat ="insert into sub_cat (sub_cat_name) values ('$new_sub_cat')";

  $run_sub_cat = mysqli_query($con, $insert_sub_cat);

  if ($run_sub_cat) {
  	echo "<script>alert('New Sub Category Has been Inserted')</script>";
  	echo "<script>window.open('index.php?view_sub_cat','_self');</script>";

  }
  }
 
?>
<!--close the not accessing -->
<?php  } ?>