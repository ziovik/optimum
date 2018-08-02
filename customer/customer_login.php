<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<title>Заказчик | Login</title>
	<link rel="stylesheet" type="text/css" href="css/style_login.css" media="all">
</head>
<body>



<div class="login">
	<h2 style="color: white; text-align: center;"><?php  echo @$_GET['not_customer']; ?></h2>
	<h2 style="color: white; text-align: center;"><?php  echo @$_GET['logged_out']; ?></h2>
	<h1> ВХОД</h1>
    <form method="post">
    	<input type="text" name="login" placeholder="Логин" required="required" />
        <input type="password" name="pass" placeholder="Пароль" required="required" />
        <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">Log me in.</button>
    </form>
</div>


</body>
</html>

<?php

include("inc/db.php");

if (isset($_POST['submit'])) {
	  $login = mysql_real_escape_string($_POST['login']);
	  $pass = mysql_real_escape_string($_POST['pass']);

	  $sel_customer = "select * from credentials where login='$login' AND password='$pass'";

	  $run_customer = mysqli_query($con, $sel_customer );

	  $check_customer  = mysqli_num_rows($run_customer );

	  if ($check_customer  == 1) {
	  	


          while($rows_customer = mysqli_fetch_array($run_customer)){
              $credential_id = $rows_customer['id'];

              $get_name = "select * from customer where credentials_id = '$credential_id'";

              $run_name = mysqli_query($con, $get_name);

              while($row_name = mysqli_fetch_array($run_name)){

                  $customer_name = $row_name['name'];

                  $_SESSION['login'] = $login;

                  $_SESSION['name'] = $customer_name;

        echo "<script >alert('$customer_name')</script>";
	  	echo "<script>window.open('../optimum_beauty.php?logged_in=Вы успешно вошлли в систему','_self')</script>";


              }
        }
	  }

	  else{
	  	echo "<script>alert('невервеный пароль или логин')</script>";

	  }






}

?>