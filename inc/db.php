<?php

function get_db_connection() {
    $con = mysqli_connect("localhost", "root", "rjynbytyn", "super_optimum");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to mysql server :" . mysqli_connect_errno();
        return null;
    }

    return $con;
}
