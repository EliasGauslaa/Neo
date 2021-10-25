<?php
include("inc/config.php");

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
    } else {
        echo "Connection sucessfull";

    }
?>