
<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<title>Distributor Login</title>
	<link rel="stylesheet" type="text/css" href="css/style_login.css" media="all">
</head>
<body>



<div class="login">
	<h2 style="color: white; text-align: center;"><?php  echo @$_GET['not_dist']; ?></h2>
	<h2 style="color: white; text-align: center;"><?php  echo @$_GET['logged_out']; ?></h2>
	<h1> Distributor Login</h1>
    <form method="post">
    	<input type="text" name="email" placeholder="Email" required="required" />
        <input type="password" name="pass" placeholder="Password" required="required" />
        <button type="submit" name="login" class="btn btn-primary btn-block btn-large">Log me in.</button>
    </form>
</div>


</body>
</html>

<?php

include("inc/db.php");

if (isset($_POST['login'])) {
	  $email = mysql_real_escape_string($_POST['email']);
	  $pass = mysql_real_escape_string($_POST['pass']);

	  $sel_dist = "select * from distributors where dist_email='$email' AND dist_pass='$pass'";

	  $run_dist = mysqli_query($con, $sel_dist);

	  $check_dist = mysqli_num_rows($run_dist);

	  if ($check_dist == 1) {
	  	
	  	$_SESSION['dist_email'] = $email;
        echo "<script >alert('$email')</script>";
	  	echo "<script>window.open('index.php?logged_in=You have successfully Logged into Distributor','_self')</script>";
	  }

	  else{
	  	echo "<script>alert('Password or Email is wrong')</script>";
	  	
	  }



}

?>