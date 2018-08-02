<?php

$con = mysqli_connect("localhost","root","","opt_shop");

if (mysqli_connect_errno()) {
	echo "Failed to connect to mysql server :" .mysqli_connect_errno();
}

?>