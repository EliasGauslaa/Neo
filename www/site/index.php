<?php
include("inc/config.php");

if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
    } else {
        echo "Connection sucessfull";
    }
?>