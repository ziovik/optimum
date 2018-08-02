<?php
session_start();

session_destroy();

echo "<script>window.open('../optimum_beauty.php','_self')</script>";

?>