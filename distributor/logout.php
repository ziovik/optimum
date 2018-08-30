<?php
session_start();

session_destroy();

print_r("ВЫХОД");
echo "<script>window.open('../index.php','_self')</script>";
