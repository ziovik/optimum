<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
    <title>Заказчик | Login</title>
    <link rel="stylesheet" type="text/css" href="css/style_login.css" media="all">
</head>
<body>


<div class="login">
    <h2 style="color: white; text-align: center;"><?php echo @$_GET['not_customer']; ?></h2>
    <h2 style="color: white; text-align: center;"><?php echo @$_GET['logged_out']; ?></h2>
    <h1> ВХОД</h1>
    <form method="post">
        <input type="text" name="login" placeholder="Логин" required="required"/>
        <input type="password" name="pass" placeholder="Пароль" required="required"/>
        <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">Log me in.</button>
    </form>
</div>


</body>
</html>

<?php

include_once '../inc/db_functions.php';
include_once '../db_objects/Customer.php';

if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    $customer = get_customer_by_logpass($login, $pass);

    if ($customer == null) {
        echo "<script>alert('Невервеный пароль или логин')</script>";
        return;
    }

    $_SESSION['login'] = $login;
    $_SESSION['name'] = $customer->name;

    echo "<script >alert('$customer->name')</script>";
    echo "<script>window.open('../optimum_beauty.php?logged_in=Вы успешно вошлли в систему','_self')</script>";
}



?>