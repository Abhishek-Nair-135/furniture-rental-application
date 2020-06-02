<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "furniture_rental";
    
    $dbh = mysqli_connect($server, $username, $password, $dbname);
    if (!$dbh) {
        echo "Connection failed";
    }
?>