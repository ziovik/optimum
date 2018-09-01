<?php
session_start();

unset($_SESSION);
$_SESSION = array();

echo "<script>window.open('../index.php','_self')</script>";