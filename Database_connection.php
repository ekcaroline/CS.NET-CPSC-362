<?php

    $sname = "localhost"
    $unmae = "root"
    $password ""

    $db_name = "users"

    $conn = mysqli_connect($sname, $unmae, $password, $dbname);

    if(!conn) {
        echo "Connection Failed";
    }