<?php
    $servername = "localhost";
    $database = "qlbansua";
    $username = "root";
    $password = "";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database) or die('Connection failed: ' . mysqli_connect_error());
    mysqli_set_charset($conn, 'UTF8');
?>