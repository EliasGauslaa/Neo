<?php
    session_start();
?>

<?php
    if (!isset($_SESSION["userUid"])) {
        header("location: /Neo/Neo/www/site/login.php");
        exit();
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Neo ungdomsklubb</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css"/>
    </head>
    <body>

    <?php
        include("config.php");
        include("navbar.php");
    ?>