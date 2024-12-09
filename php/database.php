<?php
    $hostName = "localhost";
    $dbUser = "admin";
    $dbPassword = "password";
    $dbName = "sunshine";
    $connect = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
    if (!$connect) {
        die("Something went wrong :(");
    }
?>