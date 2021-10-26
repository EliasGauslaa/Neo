<!DOCTYPE html>
<html>
<head>
    <title>Neo ungdomsklubb</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
</head>
<body>

<?php
include("inc/config.php");
include("inc/navbar.php");

if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
    } else {
    }
?>
</body>
</html>